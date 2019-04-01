from pymongo import MongoClient
from django.db import models
from django.utils import timezone


client = MongoClient()
db = client.test                  # base de datos
restaurantes = db.restaurants     # colección


class Plato(models.Model):
	nombre = models.CharField(max_length=150, primary_key=True)
	tipoCocina = models.CharField(max_length=200)
	alergenos = models.CharField(max_length=200)
	precio = models.CharField(max_length=10)
	tiempo = models.CharField(max_length=5)

	def __str__(self):
		return self.nombre