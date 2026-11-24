<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebuild - <?php echo htmlspecialchars($titulo); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-rebuild">
        <div class="container">
            <a class="navbar-brand" href="index.php">rebuild<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link <?php if ($pagina == "inicio") echo "active"; ?>" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link <?php if ($pagina == "catalogo") echo "active"; ?>" href="catalogo.php">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link <?php if ($pagina == "contacto") echo "active"; ?>" href="contacto.php">Contacto</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Carrito</a></li>
                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                        <!-- Icono de perfil; lleva a cuenta.php cuando exista (fase 9) -->
                        <li class="nav-item">
                            <a class="nav-link icono-cuenta <?php if ($pagina == "cuenta") echo "active"; ?>" href="#" title="Mi cuenta" aria-label="Mi cuenta">
                                <svg width="22" height="22" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                                <span class="d-lg-none ms-2">Mi cuenta</span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link <?php if ($pagina == "login") echo "active"; ?>" href="login.php">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link <?php if ($pagina == "registro") echo "active"; ?>" href="registro.php">Crear cuenta</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
