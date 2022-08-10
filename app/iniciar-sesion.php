<?php
require './templates/loadenvvars.php';
if(isset($_COOKIE['id_usuario'])){
    header('Location: http://'.$base_url.'/dashboard.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    unset($_SESSION['errors']);

    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';

    if($usuario == '' || $password == ''){
        $_SESSION['errors'] = 'El formulario no puede estar vacío';
    }

    try {
        $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM $tipo_usuario WHERE id = :id");

        $stmt->bindParam(':id', $usuario);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario == $row['id'] && $password == $row['password']){
            setcookie('id_usuario', $row['id'], time() + (86400 * 30), "/");
            header('Location: http://'.$base_url.'/dashboard.php');
        }
        else {
            $_SESSION['errors'] = 'El usuario o la contraseña son incorrectos';
        }

        $db = null;

    } catch (PDOException $e){
        $_SESSION['dberror'] = $e->getMessage();
    }
}
?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<h1>Inicio de sesión</h1>
<form action="/iniciar-sesion.php" method="post" enctype="multipart/form-data">
    <div>
        <?php echo isset($_SESSION['errors']) ? $_SESSION['errors'] : ''; ?>
        <?php echo isset($_SESSION['success']) ? $_SESSION['success'] : ''; ?>
        <?php echo isset($_SESSION['dberror']) ? $_SESSION['dberror'] : ''; ?>
    </div>
    <div>
        <label for="usuario">ID Usuario</label>
        <input type="text" name="usuario" id="usuario">
    </div>
    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="tipo_usuario">Tipo de usuario</label>
        <select name="tipo_usuario" id="tipo_usuario">
            <option value="pacientes">Paciente</option>
            <option value="medicos">Médico</option>
        </select>
    </div>
    <div>
        <button type="submit">Iniciar sesión</button>
    </div>
</form>
<?php include './templates/footer.php'; ?>