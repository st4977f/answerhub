<?php
session_start();
session_destroy();
header("Location: /answerhub/login");
exit();
?>