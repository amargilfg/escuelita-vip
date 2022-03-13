<!DOCTYPE html>
<?php
    ini_set("display_errors",1);
    require_once("./Consultas/datos/bd.php");
    require_once("./Consultas/modelo/Alumno.php");

    if($_GET){
        if(isset($_GET["id"])){
            $alumno = new Alumno("","","");
            if($alumno->id < 0){
                header("Location:Alumnos.php");
            }
                $alumno->id = intval($_GET["id"]);
            $alumno->obtener();
            if($alumno->id == -1){
                header("Location:Alumnos.php");
            }            
            
        }
    }
?>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuelita - Alumnos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"></script>
    <script src="Js/Jquery.js"></script>
    <script>
        function Modificar(id) {
            let datos = {
                id: id,
                nombre: $("#Nombre").val(),
                correo: $("#Correo").val(),
                codigo: $("#Codigo").val()
            };
            if (datos.nombre && datos.correo && datos.codigo) {
                $.ajax({
                    url: "http://localhost/PAW_222-2/Proyecto_Escuelita/Consultas/modificar_Alumno.php",
                    type: "POST",
                    data: datos,
                    dataType: 'json',
                    success: function(data) {
                        if (data.estatus == "OK") {
                            alert(data.mensaje);
                        } else {
                            alert(data.mensaje);
                        }
                    },
                    error: function() {
                        alert("Ocurrio un error al realizar la solicitud");
                    }
                });
            } else {
                alert("Todos los datos son necesarios para agregar.")
            }
        }
    </script>
</head>


<body>
    <div class="container">
        <h2 class="text-center">Modificar datos del alumno</h2>
        <label for="">Nombre </label>
        <input type="text" id="Nombre" id="" class="form-control" value="<?php echo $alumno->nombre; ?>" required>
        <label for="">Codigo Alumno </label>
        <input type="text" id="Codigo" id="" class="form-control" value="<?php echo $alumno->codigo; ?>" required>
        <label for="">Correo</label>
        <input type="text" id="Correo" id="" class="form-control" value="<?php echo $alumno->correo; ?>" required>
        <button type="submit" onclick=Modificar(<?php echo $alumno->id; ?>); class="btn btn-success mt-2">Modificar</button>
         
        <a type='submit' class='btn btn-primary mt-2' href='Alumnos.php'>Volver</a>
    </div>
</body>

</html>