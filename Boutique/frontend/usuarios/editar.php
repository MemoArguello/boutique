<?php
require '../include/header.php';
include '../../backend/db.php';

$id = $_GET["id"];

$consulta = $conn->query("SELECT * FROM usuarios WHERE id_usuario =" . $id);
$consulta->execute();

$usuarios = $consulta->fetch(PDO::FETCH_OBJ);
?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Registro
            </header>
            <form action="../../backend/controladores/usuarios.php" method="post">
                <span class="title">Información del Usuario</span>
                <input type="hidden" name="editar_usuario" value="1">
                <input type="hidden" name="id_usuario" value="<?=$usuarios->id_usuario?>">
                <div class="fields">
                    <div class="input-field">
                        <label>Correo</label>
                        <input type="email" placeholder="Ingresar Correo" required name="correo" value="<?=$usuarios->correo?>">
                    </div>
                    <div class="input-field">
                        <label>Nombre de Usuario</label>
                        <input type="text" placeholder="Ingresar Nombre de Usuario" required name="usuario" value="<?=$usuarios->usuario?>">
                    </div>
                    <div class="input-field">
                        <label>Cargo del Usuario</label>
                        <select name="id_cargo" id="">
                        <?php
                            $query = $conn->query('SELECT * FROM cargo');
                            $cargos=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($cargos as $cargo) {
                                $selected= ($cargo->id == $usuarios->id_cargo) ? 'selected' : '';
                                echo "<option value='" . $cargo->id ."'$selected>". $cargo->descripcion . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit">
                        <span class="btnText">Guardar</span>
                    </button>
                    <a href="./listado.php" class="backBtn">
                            <span class="btnText">Volver</span>
                        </a>
                </div>
            </form>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<?php
require '../include/futer.php';

?>