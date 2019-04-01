#Practicas DAI. Ejercicio 1.
#Adivinar numero entre 1 y 100 (max 10 intentos).
#Se mostrara ayuda en cada intento fallido

from random import randrange

print ("Mini-juego de prueba. Adivine un numero aleatorio entre 1 y 100\n\n")
print ("Que comienze el juego!!!\n")

numero = randrange(1, 100)
intentos = 10

prueba = int(input("Prueba con un numero: "))

while prueba != numero and intentos > 0:
    if prueba > numero:
        print ("Fallaste perla. El numero que buscas es mas pequeño...\n")
        print ("Quedan ", intentos, " intentos\n")
        prueba = int(input("Prueba otra vez: "))

    else:
        print ("Fallaste perla. El numero que buscas es mas grande...\n")
        print ("Quedan ", intentos, " intentos\n")
        prueba = int(input("Prueba otra vez: "))

    intentos -= 1

if intentos == 0 and prueba != numero:
    print ("\n\nEsto no se te da bien, mejor dedicate a otra cosa...\n")

else:
    print ("\n\nMuy bien! Eres un maquina en esto de adivinar numeros\n")

