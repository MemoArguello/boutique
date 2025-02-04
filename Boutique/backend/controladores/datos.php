<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../../backend/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['editar_datos'])) {
        // Código para registrar
    if (empty($_POST['nombre_empresa'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/configuracion/listado.php';
                    }
                });
            }
            </script>";
        } else {
        // Código para actualizar
        $nombre = $_POST['nombre_empresa'];
        $id = $_POST['id_datos'];

        $actualizar = "UPDATE datos_empresa SET nombre_empresa =? WHERE id_datos =?";
        $editar = $conn->prepare($actualizar);
        $editar->execute([$nombre, $id]);

        if ($editar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/configuracion/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/configuracion/listado.php';
                        }
                    });
                }
            </script>";
        }
        }
    }
}