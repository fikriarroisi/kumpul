<?php
session_start();

include_once 'include/setting.php';

$setting = new Setting();

if (isset($_POST['submit'])) {
    if ($setting->receiving) {
        if (!empty($_POST['message'])) {
            if ($setting->set_password) {
                if (empty($_POST['password'])) {
                    $_SESSION['error'] = 'empty_password';
                    header('Location: /kumpul');
                    die();
                } else {
                    if ($_POST['password'] != $setting->password) {
                        $_SESSION['error'] = 'wrong_password';
                        header('Location: /kumpul');
                        die();
                    }
                }
            }
            $now = date('Y-m-d, H:i:s', time());
            $fh = fopen('log.txt', 'a+');
            if ($setting->receive_message_and_file) {
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
                                fclose($fh);
                                $_SESSION['error'] = 'error_upload_exist';
                                header('Location: /kumpul');
                                die();
                            }
                        }
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                            if ($exi == 1) {
                                fwrite($fh, $now . '||' . $_POST['message'] . " - " . basename($_FILES["file"]["name"]) . " (file) (replaced);");
                                $_SESSION['success'] = 'message_file_overwrite';
                            } else {
                                fwrite($fh, $now . '||' . $_POST['message'] . " - " . basename($_FILES["file"]["name"]) . " (file);");
                                $_SESSION['success'] = 'message_file';
                            }
                        } else {
                            $_SESSION['error'] = 'error_upload';
                        }
                    } else {
                        $_SESSION['error'] = 'error_extension';
                    }
                } else {
                    fwrite($fh, $now . '||' . $_POST['message'] . ';');
                    $_SESSION['success'] = 'message';
                }
            } else {
                fwrite($fh, $now . '||' . $_POST['message'] . ';');
                $_SESSION['success'] = 'message';
            }
            fclose($fh);
            header('Location: /kumpul');
        } else {
            $_SESSION['error'] = 'empty_message';
            header('Location: /kumpul');
        }
    } else {
        header('Location: /kumpul');
    }
} else {
    header('Location: /kumpul');
}
?>