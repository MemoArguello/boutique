<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../../backend/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_cliente'])) {
        // Código para registrar cliente
        if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['id_ciudad'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/cliente/nuevo.php';
                    }
                });
            }
            </script>";
        } else {

            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $id_ciudad = $_POST['id_ciudad'];


                $guardar = "INSERT INTO cliente (cedula, nombre, id_ciudad) VALUES (?, ?, ?)";
                $guardar_cliente = $conn->prepare($guardar);
                $guardar_cliente->execute([$cedula, $nombre, $id_ciudad]);

                if ($guardar_cliente) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Éxito', 'Cliente creado correctamente.', 'success').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/cliente/nuevo.php';
                            }
                        });
                    }
                    </script>";
                } else {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Error al crear el cliente.', 'error').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/cliente/nuevo.php';
                            }
                        });
                    }
                    </script>";
                }
        }
    } elseif (isset($_POST['actualizar_cliente'])) {
        // Código para actualizar cliente
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $id_ciudad = $_POST['id_ciudad'];
        $id_cliente = $_POST['id_cliente'];

        $actualizar_cliente = "UPDATE cliente SET cedula=?, nombre=?, id_ciudad=? WHERE id_cliente=?";
        $editar = $conn->prepare($actualizar_cliente);
        $editar->execute([$cedula, $nombre, $id_ciudad, $id_cliente]);

        if ($editar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Cliente actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/cliente/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar el cliente.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/cliente/listado.php';
                        }
                    });
                }
            </script>";
        }
    } elseif (isset($_POST['eliminar_cliente'])) {
        $id_cliente = $_POST['id_cliente'];
        $estado = 0;

        $eliminar_cliente = "UPDATE cliente SET estado=? WHERE id_cliente=?";
        $eliminar = $conn->prepare($eliminar_cliente);
        $eliminar->execute([$estado, $id_cliente]);  

        if ($eliminar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Cliente eliminado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/cliente/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al eliminar el cliente.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/cliente/listado.php';
                        }
                    });
                }
            </script>";
        }
    }
    }