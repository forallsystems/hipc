from rest_framework import viewsets, filters
from rest_framework.decorators import detail_route, list_route
from rest_framework.response import Response
from wsgiref.util import FileWrapper
from django.conf import settings
from django.core.mail import send_mail, EmailMessage
from django.http import HttpResponse, HttpResponseRedirect
from django.template.loader import get_template
from django.template import Context
from api.models import *
from api.serializers import *
import datetime
import urllib2
import xmltodict
import xhtml2pdf.pisa as pisa
try:
    import StringIO
    StringIO = StringIO.StringIO
except Exception:
    from io import StringIO
import cgi

class SchoolViewSet(viewsets.ReadOnlyModelViewSet):
    queryset = School.objects.all()
    serializer_class = SchoolSerializer
    filter_backends = (filters.OrderingFilter,)
    ordering_fields = ('name',)
    ordering = ('name',)

class FlyerViewSet(viewsets.ViewSet):
    queryset = Flyer.objects.all()
    
    @detail_route(methods=['post','get'])
    def unsubscribe(self, request, pk):
        flyer = Flyer.objects.get(pk=pk)
        flyer.subscribed = False
        flyer.save()
        
        return HttpResponseRedirect(settings.FRONT_END_URL+"unsubscribe.html")
    
    @list_route(methods=['post'])
    def subscribe(self, request):
        flyer = Flyer(email=request.POST.get("email"),
                      title=request.POST.get("title"),
                      school_id=request.POST.get("school"),
                      grade=request.POST.get("grades"),
                      subject=request.POST.get("subject"))
        flyer.save()
        
        return Response({'status': 'ok'})
    
    @list_route(methods=['post','get'])
    def sample(self, request):
        return FlyerViewSet._generatePDF(title=request.POST.get("title",""))
    
    #A cron job will call this once a week
    @list_route(methods=['get'])   
    def email_flyers(self, request):
        for f in Flyer.objects.filter(subscribed=True):
            pdfFileName = FlyerViewSet._generatePDF(write_file=True, title=f.title, school_id=f.school_id, grade=f.grade, subject=f.subject)
            email = EmailMessage("Your Learning Event Flyer", "You will find this week's learning event flyer attached to this email!\n\nIf you would like to unsubscribe, please click this link: http://"+request.get_host()+"/api/flyers/"+str(f.id)+"/unsubscribe/", 
                                    "donotreply@forallschools.com",
                                    [f.email])
            email.attach_file(pdfFileName)
            email.send()
            
        return HttpResponse({'status': 'ok'})
    
    #A cron job will call this once a day/week, to update the events from the CCOL rss feed 
    @list_route(methods=['get'])   
    def update_events(self, request):
        rss_url = "https://lw6qqcgvzf.execute-api.us-east-1.amazonaws.com/prod/rss"
        
        file = urllib2.urlopen(rss_url)
        data = file.read()
        file.close()
        
        Event.objects.all().delete()
    
        for item in xmltodict.parse(data)['rss']['channel']['item']:
            event = Event(name=item['event_name'],
                          description=item['event_description'],
                          organizer=item['event_organizer'],
                          image = item['event_image'],
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
            
        return HttpResponse({'status': 'ok'})
    
    @staticmethod
    def _generatePDF(write_file=False, title="Latest CCOL Events", school_id="", grade="", subject=""):        
        events = Event.objects.all().order_by('-start_date')[:4]

        context_dict = {'events':events,
                        'title':title}
        
        template = get_template("flyer_pdf.html")
        context = Context(context_dict)
        html  = template.render(context)
        result = StringIO()
        pdf = pisa.pisaDocument(StringIO( "{0}".format(html) ), result)
        
        if not pdf.err:
            if write_file:
                tempFileName = settings.MEDIA_ROOT+"/"+title.replace(" ","")+".pdf"
                tempFile = open(tempFileName, 'wb+')
                tempFile.write(result.getvalue())
                tempFile.close()
                return tempFileName
                
            else:
                return HttpResponse(result.getvalue(), content_type='application/pdf')
        
        if write_file:
            return None
        
        return HttpResponse('We had some errors<pre>%s</pre>' % cgi.escape(html))
