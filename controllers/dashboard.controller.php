<?php
if (!auth()){
    header('location: /lockbox/login');
    exit();
}

echo 'helo';
