<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a href="/" class="navbar-brand">Centro Médico BV</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if(!isset($_COOKIE['id_usuario'])){ ?>
          <li class="nav-item">
            <a href="/" class="nav-link">Inicio</a>
          </li>
          <li class="nav-item">
            <a href="/acerca.php" class="nav-link">Acerca</a>
          </li>
          <li class="nav-item">
            <a href="/servicios.php" class="nav-link">Servicios</a>
          </li>
          <li class="nav-item">
            <a href="/registro-cita.php" class="nav-link">Citas</a>
          </li>
          <li class="nav-item">
            <a href="/medicos.php" class="nav-link">Medicos</a>
          </li>
          <li class="nav-item">
            <a href="/departamentos.php" class="nav-link">Departamentos</a>
          </li>
          <li class="nav-item">
            <a href="/blog.php" class="nav-link">Blog</a>
          </li>
          <li class="nav-item">
            <a href="/contacto.php" class="nav-link">Contacto</a>
          </li>
          <li class="nav-item">
            <a href="/registro-paciente.php" class="nav-link">Registrarse</a>
          </li>
          <li class="nav-item">
            <a href="/iniciar-sesion.php" class="nav-link">Iniciar sesión</a>
          </li>
        <?php } else { ?>
        <li class="nav-item">
          <a href="/dashboard.php" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item">
          <a href="/registro-cita.php" class="nav-link">Registrar cita</a>
        </li>
        <li class="nav-item">
          <a href="/consulta-cita.php" class="nav-link">Consulta cita</a>
        </li>
        <?php if($_COOKIE['tipo_usuario'] == 'medicos') {?>
        <li class="nav-item">
          <a href="#" class="nav-link">Modificar cita</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Cancelar cita</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a href="/salir.php" class="nav-link">Salir</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>