<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Seja bem-vindo, <?php echo $_SESSION['name']; ?>!</h1>
<a href="logout.php">Sair</a>
