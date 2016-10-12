<?php
session_start();

include_once 'include/setting.php';

$setting = new Setting();

if(isset($_POST['submit'])){
    session_destroy();
    header('Location: '.$setting->root_directory);
}else{
    header('Location: '.$setting->root_directory);
}