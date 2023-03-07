<?php
session_start();
unset ($_SESSION['sessionStart']);
header('Location: ../index.php');