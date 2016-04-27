from django.conf.urls import url
from django.contrib import admin

urlpatterns = [
    #url(r'^admin/', admin.site.urls),
    url(r'^process/$', 'sms.views.process'),
    url(r'^update_events/$', 'sms.views.update_events')
]
