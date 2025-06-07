<?php
session_start();
session_destroy();
header("Location: Pendataan_jemaat/login.php");
exit;
