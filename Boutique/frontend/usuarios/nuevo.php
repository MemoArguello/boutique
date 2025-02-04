<?php
require '../include/header.php';
include '../../backend/db.php';

?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Registro
            </header>
            <form action="../../backend/controladores/usuarios.php" method="post">
                <span class="title">Información del Usuario</span>
                <input type="hidden" name="registrar_usuario" value="1">
                <div class="fields">
                    <div class="input-field">
                        <label>Correo</label>
                        <input type="email" placeholder="Ingresar Correo" required name="correo">
                    </div>
                    <div class="input-field">
                        <label>Nombre de Usuario</label>
                        <input type="text" placeholder="Ingresar Nombre de Usuario" required name="usuario">
                    </div>
                    <div class="input-field">
                        <label>Contraseña</label>
                        <input type="password" placeholder="Ingresar Contraseña" required name="codigo">
                    </div>
                    <div class="input-field">
                        <label>Confirmar Contraseña</label>
                        <input type="password" placeholder="Confirmar Contraseña" required name="ccodigo">
                    </div>
                    <div class="input-field">
                        <label>Cargo del Usuario</label>
                        <select name="id_cargo" id="">
                        <?php
                            $query = $conn->query('SELECT * FROM cargo');
                            $cargos=$query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($cargos as $cargo) {
                                echo "<option value='" . $cargo->id ."'>". $cargo->descripcion . "</option>";
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