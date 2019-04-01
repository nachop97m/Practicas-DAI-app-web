from django.conf.urls import url
from . import views

urlpatterns = [
  url(r'^$', views.index, name='index'),
  url(r'^profile/$', views.profile, name='profile'),
  url(r'^user/$', views.user, name='user'),
  url(r'^login/$', views.login, name='login'),
  url(r'^register/$', views.register, name='register'),
  url(r'^alter/$', views.alter, name='alter'),
]