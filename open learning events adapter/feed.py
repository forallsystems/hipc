import jwt, time, datetime, requests, StringIO
from PyRSS2Gen import PyRSS2Gen
import settings, CustomRSSItem

def _generatePayLoad():
    return {"exp": int(time.time()),
           "version": "v1",
           'payload':{}}

#AWS Lambda Function
def feed_handler(event, context):    
    headers = {'Accept' : 'application/json',
               'Authorization' : 'JWT token =' + settings.CCOL_API_TOKEN}
    
    feed_items = []
    
    #Get the program metadata for each organization
    #http://chicago.col-engine-staging.com/apipie/1.0/programs/index.html
    for org_id in settings.ORG_LIST:
    
        program_api_url = "http://chicago.col-engine.com/partner_api/v1/orgs/"+str(org_id)+"/programs.json"
        
        payload = _generatePayLoad()
        jwt_string = jwt.encode(payload, settings.CCOL_API_SECRET)
        programs_request = requests.get(program_api_url+"?jwt="+jwt_string, data="", headers=headers)
        
        for program in programs_request.json()['result']:
            #For each program, get the scheduled_programs
            #http://chicago.col-engine-staging.com/apipie/1.0/scheduled_programs.html
            scheduled_program_api_url = "http://chicago.col-engine.com/partner_api/v1/orgs/"+str(org_id)+"/programs/"+str(program['id'])+"/scheduled_programs.json"
            
            payload = _generatePayLoad()
            jwt_string = jwt.encode(payload, settings.CCOL_API_SECRET)
            scheduled_programs_request = requests.get(scheduled_program_api_url+"?jwt="+jwt_string, data="", headers=headers)
        
            for scheduled_program in scheduled_programs_request.json()['result']:
                if not scheduled_program['hide']:
                    payment = "Free"
                    if scheduled_program['price'] == 1:
                        payment = "$1 to $50"
                    elif scheduled_program['price'] == 2:
                        payment = "$50+"
                        
                    categories = ""
                    for c in scheduled_program['categories']:
                        if c['category']['name']:
                            if categories:
                                categories+=", "
                            categories+=c['category']['name']
                            
                    start_date = ""
                    end_date = ""
                    start_time = ""
                    end_time = ""
                    
                    if scheduled_program['start_time']:
                        start_time = datetime.datetime.strptime( scheduled_program['start_time'],"%Y-%m-%dT%H:%M:%SZ").strftime("%I:%M%p")
                        
                    if scheduled_program['end_time']:
                        end_time = datetime.datetime.strptime( scheduled_program['end_time'],"%Y-%m-%dT%H:%M:%SZ").strftime("%I:%M%p")
                   
                    if scheduled_program['start_date']:
                        start_date = str(int(time.mktime(datetime.datetime.strptime(scheduled_program['start_date'], "%Y-%m-%d").timetuple())))
                     
                    if scheduled_program['end_date']:
                        end_date = str(int(time.mktime(datetime.datetime.strptime(scheduled_program['end_date'], "%Y-%m-%d").timetuple())))
                       
                    custom_items = {"event_name":scheduled_program['name'],
                                   "event_description":scheduled_program['description'].encode('latin-1',"ignore").decode('utf-8',"ignore"),
                                   "event_start_date":start_date,
                                   "event_end_date":end_date,
                                   "event_start_time":start_time,
                                   "event_end_time":end_time,
                                   "event_organizer":scheduled_program['org_name'],
                                   "event_website":scheduled_program['registration_url'],
                                   "event_image":scheduled_program['logo_url'],
                                   "event_cost":payment,
                                   "event_categories":categories,
                                   "venue_name":scheduled_program['location_name'],
                                   "venue_street_address":scheduled_program['address'],
                                   "venue_city":scheduled_program['city'],
                                   "venue_state":scheduled_program['state'],
                                   "venue_zipcode":scheduled_program['zipcode'],
                                   }
                        
                    feed_items.append(CustomRSSItem.CustomRSSItem(
                                         title = scheduled_program['name'],
                                         description = scheduled_program['description'].encode('latin-1',"ignore").decode('utf-8',"ignore"),
                                         link = scheduled_program['registration_url'],
                                         customItems = custom_items
                                         ))
                  
    #Generate feed
    rss = PyRSS2Gen.RSS2(
        title = "Chicago City of Learning Events Feed",
        link = "",
        description = "The latest events from Chicago City of Learning organizations.",
        lastBuildDate = datetime.datetime.now(),
        items = feed_items)
    
    output = StringIO.StringIO()
    rss.write_xml(output)
    
    #Send back RSS/XML content
    return output.getvalue()

#print feed_handler(None,None)