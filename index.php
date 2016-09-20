<?php
session_start();
include_once 'include/setting.php';
$setting = new Setting();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="easy collect message and file">
    <meta name="author" content="Fikri Arroisi">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <title>Kumpul</title>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="col-md-12">
            <div class="panel">
                <div class="text-center">
                    <h1>KUMPUL</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="notification">
            <?php
            if (isset($_SESSION['error'])) {
                $alert = 'Error';
                switch ($_SESSION['error']) {
                    case 'empty_message':
                        $alert = 'Error, Message field can not be empty';
                        break;
                    case 'error_upload':
                        $alert = 'Error when uploading file';
                        break;
                    case 'error_upload_exist':
                        $alert = 'Error, file with the same name already exists';
                        break;
                    case 'error_extension':
                        $alert = 'Error, file not allowed';
                        break;
                    case 'empty_password':
                        $alert = 'Error, Password field can not be empty';
                        break;
                    case 'wrong_password':
                        $alert = 'Error, wrong password';
                        break;
                }
                session_destroy();
                echo "<div class='alert alert-danger text-center col-md-12'>$alert</div>";
            }
            if (isset($_SESSION['success'])) {
                $alert = 'Success';
                switch ($_SESSION['success']) {
                    case 'message':
                        $alert = 'Success, your message has been sent';
                        break;
                    case 'message_file':
                        $alert = 'Success, your message and file has been sent';
                        break;
                    case 'message_file_overwrite':
                        $alert = 'Success, your message and file has been sent (replaced)';
                        break;
                }
                session_destroy();
                echo "<div class='alert alert-success text-center col-md-12'>$alert</div>";
            }
            ?>
        </div>
        <div class="form">
            <div class="col-md-6 col-md-offset-3">
                <form action="upload.php" method="post" enctype="multipart/form-data" class="panel panel-default">
                    <div class="panel-heading">
                        Kumpul Form
                    </div>
                    <?php
                    if (!$setting->receiving) {
                        echo '<div class="alert alert-danger text-center">Not receive anything for now</div>';
                    } else {
                        ?>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="message">Message : </label>
                                <input type="text" name="message" id="message" class="form-control">
                            </div>
                            <?php if ($setting->receive_message_and_file) { ?>
                                <div class="form-group">
                                    <label for="file">File : </label>
                                    <input type="file" name="file" id="file">
                                </div>
                            <?php } ?>
                            <?php if ($setting->set_password) { ?>
                                <div class="form-group">
                                    <label for="password">Password : </label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            <?php } ?>
                            <input type="submit" value="Send" name="submit" class="btn btn-primary btn-block">
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
        <div class="record">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Kumpul Record
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Message</th>
                            </tr>
                            <?php
                            $fh = fopen('log.txt', 'r');
                            $text = fread($fh, filesize('log.txt'));
                            fclose($fh);
                            $atext = array_reverse(explode(';', trim($text)));
                            if (count($atext) <= 1) {
                                echo "<tr class='danger text-center'><td>#</td><td>Empty</td><td>Empty</td></tr>";
                            } else {
                                $number = count($atext);
                                foreach ($atext as $text) {
                                    $is_file = false;
                                    $is_replaced = false;
                                    $raw_text = explode('||', $text);
                                    $date = $raw_text[0];
                                    $message = $raw_text[1];
                                    if (strpos($message, '(file)') !== false) {
                                        $is_file = true;
                                    }
                                    if (strpos($message, '(replaced)') !== false) {
                                        $is_replaced = true;
                                    }
                                    if($message){
                                        if ($is_replaced) {
                                            echo "<tr class='success'><td>$number</td><td>$date</td><td>$message</td></tr>";
                                        } else if ($is_file) {
                                            echo "<tr class='info'><td>$number</td><td>$date</td><td>$message</td></tr>";
                                        } else {
                                            echo "<tr><td>$number</td><td>$date</td><td>$message</td></tr>";
                                        }
                                    }
                                    $number -= 1;
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center footer">
        © 2016 Fikri Arroisi
    </div>
</div>
</body>
</html>