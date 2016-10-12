<?php

class Setting
{
    //send
    public $allow_send = true; //allow sending something
    public $set_password_send = true; //activate password for send
    public $password_send_public = 'sendpass'; //the public password for send
    public $password_send_admin = 'sendpassadmin'; //the owner password for send
    public $allow_send_file = true; //allow sending file
    public $allow_overwrite_file = true; //allow overwrite file
    public $restrict_file_extension = true; //restrict uploaded file extension based on $allowed_file_type
    public $allowed_file_extension = [
        'doc',
        'docx',
        'odt',
        'pdf',
        'zip',
        'rar',
    ]; //list of allowed file extension

    //view
    public $allow_view = true; //allow view record
    public $set_password_view = false; //activate password for view record
    public $password_view = 'viewpass'; //the password for view
    public $number_of_items = 15; //number of items displayed in one page

    //other
    public $description = "Collect Text and File with Ease"; //site description (under page title)
    public $root_directory = '/kumpul'; //root sites directory for kumpul

}