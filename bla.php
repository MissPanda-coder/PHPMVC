<?php
function pw(){
    $password = "Potion4MagicSite";
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
    return $hashPass;
}

echo pw();
?>