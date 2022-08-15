<nav>
  <div>
    <?php if(!isset($_COOKIE['id_usuario'])){ ?>
      <span>
        <a href="/">Inicio</a>
      </span>
      <span>
        <a href="/registro-paciente.php">Registrarse</a>
      </span>
      <span>
        <a href="/iniciar-sesion.php">Iniciar sesión</a>
      </span>
    <?php } else { ?>
    <span>
      <a href="/dashboard.php">Inicio</a>
    </span>
    <span>
      <a href="/registro-cita.php">Registrar cita</a>
    </span>
    <span>
      <a href="/consulta-cita.php">Consulta cita</a>
    </span>
    <?php if($_COOKIE['tipo_usuario'] == 'medicos') {?>
    <span>
      <a href="#">Modificar cita</a>
    </span>
    <span>
      <a href="#">Cancelar cita</a>
    </span>
    <?php } ?>
    <span>
      <a href="/salir.php">Salir</a>
    </span>
    <?php } ?>
  </div>
</nav>