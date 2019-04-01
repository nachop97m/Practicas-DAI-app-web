from django.conf.urls import include, url
from django.contrib import admin

urlpatterns = [
 url(r'^restaurantes/', include('restaurantes.urls')),
 url(r'^admin/', admin.site.urls),
 url(r'^tesla/', include('teslaBoot.urls')),
 url(r'^accounts/', include('allauth.urls')),
]