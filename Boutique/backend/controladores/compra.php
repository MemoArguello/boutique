<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../../backend/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_compra'])) {
        // Código para registrar
        if (empty($_POST['id_producto']) || empty($_POST['precio_compra']) || empty($_POST['cantidad']) ||  empty($_POST['id_proveedor'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/compra/nuevo.php';
                    }
                });
            }
            </script>";
        } else {

            $producto = $_POST['id_producto'];
            $compra = $_POST['precio_compra'];
            $proveedor = $_POST['id_proveedor'];
            $cantidad = $_POST['cantidad'];
            $total = $compra*$cantidad;


            $consulta = $conn->query("SELECT stock FROM productos WHERE id_producto =" . $producto);
            $consulta->execute();

            $productos = $consulta->fetch(PDO::FETCH_OBJ);

            $stock_actual = $productos->stock;
            $nuevo_stock = $stock_actual + $cantidad;


                $guardar = "INSERT INTO compras (id_producto, id_proveedor,cantidad, precio_compra, total_pagar) VALUES (?,?,?,?,?)";
                $guardar_compra = $conn->prepare($guardar);
                $guardar_compra->execute([$producto,$proveedor,$cantidad,$compra,$total]);

                $actualizar_producto = "UPDATE productos SET stock=? WHERE id_producto=?";
                $editar = $conn->prepare($actualizar_producto);
                $editar->execute([$nuevo_stock,$producto]);

                if ($guardar_compra AND $editar) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Éxito', 'Registro creado correctamente.', 'success').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/compra/nuevo.php';
                            }
                        });
                    }
                    </script>";
                } else {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Error al crear el registro.', 'error').then((result) => {
                            if (result.isConfirmed) {
                        window.location.href = '../../frontend/compra/nuevo.php';
                            }
                        });
                    }
                    </script>";
                }
        }
    } elseif (isset($_POST['editar_compra'])) {
        // Código para actualizar
        $producto = $_POST['id_producto'];
        $compra = $_POST['precio_compra'];
        $proveedor = $_POST['id_proveedor'];
        $cantidad = $_POST['cantidad'];
        $total = $compra*$cantidad;
        $id_compras = $_POST['id_compras'];

        $actualizar_producto = "UPDATE compras SET id_producto=?,id_proveedor=?, cantidad=?, precio_compra=?, total_pagar=? WHERE id_compras=?";
        $editar = $conn->prepare($actualizar_producto);
        $editar->execute([$producto,$proveedor,$cantidad,$compra,$total,$id_compras]);

        if ($editar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/compra/nuevo.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/compra/nuevo.php';
                        }
                    });
                }
            </script>";
        }
    } elseif (isset($_POST['eliminar_compra'])) {
        
        $id = $_POST['id_compras'];
        $estado = 0;

        $eliminar_registro = "UPDATE compras SET estado=? WHERE id_compras =?";
        $eliminar = $conn->prepare($eliminar_registro);
        $eliminar->execute([$estado, $id]);  

        if ($eliminar) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Registro eliminado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/compra/listado.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al eliminar el registro.', 'error').then((result) => {
                        if (result.isConfirmed) {
                        window.location.href = '../../frontend/compra/listado.php';
                        }
                    });
                }
            </script>";
        }
    }
    }