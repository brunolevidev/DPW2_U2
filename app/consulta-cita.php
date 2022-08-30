<?php include './templates/loadenvvars.php'; ?>
<?php include './templates/valida-sesion.php'; ?>
<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-4">
      <div class="card">
        <img src="./assets/img/medica_sur-1140x570.jpg" class="card-img-top" alt="centro medico bv">
        <div class="card-header">
          <h5 class="card-title">Especialidades</h5>
        </div>
        <div class="card-body">
          <div class="accordion accordion-flush" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Medicina interna
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  La Medicina Interna es una de las 4 ramas básicas en que se ha dividido desde el punto de vista clínico, la atención a los pacientes. Resulta fundamental en la estructura de los Hospitales de 2do. y 3er. nivel.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Otorrinolaringología
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Somos una unidad especializada en la atención oportuna, honesta y responsable, de los pacientes con padecimientos de oídos, nariz y garganta y/o que requieran cirugía de cabeza y cuello.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Oncología
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                Atención medica-quirúrgica, radioterapia y quimioterapia a pacientes con tumores.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Oftalmología
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Atención médica y quirúrgica a pacientes con padecimientos de los ojos.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-primary">Más información</button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8">
      <h1 class="mb-5">Consulta cita</h1>
      <?php if($_COOKIE['tipo_usuario'] == 'pacientes') {?>
      <table class="table table-striped table-striped-columns table-hover">
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
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include './templates/footer.php'; ?>