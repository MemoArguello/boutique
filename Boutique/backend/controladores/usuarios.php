<?php
session_start();

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../../backend/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_usuario'])) {
        // Código para registrar
        if (empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['codigo'])|| empty($_POST['ccodigo'])|| empty($_POST['id_cargo'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/usuarios/nuevo.php';
                    }
                });
            }
            </script>";
        } else {

            $correo = $_POST['correo'];
            $usuario = $_POST['usuario'];
            $codigo = md5($_POST['codigo']);
            $ccodigo = md5($_POST['ccodigo']);
            $cargo = $_POST['id_cargo'];

                if ($codigo != $ccodigo) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Las contraseñas no coinciden', 'error').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../../frontend/usuarios/nuevo.php';
                            }
                        });
                    }
                    </script>";
                } else {

                    
                    // Consulta segura con PDO
                    $consulta = $conn->prepare("SELECT * FROM usuarios WHERE correo = :correo AND usuario = :usuario");
                    $consulta->execute([':correo' => $correo, ':usuario' => $usuario]);

                    // Obtener el resultado
                    $filas = $consulta->fetch(PDO::FETCH_ASSOC);
                    
                    if ($filas) {
                        echo "<script>
                        window.onload = function() {
                        Swal.fire('Error', 'Ya existe un usuario con este correo o Nombre de Usuario', 'error').then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '../../frontend/usuarios/nuevo.php';
                                }
                            });
                        }
                        </script>";
                    } else {
                        $guardar = "INSERT INTO usuarios (correo, usuario, codigo, id_cargo) VALUES (?,?,?,?)";
                        $guardar_producto = $conn->prepare($guardar);
                        $guardar_producto->execute([$correo,$usuario,$codigo,$cargo,]);
        
                        if ($guardar_producto) {
                            echo "<script>
                            window.onload = function() {
                                Swal.fire('Éxito', 'Registro creado correctamente.', 'success').then((result) => {
                                    if (result.isConfirmed) {
                                window.location.href = '../../frontend/usuarios/nuevo.php';
                                    }
                                });
                            }
                            </script>";
                        } else {
                            echo "<script>
                            window.onload = function() {
                                Swal.fire('Error', 'Error al crear el registro.', 'error').then((result) => {
                                    if (result.isConfirmed) {
                                window.location.href = '../../frontend/usuarios/nuevo.php';
                                    }
                                });
                            }
                            </script>";
                        }
                    }
                    
                }
                
        }
    } elseif (isset($_POST['editar_usuario'])) {
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $cargo = $_POST['id_cargo'];
        $id_usuario = $_POST['id_usuario'];

                // Consulta segura con PDO
        $consulta = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND id_usuario != :id_usuario");
        $consulta->execute([':usuario' => $usuario, ':id_usuario' => $id_usuario] );

                // Obtener el resultado
                $filas = $consulta->fetch(PDO::FETCH_ASSOC);
                
                if ($filas) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Ya existe un usuario con este correo o Nombre de Usuario', 'error').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../../frontend/usuarios/listado.php';
                            }
                        });
                    }
                    </script>";
                } else {

                    $actualizar_usuario = "UPDATE usuarios SET correo=?, usuario=?,id_cargo=? WHERE id_usuario=?";
                    $editar = $conn->prepare($actualizar_usuario);
                    $editar->execute([$correo, $usuario, $cargo, $id_usuario]);

                    if ($editar) {
                        echo "<script>
                        window.onload = function() {
                            Swal.fire('Éxito', 'Registro Actualizado correctamente.', 'success').then((result) => {
                                if (result.isConfirmed) {
                            window.location.href = '../../frontend/usuarios/listado.php';
                                }
                            });
                        }
                        </script>";
                    } else {
                        echo "<script>
                        window.onload = function() {
                            Swal.fire('Error', 'Error al crear el registro.', 'error').then((result) => {
                                if (result.isConfirmed) {
                            window.location.href = '../../frontend/usuarios/listado.php';
                                }
                            });
                        }
                        </script>";
                    }
                }
    } elseif (isset($_POST['eliminar_usuario'])) {
        
        $id = $_POST['id_usuario'];
        $usuario_actual = $_SESSION['id_usuario'];
        $estado = 0;

        if ($id == $usuario_actual) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Atencion', 'No se puede Eliminar el Usuario Actual', 'warning').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../frontend/usuarios/listado.php';
                    }
                });
            }
        </script>";
        } else {    
            $eliminar_registro = "UPDATE usuarios SET estado=? WHERE id_usuario =? AND id_usuario !=?";
            $eliminar = $conn->prepare($eliminar_registro);
            $eliminar->execute([$estado, $id, $usuario_actual]);  
    
            if ($eliminar) {
                echo "<script>
                    window.onload = function() {
                        Swal.fire('Éxito', 'Registro eliminado correctamente.', 'success').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../../frontend/usuarios/listado.php';
                            }
                        });
                    }
                </script>";
            } else {
                echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Error al eliminar el registro.', 'error').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../../frontend/usuarios/listado.php';
                            }
                        });
                    }
                </script>";
            }
        }
    }
    }