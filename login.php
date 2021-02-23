<?php
    // Iniciar sesión y la conexión a BD.
    require_once 'includes/conexion.php';
    // Recoger datos del formulario.
    if(isset($_POST)){
        
        //Borrar error antiguo de logueo.
        if(isset($_SESSION['error_login'])){
            unset($_SESSION['error_login']);
        }
        
        // Recoger datos del formulario.
        $correo = trim($_POST['correo']);
        $clave = $_POST['clave'];
        
        // Consulta para comprobar las credenciales del usuario.
        $sql = "SELECT * FROM usuarios WHERE correo = '".$correo."'";
        $login = mysqli_query($db, $sql);
        
        if($login && mysqli_num_rows($login) == 1){
            $usuario = mysqli_fetch_assoc($login);
            $clave_segura = password_hash($clave, PASSWORD_BCRYPT, ['cost'=>4]);
            
            // Comprobar la contraseñá / cifrada.
            $verificar = password_verify($clave, $usuario['clave']);

            if($verificar){
                // Utilizar una sesión para guardar los datos del usuario logueado.
                $_SESSION['usuario']= $usuario;
            }else{
                // Si algo falla enviar una sesión con el fallo.
                $_SESSION['error_login'] = "Datos erróneos.";
            }
        }else{
            // Mensaje de error.
            $_SESSION['error_login'] = "Datos erróneos.";
        }

    }

    // Redirigir al index.php
    header('Location: index.php');