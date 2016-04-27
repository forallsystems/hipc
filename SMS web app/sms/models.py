from django.db import models
    
class Person(models.Model):
    id = models.AutoField(primary_key=True)
    phone_number = models.CharField(max_length=256)
    
class Event(models.Model):
    id = models.AutoField(primary_key=True)
    name = models.CharField(max_length=256)
    description = models.TextField(blank=True)
    organizer = models.CharField(max_length=256, blank=True)
    website = models.TextField(blank=True,null=True)
    start_date = models.DateField(blank=True,null=True)
    end_date = models.DateField(blank=True,null=True)
    start_time = models.CharField(max_length=256, blank=True,null=True)
    end_time = models.CharField(max_length=256, blank=True,null=True)
    cost = models.CharField(max_length=256, blank=True,null=True)
    venue_name = models.CharField(max_length=256, blank=True,null=True)
    venue_street_address= models.CharField(max_length=256, blank=True,null=True)
    venue_city = models.CharField(max_length=256, blank=True,null=True)
    venue_state = models.CharField(max_length=256, blank=True,null=True)
    venue_zipcode = models.CharField(max_length=256, blank=True,null=True)
    
class IncomingMessageLog(models.Model):
    id = models.AutoField(primary_key=True)
    date_received = models.DateTimeField(auto_now=True)
    person = models.ForeignKey(Person)
    message =  models.TextField(blank=True)
    
class OutgoingMessageLog(models.Model):
    id = models.AutoField(primary_key=True)
    date_sent = models.DateTimeField(auto_now=True)
    person = models.ForeignKey(Person)
    message =  models.TextField(blank=True)
    
    TYPE_CATEGORY = 0
    TYPE_LOCATION = 1
    TYPE_EVENT_INTERESTED = 2
    TYPE_EVENT_INFO = 3
    TYPE_EVENT_LOCATION = 4
    TYPE_EVENT_TIME = 5
    TYPE_EVENT_WEBSITE = 6
  
    TYPE_CHOICES = (
        (TYPE_CATEGORY, 'Which Category'),
        (TYPE_LOCATION, 'Your Location'),
        (TYPE_EVENT_INTERESTED, 'Interested In This Event'),
        (TYPE_EVENT_INFO, 'Event Info'),
        (TYPE_EVENT_LOCATION, 'Event Location'),
        (TYPE_EVENT_TIME, 'Event Time'),
        (TYPE_EVENT_WEBSITE, 'Event Website')
    )
    
    type = models.IntegerField(default=0,choices=TYPE_CHOICES)
    event = models.ForeignKey(Event, blank=True, null=True)
    
