<?php
    require_once("php/medico.php");// el include es para llamar a un archivo
    require_once("php/paciente.php");
    require_once("php/cita.php");
    require_once("php/validarSesion.php");
    if(!isset($_SESSION['rol'])){
        header('Location: index.php');
    }else{
        if($_SESSION['rol'] != 2){
            header('Location: index.php');
        }
    }

    //Time array
    $horas = array(
        "09:00:00", "09:20:00", "09:40:00.",
        "10:00:00", "10:20:00", "10:40:00",
        "11:00:00", "11:20:00", "11:40:00",
        "12:00:00", "12:20:00", "12:40:00",
        "13:00:00", "13:20:00", "13:40:00",
        "14:00:00", "14:20:00", "14:40:00",
        "15:00:00", "15:20:00", "15:40:00",
        "16:00:00", "16:20:00", "16:40:00",
        "17:00:00", "17:20:00", "17:40:00",
        "18:00:00", "18:20:00"
    );

    $Codigo_cita = $_GET['id'];

    $paciente = new paciente();
    $medico   = new medico();
    $cita = new citas();
    $actualizarDatos = $cita->search_registro($Codigo_cita);
    foreach ($actualizarDatos as $dato) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepcionista | Actualizar cita</title>

    <!-- Fuentes de tipografia -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Noto+Sans:wght@300;400&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/fec945242f.js" crossorigin="anonymous"></script>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="img/symbol (1).png">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleMenu.css">
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>
<body>
    <!-- SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </symbol>
        <symbol id="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </symbol>
        <symbol id="twitter" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
        </symbol>
    </svg>

    <!-- Navegación de la página -->
    <header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="menu_recepcionista.php">
                    <img src="img/symbol (1).png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    Medical Control System
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="menu_admin.php">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pacientes
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="altasPacientes.php">Nuevo paciente</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="consultasPacienteI.php">Búsqueda pacientes</a></li>
                                <li><a class="dropdown-item" href="consultasPaciente.php">Mostrar lista pacientes</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Citas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="altasCitas.php">Nueva cita medica</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="consultasCitaI.php">Búsqueda citas</a></li>
                                <li><a class="dropdown-item" href="consultasCita.php">Mostrar lista citas</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="php/cerrarSesion.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>  
        <div class="cover d-flex justify-content-end align-items-start p-5 flex-column" style="background-image: url(img/fondDoce.jpg);">
            <h1>Modificar cita</h1>
            <p>La mejor atención medica.</p>
            <form action="consultasCita.php">
                <button type="submit" class="btn btn-info"> Consultas</button>
            </form>
        </div>
    </header>

    <!-- Page Content -->
    <section class="container mt-5 mb-5">
        <div class="row g-5 mt-5" style="background-color: #D6DBDF;">
            <!-- Primer formulario -->
            <div class="col-md-8 col-lg-9">
                <h4 class="mb-3">Datos de la cita medica.</h4>
                <form class="needs-validation" novalidate name="modificar_cita" method="post" action="php/ModificarCita.php">
                    <div class="row g-3">
                        <!-- Código de cita -->
                        <div class="col-md-4">
                            <label for="codigo" class="form-label">Código de cita</label>
                            <input type="number" class="form-control" value="<?php echo $dato['Codigo_cita']; ?>" id="codigo" disabled>
                            <input type="hidden" name="codigo" value="<?php echo $dato['Codigo_cita']; ?>">
                        </div>
                        <!-- Fecha de atención -->
                        <div class="col-md-4">
                            <label for="fechaAtencion" class="form-label">Fecha</label>
                            <input type="date" name="fechaAtencion" id="fechaAtencion" class="form-control" value="<?php echo $dato['fecha']; ?>" required>
                            <div class="invalid-feedback">
                                El campo Fecha es requerido.
                            </div>
                        </div>
                        <!-- Hora de atención -->
                        <div class="col-md-4">
                            <label for="horaAtencion" class="form-label">Hora</label>
                            <select class="form-select" id="horaAtencion" name="horaAtencion" required>
                                <option value="" class="form-text text-center">Selecciona una opción</option>
                                <?php
                                    foreach ($horas as $row) {
                                        if ($row == $dato['hora']) {
                                ?>
                                            <option value="<?php echo $row; ?>" selected><?php echo $row;?></option>
                                <?php
                                        } else {
                                ?>
                                            <option value="<?php echo $row; ?>"><?php echo $row;?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- Nombre-->
                        <div class="col-md-6">
                            <label for="nombrePaciente" class="form-label">Nombre del paciente</label>
                            <select class="form-select" id="nombrePaciente" name="curp_paciente" required>
                                <option value="" class="form-text text-center">Selecciona una opción</option>
                                <?php
                                    $consulta = $paciente->get_registro();
                                    foreach ($consulta as $row) {
                                        if ($row['CURP'] == $dato['CURP_paciente']) {
                                ?>
                                            <option value="<?php echo $row['CURP']; ?>" selected><?php echo $row['CURP'];?></option>
                                <?php
                                        } else {
                                ?>
                                            <option value="<?php echo $row['CURP']; ?>"><?php echo $row['CURP'];?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                El campo Nombre del paciente es requerido.
                            </div>
                        </div>
                        <!-- Nombre - Especialidad-->
                        <div class="col-md-6">
                            <label for="nombreMedico" class="form-label">Médico nombre y especialidad</label>
                            <select class="form-select" id="nombreMedico" name="curp_medico" required>
                                <option value="" class="form-text text-center">Selecciona una opción</option>
                                <?php
                                    $consulta_b = $medico->get_registro();
                                    foreach ($consulta_b as $row) {
                                        if ($row['CURP'] == $dato['CURP_medico']) {
                                ?>
                                        <option value="<?php echo $row['CURP']; ?>" selected><?php echo $row['CURP'].' - '.$row['Especialidad']; ?></option>
                                <?php
                                        } else {
                                ?>
                                            <option value="<?php echo $row['CURP']; ?>"><?php echo $row['CURP'].' - '.$row['Especialidad']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                El campo Nombre del médico es requerido.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex">
                        <button class="w-50 btn btn-danger mb-4 me-1" type="button" onclick="history.back()">Cancelar</button>
                        <button class="w-50 btn btn-info mb-4" type="submit">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="container-fluid color-footer-g">
        <div class="container">
            <footer class="pt-5 pb-1">
                <div class="row">
                <div class="col-2">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>
    
                <div class="col-2">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>
    
                <div class="col-2">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>
    
                <div class="col-4 offset-1">
                    <form>
                    <h5>Subscribe to our newsletter</h5>
                    <p>Monthly digest of whats new and exciting from us.</p>
                    <div class="d-flex w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                    </form>
                </div>
                </div>
    
                <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>&copy; 2021 Company, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
                </ul>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- Validate -->
    <script src="js/form-validation.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
<?php
    }
?>