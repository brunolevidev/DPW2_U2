<?php 
include './templates/loadenvvars.php'; 
if(isset($_COOKIE['id_usuario'])){
    header('Location: http://'.$base_url.'/dashboard.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    unset($_SESSION['errors']);
    unset($_SESSION['success']);
    unset($_SESSION['dberror']);

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido_paterno = isset($_POST['apellido_paterno']) ? $_POST['apellido_paterno'] : '';
    $apellido_materno = isset($_POST['apellido_materno']) ? $_POST['apellido_materno'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmar_password = isset($_POST['confirmar_password']) ? $_POST['confirmar_password'] : '';

    if(
        $nombre == '' ||
        $apellido_paterno == '' ||
        $apellido_materno == '' ||
        $password == '' ||
        $confirmar_password == '' 
        ){
        $_SESSION['errors'] = 'El formulario no puede contener campos vacíos';
    } else {

        if(!$password == $confirmar_password){
            $_SESSION['errors'] = 'La contraseña no coincide';
        } else {

            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]$/", $password) && strlen($password) < 8){
                $_SESSION['errors'] = 'La contraseña debe contener por lo menos 8 caracteres, una mayúscula, un número y un símbolo especial';
            } else {

                try {
                    $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->prepare("INSERT INTO pacientes(nombre, apellido_paterno, apellido_materno, password) VALUES (:nombre, :apellido_paterno, :apellido_materno, :password)");

                    $stmt->bindParam(':nombre', $nombre);
                    $stmt->bindParam(':apellido_paterno', $apellido_paterno);
                    $stmt->bindParam(':apellido_materno', $apellido_materno);
                    $stmt->bindParam(':password', $password);

                    $stmt->execute();

                    $_SESSION['success'] = 'Paciente agregado con éxito!' . ' tu id de paciente es: ' . $db->lastInsertId();

                    $db = null;

                } catch (PDOException $e){
                    $_SESSION['dberror'] = $e->getMessage();
                }
            }
        }
    }
}

?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<h1>Registro de paciente</h1>
<form action="/registro-paciente.php" method="post" enctype="multipart/form-data">
    <div>
        <?php echo isset($_SESSION['errors']) ? $_SESSION['errors'] : ''; ?>
        <?php echo isset($_SESSION['success']) ? $_SESSION['success'] : ''; ?>
        <?php echo isset($_SESSION['dberror']) ? $_SESSION['dberror'] : ''; ?>
    </div>
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
    </div>
    <div>
        <label for="apellido_paterno">Apellido paterno</label>
        <input type="text" name="apellido_paterno" id="apellido_paterno">
    </div>
    <div>
        <label for="apellido_materno">Apellido materno</label>
        <input type="text" name="apellido_materno" id="apellido_materno">
    </div>
    <div>
        <label for="contraseña">Contraseña</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="confirmar_contraseña">Confirmar contraseña</label>
        <input type="password" name="confirmar_password" id="confirmar_password">
    </div>
    <div>
        <button type="submit">Registrarse como paciente</button>
    </div>
</form>
<?php include './templates/footer.php'; ?>