<?php
require '../include/header.php';
include '../../backend/db.php';

$id_categoria = $_GET["id"];

$consulta = $conn->query("SELECT * FROM categoria WHERE id_categoria =" . $id_categoria);
$consulta->execute();

$categoria = $consulta->fetch(PDO::FETCH_OBJ);
?>
<div class="home-content">
    <div class="sales-boxes">
        <div class="container">
            <header>
                Formulario de Edicion
            </header>
            <form action="../../backend/controladores/categoria.php" method="post">
                <span class="title">Editar Categorias</span>
                <input type="hidden" name="editar_categoria" value="1">
                <input type="hidden" name="id_categoria" value="<?= $categoria->descripcion ?>">
                <div class="fields">
                    <div class="input-field">
                        <label>Nombre</label>
                        <input type="text" placeholder="Ingresar Nombre" required name="descripcion" value="<?= $categoria->descripcion ?>">
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
</div>
<?php
require '../include/futer.php';

?>