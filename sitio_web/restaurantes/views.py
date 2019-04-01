from django.shortcuts import render, HttpResponse, redirect
from .models import restaurantes
from .forms import searchForm
from pymongo import cursor

def index(request):

	context = {
	
	}
	return render(request, 'restaurantes.html', context)

def buscar(request):

	form = searchForm(request.POST)
	
	if form.is_valid():
		nombre = form.cleaned_data['nombre']

		respuesta = restaurantes.find( {"name": nombre} )

		rst = "No existe dicho restaurante"

		if (respuesta.count() > 0):
			rst = respuesta[0]
		
		context = {
			"tipo": "1",
			"restaurante": rst,
		}
		
		return render(request, 'result.html', context)
		
	else:
		return redirect('index')

def aniadir(request):

	form = searchForm(request.POST)
	
	if form.is_valid():
		nombre = form.cleaned_data['nombre']

		respuesta = restaurantes.insert( nombre )

		rst = "No se ha podido insertar dicho restaurante"

		if (respuesta.count() > 0):
			rst = respuesta[0]
		
		context = {
			"tipo": "2",
			"restaurante": rst,
		}
		
		return render(request, 'result.html', context)
	
	else:
		return redirect('index')

def borrar(request):

	form = searchForm(request.POST)
	
	if form.is_valid():
		nombre = form.cleaned_data['nombre']

		respuesta = restaurantes.deleteOne( {"name": nombre} )

		rst = "No se ha podido borrar dicho restaurante"

		if (respuesta.count() > 0):
			rst = respuesta[0]
		
		context = {
			"tipo": "3",
			"restaurante": rst,
		}
		
		return render(request, 'result.html', context)
	
	else:
		return redirect('index')