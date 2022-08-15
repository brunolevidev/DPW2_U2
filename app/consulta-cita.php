<?php include './templates/loadenvvars.php'; ?>
<?php include './templates/valida-sesion.php'; ?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<h1>Consulta cita!</h1>
<?php if($_COOKIE['tipo_usuario'] == 'pacientes') {?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID Cita</th>
      <th scope="col">Fecha</th>
      <th scope="col">Hora</th>
      <th scope="col">Médico</th>
      <th scope="col">Especialidad</th>
      <th scope="col">Consultorio</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    
    try {
        $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT c.id, c.fecha, c.hora, m.nombre, m.apellido_paterno, m.especialidad, m.consultorio FROM citas AS c INNER JOIN medicos AS m ON c.id_medico=m.id WHERE c.id_paciente = :id_paciente");
        $stmt->bindParam(':id_paciente', $_COOKIE['id_usuario']);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            ?>
                <tr>
                    <th scope="row"><?php echo $row['id']?></th>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['fecha']?></td>
                    <td><?php echo $row['hora']?></td>
                    <td><?php printf('%s %s', $row['nombre'], $row['apellido_paterno'])?></td>
                    <td><?php echo $row['especialidad']?></td>
                    <td><?php echo $row['consultorio']?></td>
                </tr>
            <?php
        }

        $db = null;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    ?>

  </tbody>
</table>
<?php } else if ($_COOKIE['tipo_usuario'] == 'medicos') { ?>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID Cita</th>
      <th scope="col">Fecha</th>
      <th scope="col">Hora</th>
      <th scope="col">Paciente</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    
    try {
        $db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT c.id, c.fecha, c.hora, p.nombre, p.apellido_paterno FROM citas AS c INNER JOIN pacientes AS p ON c.id_paciente=p.id WHERE c.id_medico = :id_paciente");
        $stmt->bindParam(':id_paciente', $_COOKIE['id_usuario']);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            ?>
                <tr>
                    <th scope="row"><?php echo $row['id']?></th>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['fecha']?></td>
                    <td><?php echo $row['hora']?></td>
                    <td><?php printf('%s %s', $row['nombre'], $row['apellido_paterno'])?></td>
                    <td>
                        <a href="/modificar-cita.php?id_cita=<?php echo $row['id']?>">Modificar cita</a>
                    </td>
                    <td>
                        <form action="/cancelar-cita.php" method="post" enctype="application/x-www-form-urlencoded">
                            <input type="hidden" name="id_cita" id="id_cita" value="<?php echo $row['id']?>">
                            <button type="submit">Cancelar cita</button>
                        </form>
                    </td>
                </tr>
            <?php
        }

        $db = null;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    ?>

  </tbody>
</table>

<?php } ?>

<?php include './templates/footer.php'; ?>