<?php
session_start();
include_once 'include/setting.php';
$setting = new Setting();

if (isset($_POST['submit_view'])) {
    if (empty($_POST['password_view'])) {
        $_SESSION['error'] = 'empty_password_view';
        header('Location: '.$setting->root_directory);
    } else {
        if ($_POST['password_view'] == $setting->password_view) {
            $_SESSION['success'] = 'allow_view';
            $_SESSION['pass'] = md5($setting->password_view);
            header('Location: '.$setting->root_directory);
        } else {
            $_SESSION['error'] = 'wrong_password_view';
            header('Location: '.$setting->root_directory);
        }
    }
} else {
    header('Location: '.$setting->root_directory);
}