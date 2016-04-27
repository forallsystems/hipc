from django.conf.urls import url, include
from django.contrib import admin
from rest_framework import routers
from api import views as api_views

router = routers.DefaultRouter()
router.register(r'schools', api_views.SchoolViewSet)
router.register(r'flyers', api_views.FlyerViewSet)

urlpatterns = [
    url(r'^api/', include(router.urls)),
]
