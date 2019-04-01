#Practicas DAI. Ejercicio 3.
#Criba de Eratostenes

n = int(input("Algoritmo criba de Eratostenes.\nIntroduzca un numero natural: "))

primos = []

for i in range(2, n):
    primos.append(i)

continuar = 1
primo = 2
siguiente = 1;

while (continuar):
    if (primo < n):
        for j in range(primo, n):
            if (j % primo == 0):
                primos.remove(j)

        primo = primos [siguiente]
    
        if (pow(primo, 2) >= n):
            continuar = 0;

    else:
        continuar = 0

print ("Los primos menores que ", n, " son: ")

for p in primos:
    print(p, " ")
