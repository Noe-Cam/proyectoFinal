<?php
// Esta página se encarga de cerrar la sesión del usuario, destruyendo sus variables
session_start();
session_unset(); 
session_destroy(); 
header("Location: ../pages/login.php"); 
exit();