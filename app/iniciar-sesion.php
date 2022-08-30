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
    } else {
        try {
            $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $stmt = $db->prepare("SELECT * FROM $tipo_usuario WHERE id = :id");
    
            $stmt->bindParam(':id', $usuario);
    
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if($usuario == $row['id'] && $password == $row['password']){
                setcookie('id_usuario', $row['id'], time() + (86400 * 30), "/");
                setcookie('tipo_usuario', $tipo_usuario, time() + (86400 * 30), "/");
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

}
?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<div class="container pt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6">
            <form action="/iniciar-sesion.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Inicio de sesión</h5>
                    </div>
                    <div class="card-body">
                    <?php 
                        if(isset($_SESSION['errors'])) {
                            ?>
                            <div class="p-2">
                                <div class="alert alert-danger">
                                    <?php echo $_SESSION['errors'];?>
                                </div>
                            </div>
                            <?php
                        } ?>
                        <?php 
                        if(isset($_SESSION['success'])) {
                            ?>
                            <div class="p-2">
                                <div class="alert alert-success">
                                    <?php echo $_SESSION['success'];?>
                                </div>
                            </div>
                            <?php
                        } ?>
                        <?php 
                        if(isset($_SESSION['dberror'])) {
                            ?>
                            <div class="p-2">
                                <div class="alert alert-warning">
                                    <?php echo $_SESSION['dberror'];?>
                                </div>
                            </div>
                            <?php
                        } ?>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">ID Usuario</label>
                            <input type="text" class="form-control" name="usuario" id="usuario">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="tipo_usuario" class="form-label">Tipo de usuario</label>
                            <select name="tipo_usuario" id="tipo_usuario" class="form-select">
                                <option value="pacientes">Paciente</option>
                                <option value="medicos">Médico</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include './templates/footer.php'; ?>