<?php
session_start();

include_once 'include/setting.php';

$setting = new Setting();

if (isset($_POST['submit'])) {
    if ($setting->allow_send) {
        if (!empty($_POST['message'])) {
            $is_admin = false;
            if ($setting->set_password_send) {
                if (empty($_POST['password'])) {
                    $_SESSION['error'] = 'empty_password_send';
                    header('Location: '.$setting->root_directory);
                    die();
                } else {
                    if ($_POST['password'] == $setting->password_send_admin) {
                        $is_admin = true;
                    } else {
                        if ($_POST['password'] != $setting->password_send_public) {
                            $_SESSION['error'] = 'wrong_password_send';
                            header('Location: '.$setting->root_directory);
                            die();
                        }
                    }
                }
            }
            if ($setting->allow_send_file) {
                if (!empty($_FILES['file']['name'])) {
                    $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    $match = false;
                    foreach ($setting->allowed_file_extension as $allowed) {
                        if (strtolower($ext) == strtolower($allowed)) {
                            $match = true;
                        }
                    }
                    if ($match) {
                        $exi = 0;
                        $target_dir = "files/";
                        $target_file = null;
                        if ($_FILES['file']['name'] == '.htaccess') {
                            $rand = rand(999, 999999);
                            $target_file = $target_dir . basename($_FILES["file"]["name"]) . $rand;
                        } else {
                            $target_file = $target_dir . basename($_FILES["file"]["name"]);
                        }
                        if (file_exists($target_file)) {
                            $exi = 1;
                            if ($setting->allow_overwrite_file) {
                                unlink("uploads/$target_file");
                            } else {
                                $_SESSION['error'] = 'error_upload_exist';
                                header('Location: '.$setting->root_directory);
                                die();
                            }
                        }
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                            if ($exi == 1) {
                                $message = $_POST['message'] . " - " . basename($_FILES["file"]["name"]) . " (file) (replaced)";
                                write_file($is_admin, $message);
                                $_SESSION['success'] = 'message_file_overwrite';
                            } else {
                                $message = $_POST['message'] . " - " . basename($_FILES["file"]["name"]) . " (file)";
                                write_file($is_admin, $message);
                                $_SESSION['success'] = 'message_file';
                            }
                        } else {
                            $_SESSION['error'] = 'error_upload';
                        }
                    } else {
                        $_SESSION['error'] = 'error_extension';
                    }
                } else {
                    $message = $_POST['message'];
                    write_file($is_admin, $message);
                    $_SESSION['success'] = 'message';
                }
            } else {
                $message = $_POST['message'];
                write_file($is_admin, $message);
                $_SESSION['success'] = 'message';
            }
            header('Location: '.$setting->root_directory);
        } else {
            $_SESSION['error'] = 'empty_message';
            header('Location: '.$setting->root_directory);
        }
    } else {
        header('Location: '.$setting->root_directory);
    }
} else {
    header('Location: '.$setting->root_directory);
}

function write_file($is_admin, $message){
    $time = date('Y-m-d, H:i:s', time());
    $fh = fopen('record.txt', 'a+');
    $fha = fopen('record_admin.txt', 'a+');
    if($is_admin){
        $rand = rand(99,999999);
        fwrite($fh, base64_encode($time) . '||' .base64_encode($message.' [Admin - '.$rand.']').";\n");
        fwrite($fha, $time . '||' .$message.' [Admin - '.$rand."];\n");
    }else{
        fwrite($fh, base64_encode($time) . '||' .base64_encode($message).";\n");
    }
    fclose($fha);
    fclose($fh);
}