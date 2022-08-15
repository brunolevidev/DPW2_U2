<?php include './templates/loadenvvars.php'; ?>
<?php include './templates/valida-sesion.php'; ?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<?php 

try {
    $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tipo_usuario = $_COOKIE['tipo_usuario'];

    $stmt = $db->prepare("SELECT * FROM $tipo_usuario WHERE id = :id");

    $stmt->bindParam(':id', $_COOKIE["id_usuario"]);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    
    <h1>Bienvenido <?php echo $row['nombre'] . " " . $row['apellido_paterno']  . " " .  $row['apellido_materno'] . " Has ingresado como: " .  $tipo_usuario?></h1>
    
    <?php

    $db = null;

} catch (PDOException $e){
    $_SESSION['dberror'] = $e->getMessage();
}

?>

<?php include './templates/footer.php'; ?>