<?php 
unset($_SESSION['account']);
setcookie('remember','',1);
header('Location:'.URL);