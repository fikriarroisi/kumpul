<?php

class Setting
{
    public $receiving = true; //allow sending something
    public $receive_message_and_file = true; //allow sending file
    public $allow_overwrite_file = true; //allow overwrite file
    public $restrict_file_extension = true; //restrict uploaded file extension based on $allowed_file_type
    public $allowed_file_extension = [
        'doc',
        'docx',
        'pdf',
        'zip',
        'rar',
    ]; //list of allowed file extension

    //password
    public $set_password = true; //activate password
    public $password = 'pekopon'; //the password
}

?>