<?php
require './templates/loadenvvars.php';

if(isset($_COOKIE['id_usuario'])){
    setcookie('id_usuario', '', time() - 3600, "/");
    setcookie('tipo_usuario', '', time() - 3600, "/");
    header('Location: http://'.$base_url.'/iniciar-sesion.php');
}