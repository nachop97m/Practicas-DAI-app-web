#Practicas DAI. Ejercicio 2.
#Comparar algoritmos de ordenacion: Burbuja y Merge Sort

from random import randrange
from time import time

def ordenamientoBurbuja(unaLista):
    
    for numPasada in range(len(unaLista)-1,0,-1):

        for i in range(numPasada):

            if unaLista[i]>unaLista[i+1]:

                temp = unaLista[i]
                unaLista[i] = unaLista[i+1]
                unaLista[i+1] = temp



def mergeSort(alist):

    if len(alist)>1:
        mid = len(alist)//2
        lefthalf = alist[:mid]
        righthalf = alist[mid:]

        mergeSort(lefthalf)
        mergeSort(righthalf)

        i=0
        j=0
        k=0
        while i < len(lefthalf) and j < len(righthalf):
            if lefthalf[i] < righthalf[j]:
                alist[k]=lefthalf[i]
                i=i+1
            else:
                alist[k]=righthalf[j]
                j=j+1
            k=k+1

        while i < len(lefthalf):
            alist[k]=lefthalf[i]
            i=i+1
            k=k+1

        while j < len(righthalf):
            alist[k]=righthalf[j]
            j=j+1
            k=k+1
            

lista1 = []
lista2 = []
lista3 = []

for contador in range(0, 1000):
    lista1.insert(contador, randrange(1,1000))
    lista2.insert(contador, randrange(1,1000))
    lista3.insert(contador, randrange(1,1000))

print("\nLos tiempos de ejecucion para el algortimo de la Burbuja son:\n")

start_t = time()

ordenamientoBurbuja(lista1)

exe_t = time() - start_t

print("Lista 1: ", exe_t,"\n")

start_t = time()

ordenamientoBurbuja(lista2)

exe_t = time() - start_t

print("Lista 2: ", exe_t,"\n")

start_t = time()

ordenamientoBurbuja(lista3)

exe_t = time() - start_t

print("Lista 3: ", exe_t,"\n")

print("===================================================\n")
print("Los tiempos de ejecucion para el algoritmo Merge Sort son:\n")

start_t = time()

mergeSort(lista1)

exe_t = time() - start_t

print("Lista 1: ", exe_t,"\n")

start_t = time()

mergeSort(lista2)

exe_t = time() - start_t

print("Lista 2: ", exe_t,"\n")

start_t = time()

mergeSort(lista3)

exe_t = time() - start_t

print("Lista 3: ", exe_t,"\n")
