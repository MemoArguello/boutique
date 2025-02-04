<?php 
include '../../backend/db.php';

session_start();
$direccion='http://localhost/boutique';

if (empty($_SESSION['id_usuario'])){
  header("location:".$direccion);
}

$id_datos = 1;

$consulta = $conn->query("SELECT * FROM datos_empresa WHERE id_datos =" . $id_datos);
$consulta->execute();

$datos = $consulta->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Boutique </title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
    <i class="bi bi-shop"></i>
      <span class="logo_name">Admin Panel</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="../inicio/inicio.php" class="active">
          <i class="bi bi-house-door"></i>
            <span class="links_name">Inicio</span>
          </a>
        </li>
        <li>
          <a href="#">
          <i class="bi bi-bag"></i>
            <span class="links_name">Ventas</span>
          </a>
        </li>
        <li>
          <a href="../producto/listado.php">
          <i class="bi bi-flower3"></i>
            <span class="links_name">Productos</span>
          </a>
        </li>
        <li>
          <a href="../categoria/listado.php">
          <i class="bi bi-list-ul"></i>
            <span class="links_name">Categorias</span>
          </a>
        </li>
        <li>
          <a href="../proveedores/listado.php">
          <i class="bi bi-truck"></i>
            <span class="links_name">Proveedores</span>
          </a>
        </li>
        <li>
          <a href="../cliente/listado.php">
            <i class="bi bi-people-fill"></i>
            <span class="links_name">Clientes</span>
          </a>
        </li>
        <li>
          <a href="../compra/listado.php">
          <i class="bi bi-minecart"></i>
            <span class="links_name">Compras</span>
          </a>
        </li>
        <li>
          <a href="../usuarios/listado.php">
          <i class="bi bi-person-check-fill"></i>
            <span class="links_name">Usuarios</span>
          </a>
        </li>

        <li>
          <a href="#">
          <i class="bi bi-heart"></i>
            <span class="links_name">Favoritos</span>
          </a>
        </li>
        <li>
          <a href="../configuracion/listado.php">
          <i class="bi bi-gear"></i>
            <span class="links_name">Configuración</span>
          </a>
        </li>
        <li class="log_out">
          <a href="<?=$direccion?>/backend/cerrar_sesion.php">
          <i class="bi bi-box-arrow-left"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>

  <section class="home-section">
<nav>
  <div class="sidebar-button">
    <i class="bi bi-list"></i>
    <span class="dashboard"><?=$datos->nombre_empresa?></span>
  </div>
  <div class="search-box">
    <input type="text" placeholder="Search...">
    <i class='bx bx-search' ></i>
  </div>
  <div class="profile-details">
    <img src="<?=$direccion?>/frontend/img/user.png" alt="">
    <span class="admin_name"><?=$_SESSION['usuario']?></span>
    <i class='bx bx-chevron-down' ></i>
  </div>
</nav>