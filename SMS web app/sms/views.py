from django.http import HttpResponse
from django.views.decorators.csrf import csrf_exempt
from django.conf import settings
from twilio.rest import TwilioRestClient
import urllib2
import xmltodict
import datetime
from sms.models import *

def update_events(request):    
    rss_url = "https://lw6qqcgvzf.execute-api.us-east-1.amazonaws.com/prod/rss"
        
    file = urllib2.urlopen(rss_url)
    data = file.read()
    file.close()
    
    Event.objects.all().delete()

    for item in xmltodict.parse(data)['rss']['channel']['item']:
        event = Event(name=item['event_name'],
                      description=item['event_description'],
                      organizer=item['event_organizer'],
                      website=item['event_website'],
                      start_date=datetime.datetime.fromtimestamp(int(item['event_start_date'])).strftime('%Y-%m-%d'),
                      end_date=datetime.datetime.fromtimestamp(int(item['event_end_date'])).strftime('%Y-%m-%d'),
                      start_time=item['event_start_time'],
                      end_time=item['event_end_time'],
                      cost=item['event_cost'],
                      venue_name=item['venue_name'],
                      venue_street_address=item['venue_street_address'],
                      venue_city=item['venue_city'],
                      venue_state=item['venue_state'],
                      venue_zipcode=item['venue_zipcode'])
        event.save()
        
    return HttpResponse('Finished!')

@csrf_exempt
def process(request):
    incoming_message_text = request.POST['Body'] if 'Body' in request.POST else ''
    incoming_phone_number = request.POST['From'] if 'From' in request.POST else ''
    
    if not incoming_message_text:
        incoming_message_text = request.GET['Body'] if 'Body' in request.GET else ''
        incoming_phone_number = request.GET['From'] if 'From' in request.GET else ''
    
    if incoming_message_text and incoming_phone_number:
        #See if person who texted us exists, if not, add them
        try:
            person = Person.objects.get(phone_number=incoming_phone_number)
        except:
            person = Person(phone_number=incoming_phone_number)
            person.save()
        
        #Log incoming message
        iml = IncomingMessageLog(person=person, message=incoming_message_text)
        iml.save()
        
        #Get last message sent to person
        previous_message_oml = None
        try:
            previous_message_oml = OutgoingMessageLog.objects.filter(person=person).order_by('-date_sent')[0]
        except:
            pass
        
        #Generate response
        if previous_message_oml:
            response = _generate_response(previous_message_oml.type, previous_message_oml.event, incoming_message_text)
        else:
            response = _generate_response(None, None, incoming_message_text)
            
        #Send response
        _send_response(person, response)
    
    return HttpResponse('')


def _generate_response(previous_type, previous_event, incoming_message_text):
    response = {'message': '',
                'type': OutgoingMessageLog.TYPE_CATEGORY,
                'event': None}
    
    incoming_message_text = incoming_message_text.lower()
    
    if previous_type is None or 'bored' in incoming_message_text or 'hey' in incoming_message_text or 'start over' in incoming_message_text: 
        #Starting a new conversation
        response['type'] = OutgoingMessageLog.TYPE_CATEGORY
        if 'bored' in incoming_message_text:
            response['message'] = "I hate when that happens.  What are you in the mood for: video games, poetry, or sports"
        else:
            response['message'] = "Hi!  What are you in the mood for: video games, poetry, or sports"
            
    elif previous_type == OutgoingMessageLog.TYPE_CATEGORY:
        response['type'] = OutgoingMessageLog.TYPE_LOCATION
        response['message'] = "Good choice. All right let's see...where are you?"
        
    elif previous_type == OutgoingMessageLog.TYPE_LOCATION:
        #Find an event, for now we'll do something basic.  Real version will filter based on
        #location, category, date, etc.
        event = _find_event(None)
        if event:
            response['event'] = event
            response['type'] = OutgoingMessageLog.TYPE_EVENT_INTERESTED
            response['message'] = "Are you interested in: "+event.name+" hosted by the "+event.organizer+"?"
        else:
            response['type'] = OutgoingMessageLog.TYPE_EVENT_INTERESTED
            response['message'] = "Sorry, I couldn't find any events."
            
    elif previous_type == OutgoingMessageLog.TYPE_EVENT_INTERESTED and ('no' in incoming_message_text or 'nah' in incoming_message_text):
        event = _find_event(previous_event)
        if event:
            response['event'] = event
            response['type'] = OutgoingMessageLog.TYPE_EVENT_INTERESTED
            response['message'] = "That's cool.  Maybe you'd like: "+event.name+" hosted by the "+event.organizer+"?"
        else:
            response['type'] = OutgoingMessageLog.TYPE_EVENT_INTERESTED
            response['message'] = "Sorry, I couldn't find any more events."    
            
    elif previous_type == OutgoingMessageLog.TYPE_EVENT_INTERESTED: 
        response['event'] = previous_event
        response['type'] = OutgoingMessageLog.TYPE_EVENT_INFO
        response['message'] = (previous_event.description[:157] + '..') if len(previous_event.description) > 160 else previous_event.description  
    
    elif (previous_type == OutgoingMessageLog.TYPE_EVENT_INFO or previous_type == OutgoingMessageLog.TYPE_EVENT_LOCATION or previous_type == OutgoingMessageLog.TYPE_EVENT_TIME) and ('where' in incoming_message_text
                                             or 'location' in incoming_message_text):
        response['event'] = previous_event
        response['type'] = OutgoingMessageLog.TYPE_EVENT_LOCATION
        response['message'] = previous_event.name+" will be at the "+previous_event.venue_name+" located at "+previous_event.venue_street_address
    
    elif (previous_type == OutgoingMessageLog.TYPE_EVENT_INFO or previous_type == OutgoingMessageLog.TYPE_EVENT_LOCATION or previous_type == OutgoingMessageLog.TYPE_EVENT_TIME) and ('when' in incoming_message_text
                                             or 'time' in incoming_message_text):
        response['event'] = previous_event
        response['type'] = OutgoingMessageLog.TYPE_EVENT_TIME
        response['message'] = previous_event.name+" starts at "+previous_event.start_time+" on "+previous_event.start_date.strftime("%m/%d/%Y")
    
    elif (previous_type == OutgoingMessageLog.TYPE_EVENT_INFO or previous_type == OutgoingMessageLog.TYPE_EVENT_LOCATION or previous_type == OutgoingMessageLog.TYPE_EVENT_TIME):
        response['event'] = previous_event
        response['type'] = OutgoingMessageLog.TYPE_EVENT_WEBSITE
        response['message'] = "You can learn more by visiting: "+previous_event.website

                
    return response

def _find_event(previous_event):
    previous_event_id = 0
    if previous_event:
        previous_event_id = previous_event.id
    for event in Event.objects.filter(id__gt=previous_event_id).order_by('id'):
        return event
    
def _send_response(person, response):
    client = TwilioRestClient(settings.TWILIO_ACCOUNT_SID, settings.TWILIO_AUTO_TOKEN)
    try:
   
        r = client.sms.messages.create(body=response['message'],
            to=person.phone_number,    
            from_=settings.TWILIO_PHONE_NUMBER)
    
        oml = OutgoingMessageLog(person=person, 
                                 message=response['message'], 
                                 type=response['type'], 
                                 event=response['event'])
        oml.save()
    except:
        pass