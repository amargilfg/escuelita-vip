<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuelita - Alumnos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="Js/Jquery.js"></script>
    <script>
        function Tabla() {
            let datos = {
                order: $("#selOrden").val() + " " + $("#selOrden2").val()
            };


            if ($("#txtNombre").val() != "" && $("#txtCorreo").val() != "" && $("#txtCodigo").val() != "") {
                datos.where = "nombre LIKE '%" + $("#txtNombre").val() + "%'" +
                    " and " + "correo LIKE '%" + $("#txtCorreo").val() + "%'" +
                    " and " + "codigo LIKE '%" + $("#txtCodigo").val() + "%'";
            } else if ($("#txtNombre").val() != "" && $("#txtCorreo").val() != "") {
                datos.where = "nombre LIKE '%" + $("#txtNombre").val() + "%'" +
                    " and " + "correo LIKE '%" + $("#txtCorreo").val() + "%'";
            } else if ($("#txtCorreo").val() != "" && $("#txtCodigo").val() != "") {
                datos.where = "correo LIKE '%" + $("#txtCorreo").val() + "%'" +
                    " and " + "codigo LIKE '%" + $("#txtCodigo").val() + "%'";
            } else if ($("#txtNombre").val() != "" && $("#txtCodigo").val() != "") {
                datos.where = "nombre LIKE '%" + $("#txtNombre").val() + "%'" +
                    " and " + "codigo LIKE '%" + $("#txtCodigo").val() + "%'";
            } else if ($("#txtCorreo").val() != "") {
                datos.where = "correo LIKE '%" + $("#txtCorreo").val() + "%'";
            } else if ($("#txtCodigo").val() != "") {
                datos.where = "codigo LIKE '%" + $("#txtCodigo").val() + "%'";
            } else if ($("#txtNombre").val() != "") {
                datos.where = "nombre LIKE '%" + $("#txtNombre").val() + "%'";
            }

            document.getElementById("Tabla").innerHTML = "";
            $.ajax({
                url: "http://localhost/PAW_222-2/Proyecto_Escuelita/Consultas/mostrar_Alumnos.php",
                type: "GET",
                data: datos,
                dataType: 'json',
                success: function(data) {
                    //jsonResponse = JSON.parse(data);
                    data.forEach(element => {
                        document.getElementById("Tabla").innerHTML +=
                            "<div class='row'>" +
                            "<div class='col'>" + element.nombre + "</div>" +
                            "<div class='col'>" + element.codigo + "</div>" +
                            "<div class='col'>" + element.correo + "</div>" +

                            "<div class='col'>" +
                            "<a type='submit' class='btn btn-primary mt-2' href='Alumno_modificar.php?id=" + element.id + "'>Modificar</a>" +
                            "</div>" +

                            "<div class='col'>" +
                            "<button type='submit' class='btn btn-danger mt-2' onclick='Eliminar(" + element.id + ")'>Eliminar</>" +
                            "</div>" +

                            "</div>" +
                            "</br>";
                    });
                },
                error: function() {
                    alert("Ocurrio un error al realizar la solicitud");
                }
            });
        }

        function Limpiar() {
            $("#txtNombre").val("");
            $("#txtCodigo").val("");
            $("#txtCorreo").val("");
        }

        function Eliminar(id) {
            let datos = {
                id: id,
            };
            if (window.confirm("¿Estas seguro de borrar el registro del alumno?")) {
                $.ajax({
                    url: "./Consultas/eliminar_Alumno.php",
                    type: "POST",
                    data: datos,
                    dataType: 'json',
                    success: function(data) {
                        if (data.estatus == "OK") {
                            Tabla();
                        } else {
                            alert(data.mensaje);
                        }
                    },
                    error: function() {
                        alert("Ocurrio un error al realizar la solicitud");
                    }
                });
            }
        }
    </script>
</head>

<body onload="Tabla()">
    <div class="text-center">
        </br>
        <h1>Alumnos</h1>
        <a type='submit' class='btn btn-primary mt-2' href='index.php'>Volver</a>
        </br></br>
        <div class="text-center">
            <h3 class="text-center">Registrar alumno nuevo.</h3>
            <a type='submit' class='btn btn-success mt-2' href='Alumno_Registrar.php'>Registrar Alumno</a>
            </br></br>
            <h3>Parametros:</h3>
            </br>
            Nombre:
            <input type="text" id="txtNombre">

            Codigo:
            <input type="text" id="txtCodigo">

            Correo:
            <input type="text" id="txtCorreo">

            </br></br>

            Ordenar por:
            <select id="selOrden">
                <option value="nombre">Nombre</option>
                <option value="codigo">Codigo</option>
                <option value="correo">Correo</option>
            </select>
            <select id="selOrden2">
                <option value="ASC">Ascendente</option>
                <option value="DESC">Descendente</option>
            </select>

            <button onclick="Tabla()">Buscar</button>
            <button onclick="Limpiar()">Limpiar Datos</button>
        </div>
    </div>
    </br>
    <div class="text-center">
        </br>
        <h3 class="text-center">Alumnos registrados.</h3>
        <div class="container bg-light text-dark">
            <div class="row text-center">
                <div class="col">Nombre: </div>
                <div class="col">Codigo:</div>
                <div class="col">Correo:</div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
            <br>
            <div class="overflow-auto" style="height: 300px; width: 100%" id="Tabla">
            </div>
        </div>
    </div>
</body>

</html>