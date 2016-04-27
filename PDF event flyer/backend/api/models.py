from django.db import models
    
class School(models.Model):
    id = models.AutoField(primary_key=True)
    name =  models.CharField(max_length=256)
    
class Flyer(models.Model):
    id = models.AutoField(primary_key=True)
    email = models.CharField(max_length=256)
    subscribed = models.BooleanField(default=True)
    title = models.CharField(max_length=256)
    school = models.ForeignKey(School)
    grade = models.IntegerField()
    subject = models.CharField(max_length=256)
    
class Event(models.Model):
    id = models.AutoField(primary_key=True)
    name = models.CharField(max_length=256)
    description = models.TextField(blank=True, null=True)
    organizer = models.CharField(max_length=256, blank=True, null=True)
    image = models.TextField(blank=True, null=True)
    website = models.TextField(blank=True, null=True)
    start_date = models.DateField(blank=True, null=True)
    end_date = models.DateField(blank=True, null=True)
    start_time = models.CharField(max_length=256, blank=True, null=True)
    end_time = models.CharField(max_length=256, blank=True, null=True)
    cost = models.CharField(max_length=256, blank=True, null=True)
    venue_name = models.CharField(max_length=256, blank=True, null=True)
    venue_street_address= models.CharField(max_length=256, blank=True, null=True)
    venue_city = models.CharField(max_length=256, blank=True, null=True)
    venue_state = models.CharField(max_length=256, blank=True, null=True)
    venue_zipcode = models.CharField(max_length=256, blank=True, null=True)
    