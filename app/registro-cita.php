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
    $id_medico = isset($_POST['id_medico']) ? $_POST['id_medico'] : '';

    if(
        $id_paciente == '' ||
        $fecha == '' ||
        $hora == '' ||
        $id_medico == ''
        ){
        $_SESSION['errors'] = 'El formulario no puede contener campos vacíos';
    } else {
        try {
            $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("INSERT INTO citas(id_paciente, fecha, hora, id_medico) VALUES (:id_paciente, :fecha, :hora, :id_medico)");

            $stmt->bindParam(':id_paciente', $id_paciente);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':id_medico', $id_medico);

            $stmt->execute();

            $_SESSION['success'] = 'Cita agendada con éxito!';

            $db = null;

        } catch (PDOException $e){
            $_SESSION['dberror'] = $e->getMessage();
        }
    }
}

?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<h1>Registro cita!</h1>
<form action="/registro-cita.php" method="post" enctype="multipart/form-data">
    <div>
        <?php echo isset($_SESSION['errors']) ? $_SESSION['errors'] : ''; ?>
        <?php echo isset($_SESSION['success']) ? $_SESSION['success'] : ''; ?>
        <?php echo isset($_SESSION['dberror']) ? $_SESSION['dberror'] : ''; ?>
    </div>
    <?php if($_COOKIE['tipo_usuario'] == 'medicos'){ ?>
    <div>
        <label for="paciente">Paciente</label>
        <select name="id_paciente" id="id_paciente">
        <?php 
        try {
            $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT * FROM pacientes");
            $stmt->execute();
            $rows = $stmt->fetchAll();
    
            foreach($rows as $row){
                ?>
                <option value="<?php echo $row['id']?>"><?php printf('%s %s %s', $row['nombre'], $row['apellido_paterno'], $row['apellido_materno']) ?></option>
                <?php
            }

            $db = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        </select>
    </div>
        <?php
    } else if($_COOKIE['tipo_usuario'] == 'pacientes'){
        ?>
        <input type="hidden" name="id_paciente" id="id_paciente" value="<?php echo $_COOKIE['id_usuario']; ?>">
        <?php
    }
    ?>
    <div>
        <label for="fecha">Fecha de la cita</label>
        <input type="text" name="fecha" id="fecha" placeholder="22-08-25">
    </div>
    <div>
        <label for="hora">Hora de la cita</label>
        <input type="text" name="hora" id="hora" placeholder="08:15">
    </div>
    <?php if($_COOKIE['tipo_usuario'] == 'medicos') {?>
        <input type="hidden" name="id_medico" id="id_medico" value="<?php echo $_COOKIE['id_usuario']; ?>">
    <?php } else if ($_COOKIE['tipo_usuario'] == 'pacientes') { ?>
    <div>
        <label for="medico">Médico</label>
        <select name="id_medico" id="id_medico">
        <?php 
        try {
            $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT * FROM medicos");
            $stmt->execute();
            $rows = $stmt->fetchAll();
    
            foreach($rows as $row){
                ?>
                <option value="<?php echo $row['id']?>"><?php printf('%s %s %s', $row['nombre'], $row['apellido_paterno'], $row['apellido_materno']) ?></option>
                <?php
            }

            $db = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        ?>
        </select>
    </div>
    <?php  } ?>
    <div>
        <button type="submit">Generar cita</button>
    </div>
</form>
<?php include './templates/footer.php'; ?>