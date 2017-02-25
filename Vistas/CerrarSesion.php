<?php
session_start();
include_once '../DAO/Registro/Usuario.php';
$usuario2 = new Usuario();
$usuario2->setId($_SESSION['id_username']);
$usuario2->desconectado($usuario2);
session_destroy();

/* liberarán las variables de sesión registradas, quitandoles el valor contenido en ellas
si no se hace esto aunque la pagina sea cerrada siempre conservaran su valor y cualquier
persona podra ingresar a la sesion*/
unset($_SESSION["usuario"]);
unset($_SESSION["password"]);

//libera la sesion

session_unset();

//dirigirse a la pagina que se desea ver
echo "<script>document.location.href='login.php';</script>";
               