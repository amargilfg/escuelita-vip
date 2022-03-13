<!DOCTYPE html>
<?php
ini_set("display_errors", 1);
require_once("./Consultas/datos/bd.php");
require_once("./Consultas/modelo/Alumno.php");

if($_GET){
    if(isset($_GET["Nombre"])){
        $nombre = $_GET["Nombre"];
        if($nombre != ""){
            if(isset($_GET["Codigo"])){
                $codigo = $_GET["Codigo"];
                if($codigo !=""){
                    if(isset($_GET["Correo"])){
                        $correo = $_GET["Correo"];
                        if($correo !=""){
                            $alumno = new Alumno($nombre,$codigo,$correo);
                            if($alumno->registrar()){
                                echo "<div class='alert alert-success' role='alert'> Registro exitoso </div>";    
                                header("refresh:3;url=Alumnos.php");
                            }else{
                                echo "<div class='alert alert-danger' role='alert'> Ocurrio un error.</div>";    
                            }
                        }else{
                            echo "<div class='alert alert-danger' role='alert'> El Correo es necesario </div>";    
                        }
                    }else{
                        echo "<div class='alert alert-danger' role='alert'> El Correo es necesario </div>";
                    }
                }else{
                    echo "<div class='alert alert-danger' role='alert'> El Codigo no puede estar vacio.</div>";
                }
            }else{
                echo "<div class='alert alert-danger' role='alert'> El Codigo es necesario </div>";                }
        }else{
            echo "<div class='alert alert-danger' role='alert'> El Nombre no puede estar vacio.</div>";
        }
    }else{
        echo "<div class='alert alert-danger' role='alert'>El Nombre es necesario.</div>";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuelita - Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"></script>
</head>

<body>
    <br>
    <div class="container text-center" style="width:50%">
        <h2 class="text-center">Registrar Alumno.</h2>
        <form action="" method="get">
            <label for="">Nombre:</label>
            <input type="text" name="Nombre" id="" class="form-control" required>
            <label for="">Codigo del Alumno:</label>
            <input type="text" name="Codigo" id="" class="form-control" required>
            <label for="">Correo:</label>
            <input type="text" name="Correo" id="" class="form-control" required>
            <button type="submit" class="btn btn-success mt-2">Registrar</button>
        </form>
        <a type="submit" class="btn btn-primary mt-2" href="Alumnos.php">Cancelar</a>
    </div>  
</body>
</html>