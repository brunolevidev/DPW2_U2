<?php include './templates/head.php'; ?>
<?php include './templates/navbar.php'; ?>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./assets/img/doctor.jpg" class="img-fluid" alt="Tenemos a los mejores especialistas">
      <div class="carousel-caption d-none d-md-block">
        <h5>Tenemos a los mejores especialistas</h5>
        <p>El selecto equipo de especialistas de nuestra Torre de Consultorios, te brindan la confianza y el profesionalismo que necesitas para atender tu salud</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./assets/img/enfermera.jpg" class="img-fluid" alt="Nuestro personal de enfermería te harán sentir en casa">
      <div class="carousel-caption d-none d-md-block">
        <h5>Nuestro personal de enfermería te harán sentir en casa</h5>
        <p>Contamos con el mejor equipo de enfermería para brindarte confianza y comodidad</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./assets/img/microscopio.jpg" class="img-fluid" alt="Contamos con tecnología de punta">
      <div class="carousel-caption d-none d-md-block">
        <h5>Contamos con tecnología de punta</h5>
        <p>Somos líderes en la adquisición de las mejores tecnologías para atender tu salud</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
</div>

<div class="container mt-5">
    <h1 class="text-center my-5">Servicios</h1>
    <div class="row justify-content-center align-items-center bg-blue-100 gx-0 gy-0 my-5">
        <div class="col-12 order-1 col-md-4 order-md-1">
            <img src="./assets/img/servicios/medicina_interna.jpg" alt="Medicina interna" class="img-fluid shadow">
        </div>
        <div class="col-12 order-2 col-md-8 order-md-2">
          <div class="text-center text-md-start mt-3 mt-md-0 ms-0 ms-md-4">
            <h3>Medicina interna</h3>
            <p>
            La Medicina Interna es una de las 4 ramas básicas en que se ha dividido desde el punto de vista clínico, la atención a los pacientes. Resulta fundamental en la estructura de los Hospitales de 2do. y 3er. nivel.
            </p>
          </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center gx-0 gy-0 my-5">
        <div class="col-12 order-2 col-md-8 order-md-1">
          <div class="text-center text-md-end mt-3 mt-md-0 me-0 me-md-4">
            <h3>Otorrinolaringología</h3>
            <p>
            Somos una unidad especializada en la atención oportuna, honesta y responsable, de los pacientes con padecimientos de oídos, nariz y garganta y/o que requieran cirugía de cabeza y cuello.
            </p>
          </div>
        </div>
        <div class="col-12 order-1 col-md-4 order-md-2">
            <img src="./assets/img/servicios/otorrino.jpg" alt="Otorrinolaringología" class="img-fluid shadow">
        </div>
    </div>
    <div class="row justify-content-center align-items-center bg-blue-100 gx-0 gy-0 my-5">
        <div class="col-12 order-1 col-md-4 order-md-1">
            <img src="./assets/img/servicios/oncologia.jpg" alt="Oncología" class="img-fluid shadow">
        </div>
        <div class="col-12 order-2 col-md-8 order-md-2">
          <div class="text-center text-md-start mt-3 mt-md-0 ms-0 ms-md-4">
            <h3>Oncología</h3>
            <p>
            Atención medica-quirúrgica, radioterapia y quimioterapia a pacientes con tumores.
            </p>
          </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center gx-0 gy-0 my-5">
        <div class="col-12 order-2 col-md-8 order-md-1">
          <div class="text-center text-md-end mt-3 mt-md-0 me-0 me-md-4">
            <h3>Laboratorio</h3>
            <p>
            Realiza los estudios de laboratorio que requieran los pacientes. Cuenta con personal calificado, el cual ofrece un servicio altamente profesional y de calidad.
            </p>
          </div>
        </div>
        <div class="col-12 order-1 col-md-4 order-md-2">
            <img src="./assets/img/servicios/laboratorio.jpg" alt="Laboratorio" class="img-fluid shadow">
        </div>
    </div>
    <div class="row justify-content-center align-items-center bg-blue-100 gx-0 gy-0 my-5">
        <div class="col-12 order-1 col-md-4 order-md-1">
            <img src="./assets/img/servicios/salud_mental.jpg" alt="Salud Mental" class="img-fluid shadow">
        </div>
        <div class="col-12 order-2 col-md-8 order-md-2">
          <div class="text-center text-md-start mt-3 mt-md-0 ms-0 ms-md-4">
            <h3>Salud Mental</h3>
            <p>
            Atención profesional a pacientes con trastornos mentales y de la personalidad.
            </p>
          </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center gx-0 gy-0 my-5">
        <div class="col-12 order-2 col-md-8 order-md-1">
          <div class="text-center text-md-end mt-3 mt-md-0 me-0 me-md-4">
            <h3>Oftalmología</h3>
            <p>
            Atención médica y quirúrgica a pacientes con padecimientos de los ojos.
            </p>
          </div>
        </div>
        <div class="col-12 order-1 col-md-4 order-md-2">
            <img src="./assets/img/servicios/oftalmologia.jpg" alt="Oftalmología" class="img-fluid shadow">
        </div>
    </div>
</div>

<div class="container mt-5">
  <h1 class="text-center my-5">Nuestros profesionales</h1>
  <div class="row">
    <div class="col-12 col-md-4 mb-4">
      <div class="card">
        <img src="./assets/img/medicos/agustina_garcia_gonzalez.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Agustina García González</h5>
          <p class="card-text">Ginecología, Oncología y Obstetricia</p>
          <a href="/registro-cita.php" class="btn btn-primary">Agendar cita</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-4">
      <div class="card">
        <img src="./assets/img/medicos/adriana_garrido_garcia.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Adriana Garrido García</h5>
          <p class="card-text">Oftalmología</p>
          <a href="/registro-cita.php" class="btn btn-primary">Agendar cita</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-4">
      <div class="card">
        <img src="./assets/img/medicos/alfredo_lopez_mendez.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Alfredo López Méndez</h5>
          <p class="card-text">Medicina General</p>
          <a href="/registro-cita.php" class="btn btn-primary">Agendar cita</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include './templates/footer.php'; ?>