# Projecte JavaScript

# Descripción del proyecto

Proyecto el cual añade nuevas funcionalidades web creadas con JS al proyecto 1 del curso con HTML, CSS y PHP

- [API](#API)
- [COMENTARIOS](#Comentarios)
- [AÑADIR COMENTARIO](#Añadir-comentario)
- [FORMULARIO](#Formulario)
- [DESCUENTO Y PROPINA](#Descuento-y-propina)
- [FILTRO PRODUCTOS](#Filtro-productos)
- [MOSTRAR QR](#Mostrar-QR)
- [ERRORES ENCONTRADOS](#Errores-encontrados)

## API

<img width="383" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/ac79eb09-4d0a-4307-8103-069c0cbcd435">
<img width="471" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/11700527-c29b-4293-b9cd-44981a6d7529">

Archivo de la API con el cual interactua tanto con el JavaScript como con la BBDD para poder pasar informacion y poder mostrarla al usuario.

## Comentarios

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


## Añadir comentario

En este JS controlaremos el mostrar en los pedidos si ya se ha añadido un comentario o no.


<img width="368" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/a5a1f2ec-ba84-427b-b0f2-9232fbdb8503">



En este archivo JS controlamos el mostrar o esconder el boton para añadir comentario o un mensaje informando que ya se ha añadido un comentario, para ello hacemos una peticion a la API que nos devolvera un true o un false directamente desde la sentencia SQL 
para validar si hay o no un ID de comentario relacionado en el ID del pedido para poder entonces esconder uno u otro boton que controlamos con el .remove() del querySelector del boton que hemos añadido en la vista.


## Formulario

En este JS recogeremos todos los datos que el usuario especifica en el formulario para añadir un comentario en el pedido.


<img width="416" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/473cb6bd-e042-47fa-908e-f295bd970bfa">



Tenemos un fetch que lo usaremos para pasarle todos los datos que hemos añadido en el formulario. Notificamos al usuario si el comentario se ha añadido correctamente con notieAlert.



## Descuento y propina

En este JS se ha tenido que fusionar dos funcionalidades en un unico archivo para poder usar variables y poder hacer que los valores tanto de un lugar se actualicen como deberian y poder usar las dos funcionalidades a la vez y que no haya errores.



<img width="605" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/7d243a51-2401-495f-8473-9aafd68dbda7">





En la primera parte del JS haremos una llamada a la API para poder recoger de la BBDD los puntos que tiene el usuario logeado aparte, recogemos valores de la pagina que nos haran falta mas tarde.



<img width="641" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/133930dc-3e8f-44f5-bbd8-c8798563d756">



Tendremos diferentes comparaciones y comprobaciones para tener controlado el uso de la pagina y su comportamiento, para hacer los calculos.


<img width="329" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/77b5294f-836c-4351-8d1b-b7343847ad86">

Funcion que usamos para mostrar los puntos del usuario que hemos recogido por la API.


<img width="488" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/6dc94dab-83e5-424f-b102-652fe312f74a">



Esta funcion actualizarPrecio() es la encargada de controlar y actualizar el precio del pedido cada vez que se cambia un valor en el carrito ya sea de propina o de puntos de descuento, ademas de dejar varios registros y valores para su uso posterior en el PHP.


## Filtro productos

En este JS controlaremos que el usuario pueda filtrar los productos del carrito por categorias.




<img width="365" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/fc64b57b-ed50-42cc-a048-0fc8efddd8d3">


Esta es una parte del codigo JS en el cual cogemos varios valores para poder hacer luego las comprobaciones muy parecidas a las que hacemos con los comentarios cogiendo el valor del checkbox. Tambien usamos en este punto el localStorage para que se quede guardado el valor del filtro siempre que el usuario salga de la carta y vuelva a entrar.




## Mostrar QR

En este JS haremos que cada vez que el usuario finalice el pedido le aparezca en un pop-up con un QR en el cual podra ver los detalles del pedido que ha realizado y cuando el usuario cierre el pop-up sea redireccionado como deberia.

<img width="557" alt="image" src="https://github.com/Mist3r20/ProyectoRestauracionGT_Nos/assets/148121356/67ded5b1-3ca1-453a-853b-6ab103734f09">


Para ello hemos agregado una libreria de QR para poder generarlo y sacarlo con sweetAlert.



## Errores encontrados

Durante la realizacion del proyecto me he ido encontrando una gran variedad de errores, he estado tiempo pensando y arreglando problemas con la API y el fetch intentando hacer que los datos se pasaran y se recogieran correctamente, tambien he tenido que lidiar con errores al mostrar los comentarios, tambien he tenido muchos problemas con el formulario ya que no era capaz de pasar el formato de dato correcto, con el descuento y la propina estuve muchisimo tiempo ya que era algo que tuve que darle mas vueltas y me costo encontrar la forma de actualizar los datos cada vez que actualizaba un input tambien como podia volver al valor inicial si reseteaba los input teniendo que guardar muchas variables y por ultimo donde encontre muchos problemas ha sido en el QR descubrir como hacerlo, ser capaz de mostrar un QR como es debido usando la libreria, luego intentar añadirlo con un pop-up haciendo que no se redireccione antes de que el usuario cierre el pop-up ademas de todo el tema del QR para poder pasarle la ID del usuario y luego poder mostrar los datos.





