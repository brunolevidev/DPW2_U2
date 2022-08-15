<?php
include './templates/loadenvvars.php'; 
include './templates/valida-sesion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    unset($_SESSION['errors']);
    unset($_SESSION['success']);
    unset($_SESSION['dberror']);

    $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $hora = isset($_POST['hora']) ? $_POST['hora'] : '';
    $id_cita = isset($_POST['id_cita']) ? $_POST['id_cita'] : '';

    if(
        $id_paciente == '' ||
        $fecha == '' ||
        $hora == '' ||
        $id_cita == ''
        ){
        $_SESSION['errors'] = 'El formulario no puede contener campos vacíos';
    } else {
        try {
            $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("UPDATE citas SET id_paciente = :id_paciente, fecha = :fecha, hora = :hora WHERE id = :id_cita");

            $stmt->bindParam(':id_paciente', $id_paciente);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':id_cita', $id_cita);

            $stmt->execute();

            header('Location: http://'.$base_url.'/consulta-cita.php');

            $db = null;

        } catch (PDOException $e){
            $_SESSION['dberror'] = $e->getMessage();
        }
    }
}

?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<h1>Modificar cita!</h1>
<form action="/modificar-cita.php" method="post" enctype="multipart/form-data">
    <div>
        <?php echo isset($_SESSION['errors']) ? $_SESSION['errors'] : ''; ?>
        <?php echo isset($_SESSION['success']) ? $_SESSION['success'] : ''; ?>
        <?php echo isset($_SESSION['dberror']) ? $_SESSION['dberror'] : ''; ?>
    </div>
    <input type="hidden" name="id_cita" id="id_cita" value="<?php echo $_GET['id_cita']; ?>">
    <?php 
    if($_COOKIE['tipo_usuario'] == 'medicos'){ 
        try {
            $id_cita = $_GET['id_cita'];
            $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT * FROM citas WHERE id = :id_cita");
            $stmt->bindParam(':id_cita', $id_cita);
            $stmt->execute();
            $cita = $stmt->fetch();
    
            ?>
            <div>
                <label for="paciente">Paciente</label>
                <select name="id_paciente" id="id_paciente">
                <?php 
                try {
                    $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $db->prepare("SELECT * FROM pacientes");
                    $stmt->execute();
                    $pacientes = $stmt->fetchAll();
            
                    foreach($pacientes as $paciente){
                        ?>
                        <option value="<?php echo $paciente['id']?>"><?php printf('%s %s %s', $paciente['nombre'], $paciente['apellido_paterno'], $paciente['apellido_materno']) ?></option>
                        <?php
                    }

                    $db = null;

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
                </select>
            </div>
            <div>
                <label for="fecha">Fecha de la cita</label>
                <input type="text" name="fecha" id="fecha" placeholder="22-08-25" value="<?php echo $cita['fecha']?>">
            </div>
            <div>
                <label for="hora">Hora de la cita</label>
                <input type="text" name="hora" id="hora" placeholder="08:15" value="<?php echo $cita['hora']?>">
            </div>
            <div>
                <button type="submit">Modificar cita</button>
            </div>
            <?php

            $db = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    } ?>
<?php include './templates/footer.php'; ?>