<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../../backend/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_producto'])) {
        // Código para registrar
        if (empty($_POST['nombre']) || empty($_POST['precio']) || empty($_POST['precio_compra'])|| empty($_POST['stock'])|| empty($_POST['categoria'])|| empty($_POST['id_proveedor'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/producto/nuevo.php';
                    }
                });
            }
            </script>";
        } else {

            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $compra = $_POST['precio_compra'];
            $stock = $_POST['stock'];
            $categoria = $_POST['categoria'];
            $proveedor = $_POST['id_proveedor'];
            $imagen = $_FILES['imagen_url']['name'];
            $imagen_tmp = $_FILES['imagen_url']['tmp_name'];
            $directorio = 'imagen/';
            $ruta_imagen = $directorio . basename($imagen); 

            try {
                if (move_uploaded_file($imagen_tmp, $ruta_imagen)) {
                    $guardar = "INSERT INTO productos (nombre, precio, precio_compra, stock, categoria, id_proveedor, imagen_url) VALUES (?,?,?,?,?,?,?)";
                    $guardar_producto = $conn->prepare($guardar);
                    $guardar_producto->execute([$nombre,$precio,$compra,$stock,$categoria,$proveedor, $ruta_imagen]);
    
                        echo "<script>
                        window.onload = function() {
                            Swal.fire('Éxito', 'Registro creado correctamente.', 'success').then((result) => {
                                if (result.isConfirmed) {
                            window.location.href = '../../frontend/producto/nuevo.php';
                                }
                            });
                        }
                        </script>";
                } else {

                }
                
            } catch (\PDOException $e) {
                echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al crear el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                    window.location.href = '../../frontend/producto/nuevo.php';
                        }
                    });
                }
                </script>";
            }


        }
    } elseif (isset($_POST['editar_producto'])) {
        // Código para actualizar
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $compra = $_POST['precio_compra'];
        $stock = $_POST['stock'];
        $categoria = $_POST['categoria'];
        $proveedor = $_POST['id_proveedor'];
        $id_producto = $_POST ['id_producto'];

        $actualizar_producto = "UPDATE productos SET nombre=?,precio=?,precio_compra=?,stock=?,categoria=?,id_proveedor=? WHERE id_producto=?";
        $editar = $conn->prepare($actualizar_producto);
        $editar->execute([$nombre,$precio,$compra,$stock,$categoria,$proveedor,$id_producto]);

        if ($editar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/producto/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/producto/listado.php';
                        }
                    });
                }
            </script>";
        }
    } elseif (isset($_POST['eliminar_producto'])) {
        
        $id = $_POST['id_producto'];
        $estado = 0;

        $eliminar_registro = "UPDATE productos SET estado=? WHERE id_producto =?";
        $eliminar = $conn->prepare($eliminar_registro);
        $eliminar->execute([$estado, $id]);  

        if ($eliminar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro eliminado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/producto/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al eliminar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/producto/listado.php';
                        }
                    });
                }
            </script>";
        }
    }
    }