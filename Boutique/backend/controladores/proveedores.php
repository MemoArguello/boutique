<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../../backend/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_proveedor'])) {
        // Código para registrar cliente
        if (empty($_POST['nombre_proveedor'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/proveedores/nuevo.php';
                    }
                });
            }
            </script>";
        } else {

            $nombre = $_POST['nombre_proveedor'];


                $guardar = "INSERT INTO proveedores (nombre_proveedor) VALUES (?)";
                $guardar_cliente = $conn->prepare($guardar);
                $guardar_cliente->execute([$nombre]);

                if ($guardar_cliente) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Éxito', 'Registro creado correctamente.', 'success').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/proveedores/nuevo.php';
                            }
                        });
                    }
                    </script>";
                } else {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Error al crear el registro.', 'error').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/proveedor/nuevo.php';
                            }
                        });
                    }
                    </script>";
                }
        }
    } elseif (isset($_POST['editar_proveedor'])) {
        // Código para actualizar cliente
        $nombre = $_POST['nombre_proveedor'];
        $id_proveedor = $_POST ['id_proveedor'];

        $actualizar_proveedor = "UPDATE proveedores SET nombre_proveedor=? WHERE id_proveedor=?";
        $editar = $conn->prepare($actualizar_proveedor);
        $editar->execute([$nombre, $id_proveedor]);

        if ($editar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/proveedores/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/proveedores/listado.php';
                        }
                    });
                }
            </script>";
        }
    } elseif (isset($_POST['eliminar_proveedor'])) {
        $id_proveedor = $_POST['id_proveedor'];
        $estado = 0;

        $eliminar_cliente = "UPDATE proveedores SET estado=? WHERE id_proveedor=?";
        $eliminar = $conn->prepare($eliminar_cliente);
        $eliminar->execute([$estado, $id_proveedor]);  

        if ($eliminar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro eliminado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/proveedores/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al eliminar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/proveedores/listado.php';
                        }
                    });
                }
            </script>";
        }
    }
    }