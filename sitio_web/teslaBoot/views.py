from django.shortcuts import render, HttpResponse, redirect
from .models import tesla
from .forms import loginForm, registerForm
from pickleshare import *


def index(request):

	try:
		del request.session['user']
	except:
		pass
	context = {}
	return render(request, 'index.html', context)
	
def login(request):

	db = PickleShareDB('/vagrant/Practicas/sitio_web/tesla.db')
    
	form = loginForm(request.POST)
	
	if form.is_valid():
		user = form.cleaned_data['user']
		pwd = form.cleaned_data['pwd']

		if user in db:

			if pwd == db[user]['pwd']:
			
				request.session['user'] = user
				request.session['pagina1'] = 'models'
				request.session['pagina2'] = 'modelx'
				request.session['pagina3'] = 'model3'
				request.session['pagina1text'] = 'TESLA MODEL S'
				request.session['pagina2text'] = 'TESLA MODEL X'
				request.session['pagina3text'] = 'TESLA MODEL 3'

				return redirect('user')

			else:

				return redirect('index')
				
		else:
			return redirect('index')

	else:
		return redirect('index')

def register(request):

	db = PickleShareDB('/vagrant/Practicas/sitio_web/tesla.db')

	form = registerForm(request.POST)

	if form.is_valid():
		user = form.cleaned_data['user']
		name = form.cleaned_data['nm']
		pwd = form.cleaned_data['pwd']
		ct = form.cleaned_data['ct']
		models = form.cleaned_data['models']
		

		if user in db:
			return redirect('index')

		else:

			db[user] = { 'user': user, 'name':name, 'pwd': pwd, 'ct': ct, 'models': models }
			
			request.session['user'] = user
			request.session['pagina1'] = 'models'
			request.session['pagina2'] = 'modelx'
			request.session['pagina3'] = 'model3'
			request.session['pagina1text'] = 'TESLA MODEL S'
			request.session['pagina2text'] = 'TESLA MODEL X'
			request.session['pagina3text'] = 'TESLA MODEL 3'

			return redirect('user')
			
	else:
		return redirect('index')
		
def alter(request):

	user = request.session['user']

	form = registerForm(request.POST)

	if form.is_valid():
		user = form.cleaned_data['user']
		name = form.cleaned_data['nm']
		pwd = form.cleaned_data['pwd']
		ct = form.cleaned_data['ct']
		models = form.cleaned_data['models']

		db = PickleShareDB('/vagrant/Practicas/sitio_web/tesla.db')
		db[user] = { 'user': user, 'name': name, 'pwd': pwd, 'ct': ct, 'models': models }

		request.session['user'] = user
		request.session['pagina1'] = 'models'
		request.session['pagina2'] = 'modelx'
		request.session['pagina3'] = 'model3'
		request.session['pagina1text'] = 'TESLA MODEL S'
		request.session['pagina2text'] = 'TESLA MODEL X'
		request.session['pagina3text'] = 'TESLA MODEL 3'

	return redirect('user')

		
def profile(request):

	db = PickleShareDB('/vagrant/Practicas/sitio_web/tesla.db')

	user = request.session['user']

	if request.session.has_key('user'):
		usern = db[user]['user']
		nm = db[user]['name']
		pwd = db[user]['pwd']
		ct = db[user]['ct']
		models = db[user]['models']
		
		context = {
			'user': usern,
			'name': nm,
			'pwd': pwd,
			'ct': ct,
			'models': models
			}

		return render(request, 'profile.html', context)

	else:
		return redirect ('index')
   
   
def user(request):

	user = request.session['user']

	if request.session.has_key('user'):
		if request.session['user'] == user:
			request.session['pagina3'] = request.session['pagina2']
			request.session['pagina2'] = request.session['pagina1']
			request.session['pagina1'] = 'user'
			request.session['pagina3text'] = request.session['pagina2text']
			request.session['pagina2text'] = request.session['pagina1text']
			request.session['pagina1text'] = 'INICIO: ' + user

	context = {
		'user': user
		}
	return render(request, 'user.html', context)