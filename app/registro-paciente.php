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
<div class="container pt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6">
            <form action="/registro-paciente.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Registro de paciente</h5>
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
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="apellido_paterno" class="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno">
                        </div>
                        <div class="mb-3">
                            <label for="apellido_materno" class="form-label">Apellido materno</label>
                            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno">
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="confirmar_contraseña" class="form-label">Confirmar contraseña</label>
                            <input type="password" class="form-control" name="confirmar_password" id="confirmar_password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Registrarse como paciente</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include './templates/footer.php'; ?>