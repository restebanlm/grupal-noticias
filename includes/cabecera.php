<?php require_once 'includes/helpers.php'; ?>
<?php require_once 'conexion.php';?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Noticias</title>
        <link rel="stylesheet" type="text/css" href="./assets/styles/estilo.css">
    </head>
    <body>
        <!-- ********************CABECERA******************** -->
        <header id="cabecera">
            <!-- LOGO -->
            <div id="logo">
                <a href="index.php">
                    <h1>NOTICIAS</h1>
                </a>
            </div>
            
            <!-- MENU -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <?php 
                        $categorias = conseguirCategorias();
                        while($categoria = mysqli_fetch_assoc($categorias)):
                    ?>
                            <li>
                                <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                            </li>
                    <?php endwhile; ?>
                    <li>
                        <a href="index.php">Categoría</a>
                    </li>
                    <li>
                        <a href="index.php">Noticias</a>
                    </li>
                    <li>
                        <a href="index.php">Acerca</a>
                    </li>
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>
<?php