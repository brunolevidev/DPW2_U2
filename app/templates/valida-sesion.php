<?php
if(!isset($_COOKIE['id_usuario'])){
    header('Location: http://'.$base_url.'/iniciar-sesion.php');
}