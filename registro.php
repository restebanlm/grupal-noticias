<?php

    if(isset($_POST['submit'])){
        // Conexión a la Base de Datos.
        require_once 'includes/conexion.php';

        // Iniciar sesión.
        if(!isset($_SESSION)){
            session_start();
        }
    
        // Recoger los valores del formulario de registro.
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
        $correo = isset($_POST['correo']) ? mysqli_real_escape_string($db, trim($_POST['correo'])) : false;
        $clave = isset($_POST['clave']) ? mysqli_real_escape_string($db, $_POST['clave']) : false;
        
        // Array de errores.
        $errores = array();
        
        // Validar los datos antes de guardarlos en la base de datos.
        // Validar nombre.
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
            $nombre_validado = true;
        }else{
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es válido.";
        }
        
        // Validar apellido.
        if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
            $apellido_valido = true;
        }else{
            $apellido_valido = false;
            $errores['apellido'] = "El apellido no es válido.";
        }
        
        // Validar correo.
        if(!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $correo_validado = true;
        }else{
            $correo_validado = false;
            $errores['correo'] = "El correo no es válido.";
        }
        
        // Validar clave.
        if(!empty($clave)){
            $clave_validada = true;
        }else{
            $clave_validada = false;
            $errores['clave'] = "La contraseña no es válida.";
        }
        
        $guardar_usuario = false;
        if(count($errores) == 0){
            $guardar_usuario = true;
            
            // Cifrar la contraseña.
            $clave_segura = password_hash($clave, PASSWORD_BCRYPT, ['cost'=>4]);
            
            if (password_verify($clave, $clave_segura)){
                // Insertar usuario en la tabla usuarios de la base de datos.
                $sql = "INSERT INTO usuarios VALUES(null,'".$nombre."','".$apellido."','".$correo."','".$clave_segura."'".")";
                $consulta = mysqli_query($db, $sql);
                if($consulta){
                    $_SESSION['completado'] = "Registrado exitosamente.";
                }else{
                    $_SESSION['errores']['general'] = "Error al guardar el usuario.";
                }
            }
        }else{
            $_SESSION['errores'] = $errores;
        }
    }
    header('Location: index.php');