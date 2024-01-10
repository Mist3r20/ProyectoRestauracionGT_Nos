// Ejercicio 1
// Dado un array de números, utiliza .map() para multiplicar cada elemento del
// array por 2 y devolver un nuevo array con los resultados.
const numeros = [1, 2, 3, 4, 5];

const resultado = numeros.map(numero => numero * 2);

console.log(resultado); 





// Ejercicio 2
// Dado un array que contiene cadenas de texto, utiliza .map() para devolver un
// nuevo array que contenga la longitud de cada cadena.
// const strings = ['hello', 'world', 'how', 'are', 'you'];
const strings = ['hello', 'world', 'how', 'are', 'you'];

const longitudes = strings.map(cadena => cadena.length);

console.log(longitudes); 



// Ejercicio 3
// Dado un array de objetos que representan a personas, utiliza .map() para
// devolver un nuevo array que contenga las edades de cada persona.
// const people = [
// { name: 'Alice', age: 25 },
// { name: 'Bob', age: 30 },
// { name: 'Charlie', age: 35 },
// { name: 'Dave', age: 40 }
// ];

const people = [
  { name: 'Alice', age: 25 },
  { name: 'Bob', age: 30 },
  { name: 'Charlie', age: 35 },
  { name: 'Dave', age: 40 }
];

const edades = people.map(persona => persona.age);

console.log(edades);


// Ejercicio 4
// Dado un array de objetos que representan a personas y una edad mínima,
// utiliza .map() para devolver un nuevo array que contenga solo las personas
// mayores de edad (edad mayor o igual a 18 años).
// const people = [
// { name: 'Alice', age: 25 },
// { name: 'Bob', age: 17 },
// { name: 'Charlie', age: 35 },
// { name: 'Dave', age: 12 }
// ];

const gente = [
  { name: 'Alice', age: 25 },
  { name: 'Bob', age: 17 },
  { name: 'Charlie', age: 35 },
  { name: 'Dave', age: 12 }
];

const edadMinima = 18;

const personasMayores = gente
  .filter(persona => persona.age >= edadMinima)
  .map(persona => ({ name: persona.name, age: persona.age }));

console.log(personasMayores);




// Ejercicio 5
// Escribe una función maximo que tome un array de números y devuelva el
// número máximo del array. Utiliza .reduce para resolver este problema.
function maximo(arr) {
  if (arr.length === 0) {
    return null; 
  }

  const max = arr.reduce((acum, numero) => {
    return numero > acum ? numero : acum;
  }, arr[0]); 

  return max;
}

const num = [10, 20, 5, 40, 30];
console.log(maximo(num)); 



// Ejercicio 6
// Escribe una función invertirCadena que tome un string y devuelva el mismo
// string con las palabras en orden inverso. Utiliza .reduce para resolver este
// problema.
function invertirCadena(cadena){
  const palabras = cadena.split(' ');
  const resultado = palabras.reduce((acumulador, palabra) => {
    return [palabra, ...acumulador];
  }, []);
  return resultado.join(' ');
}

const texto = "Prueba de texto al reves";
const textoInverso = invertirCadena(texto);
console.log(textoInverso);



// Ejercicio 7
// Escribe una función soloPares que tome un array de números y devuelva un
// array con solo los números pares del array original. Utiliza .filter para resolver
// este problema.
function soloPares(numeros){
  const pares = numeros.filter(num => num % 2 === 0);
  return pares;
}

const numerosRandom = [1,2,3,4,5,6,6,7,8,9,9,0,32,445,54];
const numerosPares = soloPares(numerosRandom);
console.log(numerosPares);

// Ejercicio 8
// Escribe una función palabrasLargas que tome un array de palabras y un
// número n, y devuelva un array con solo las palabras del array original que
// tienen más de n caracteres. Utiliza .filter para resolver este problema.
function palabrasLargas(palabras, n){
  const palabrasFiltradas = palabras.filter(palabra => palabra.length > n);
  return palabrasFiltradas;
}

const palabrasOriginales = ["platano", "naranja", "limon", "pera", "manzana", "melon"];
const longitud = 4;
const palabrasResultado = palabrasLargas(palabrasOriginales, longitud);
console.log(palabrasResultado);




// Ejercicio 9
// Escribe una función encontrarPalabra que tome un array de palabras y una
// palabra busqueda, y devuelva la primer palabra del array que sea igual a
// busqueda. Si no se encuentra ninguna palabra igual, la función debe devolver
// null. Utiliza .find para resolver este problema.

function encontrarPalabra(arrayPalabras, palabraBuscar){
  return arrayPalabras.find(palabra => palabra === palabraBuscar) || null
};

const palabrasParaBuscar = ["cereza", "montaña", "velero", "libélula", "playa", "unicornio"];

let palabraBuscar = "velero";
const result = encontrarPalabra(palabrasParaBuscar, palabraBuscar);
console.log(result);




// Ejercicio 10
// Escribe una función contarVocales que tome un string y devuelva la cantidad
// de vocales que hay en el string. Utiliza .reduce para resolver este problema.

function contarVocales(string){
  const vocales = ['a','e','i','o','u'];
  return string.split('').reduce((count, char) => {
    if(vocales.includes(char.toLowerCase())){
      return count + 1;
    }
    return count;
  },0);
}

const cantidadVocales = contarVocales("A ver cuantas vocales es capaz de sacar esta funcion");
console.log(cantidadVocales);