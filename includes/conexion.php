<?php
    // Conexión
    $servidor = 'localhost';
    $usuario = 'root';
    $clave = '';
    $basededatos = 'noticia';
    $db = mysqli_connect($servidor, $usuario, $clave, $basededatos);
    
    mysqli_query($db, "SET NAMES 'utf8'");
    
    // Iniciar sesión.
    session_start();