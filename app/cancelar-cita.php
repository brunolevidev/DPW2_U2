<?php
include './templates/loadenvvars.php'; 
include './templates/valida-sesion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    unset($_SESSION['errors']);
    unset($_SESSION['success']);
    unset($_SESSION['dberror']);

    $id_cita = isset($_POST['id_cita']) ? $_POST['id_cita'] : '';

    if($id_cita == ''){
        echo 'El formulario no puede contener campos vacíos';
    } else {
        try {
            $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("DELETE FROM citas WHERE id = :id_cita");

            $stmt->bindParam(':id_cita', $id_cita);

            $stmt->execute();

            ?>
            <h1>Cita eliminada con éxito!</h1>
            <a href="/consulta-cita.php">Regresar</a>
            <?php

            $db = null;

        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}

?>