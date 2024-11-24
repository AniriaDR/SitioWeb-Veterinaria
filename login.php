<?php


session_start();


$error_message = "";

    if(isset($_POST['entrar'])){
	    try{

            $email=$_POST["email"];
            $password=$_POST["pass"];
            $passwordexistente="";

            
            $servidor="localhost";      
            $usuario="root";
            $clave="";
            $baseDeDatos="user";

            $enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
            if(!$enlace){
                echo"Error en la conexion con el servidor";
            }

            $sql = "SELECT * FROM Administrador WHERE correo='$email'";

            $respuesta = mysqli_query($enlace,$sql);

            $passwordexistente = mysqli_fetch_array($respuesta)['clave'];

            if (password_verify($password,$passwordexistente)){
                echo "Usuario registrado";
                        header("Location: AdminIndex.html");
            }else{
                $error_message = "Usuario o contraseña incorrectos.";
                header("Location: iniciarSesion.html?error=" . urlencode($error_message));
                exit;
            }


        }catch(Exception $e){
            die("Error: ". $e->getMessage());
        } 
        
        return $error_message;

    } 
?>