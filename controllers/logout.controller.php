<?php 

session_destroy();

header('Location: /book-manage/login');

exit();