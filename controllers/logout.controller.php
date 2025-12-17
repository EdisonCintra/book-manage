<?php 

session_destroy();

header('Location: /lockbox/login');

exit();