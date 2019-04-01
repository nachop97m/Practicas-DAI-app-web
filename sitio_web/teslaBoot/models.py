from pymongo import MongoClient

client = MongoClient()
db = client.test                  # base de datos
tesla = db['tesla']   # colección