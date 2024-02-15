<img width="383" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/ac79eb09-4d0a-4307-8103-069c0cbcd435">
<img width="471" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/11700527-c29b-4293-b9cd-44981a6d7529">
Archivo de la API con el cual interactua tanto con el JavaScript como con la BBDD para poder pasar informacion y poder mostrarla al usuario.

COMENTARIOS:

<img width="492" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/dd8864f1-56e7-4758-8483-9968e7d4e6b7">





Archivo JS de los comentarios en el cual en esta primera parte hacemos la solicitud a la API para poder recoger en este caso todos los datos necesarios de los comentarios,
y mostrandolos con la funcion "mostrarComentarios()", añadimos tambien varios EventListener los cuales seran los encargados de comprobar la parte de los filtros de los comentarios
donde los usuarios podran ordenar de forma ascendete o descendente o por puntuacion los comentarios que se muestran.


<img width="439" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/6f0a778c-b68b-4354-a24e-ba20bc4af001">





La primera funcion es la encargada de mostrar los comentarios en la pagina que corresponde, en la funcion recogemos los datos que le llegan desde la API.
En esta primero limpiamos el lugar donde pondremos lo comentarios con el .removeChild, posteriormente itineramos sobre los comentarios y creamos los elementos HTML necesarios para mostrar los comentarios.
La funcion "ordenarComentarios()" es la encargada de ordenar los comentarios de forma Ascendete o Descendente segun lo seleccione el usuario, para hacerlo cogemos los comentarios y el orden (ascendente o descendete),
con .slice().sort() los ordenamos segun la calificacion.


<img width="462" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/77f7e2fe-e859-4cd5-8a5c-a54790bcf820">




La funcion "filtrarPorPuntuacion()" a la que le pasamos los comentarios y el valor de puntuacion que se quiere mostrar, hara que se guarde en un array todos los comentarios que coincidan con el valor de puntuacion que el 
usuario ha escogido en la pagina. "aplicarFiltro()" es la funcion que controla las ultimas dos funciones llamandolas y luego llamando a la funcion de mostrar.
La funcion de flecha "generarEstrellas()" es la que controla el mostrar la puntuacion en forma de estrella, pasandole la puntuacion del comentario y haciendo un bucle con .repeat() en funcion de la cantidad.


BOTON AÑADIR COMENTARIO:
En este JS controlaremos el mostrar en los pedidos si ya se ha añadido un comentario o no.


<img width="368" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/a5a1f2ec-ba84-427b-b0f2-9232fbdb8503">



En este archivo JS controlamos el mostrar o esconder el boton para añadir comentario o un mensaje informando que ya se ha añadido un comentario, para ello hacemos una peticion a la API que nos devolvera un true o un false directamente desde la sentencia SQL 
para validar si hay o no un ID de comentario relacionado en el ID del pedido para poder entonces esconder uno u otro boton que controlamos con el .remove() del querySelector del boton que hemos añadido en la vista
