<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../../backend/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_categoria'])) {
        // Código para registrar cliente
        if (empty($_POST['descripcion'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/categoria/nuevo.php';
                    }
                });
            }
            </script>";
        } else {

            $nombre = $_POST['descripcion'];


                $guardar = "INSERT INTO categoria (descripcion) VALUES (?)";
                $guardar_categoria = $conn->prepare($guardar);
                $guardar_categoria->execute([$nombre]);

                if ($guardar_categoria) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Éxito', 'Registro creado correctamente.', 'success').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/categoria/nuevo.php';
                            }
                        });
                    }
                    </script>";
                } else {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Error al crear el registro.', 'error').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/categoria/nuevo.php';
                            }
                        });
                    }
                    </script>";
                }
        }
    } elseif (isset($_POST['editar_categoria'])) {
        // Código para actualizar cliente
        $nombre = $_POST['descripcion'];
        $id_categoria = $_POST ['id_categoria'];

        $actualizar = "UPDATE categoria SET descripcion =? WHERE id_categoria =?";
        $editar = $conn->prepare($actualizar);
        $editar->execute([$nombre, $id_categoria]);

        if ($editar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/categoria/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/categoria/listado.php';
                        }
                    });
                }
            </script>";
        }
    } elseif (isset($_POST['eliminar_categoria'])) {
        $id = $_POST['id_categoria'];
        $estado = 0;

        $eliminar_registro = "UPDATE categoria SET estado=? WHERE id_categoria =?";
        $eliminar = $conn->prepare($eliminar_registro);
        $eliminar->execute([$estado, $id]);  

        if ($eliminar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro eliminado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/categoria/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al eliminar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/categoria/listado.php';
                        }
                    });
                }
            </script>";
        }
    }
    }