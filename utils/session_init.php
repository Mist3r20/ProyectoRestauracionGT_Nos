<?php

//Codigo que comprueba si la session esta iniciada, si no es asi la inicia.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>