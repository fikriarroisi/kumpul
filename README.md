Kumpul
===
Simple web based message and file collector/receiver.<br>
Not require any DBMS such as Mysql, MariaDB, SQLite, ETC., just using file.<br>
Copy this little program to your server directory, start your server, and you ready to go.<br>
All stored in file and folder. All messages stored in `record.txt` and `record_admin.txt` file and all uploaded files stored in `/files/` directory.

Settings
---
File setting located in `/include/setting.php`, change the attribute value.
####Send
- `$allow_send` = `true` or `false`<br>
`true` for allow user to send something, `false` for do not allow user to send anything.
- `$set_password_send` = `true` or `false`<br>
`true` for activate password for sending, user can not send anything without input the correct password. `false` for allow user to send anything without inputting password.
- `$password_send_public` = `"password string"`<br>
Set your send as guest password here.
- `$password_send_admin` = `"password string"`<br>
Set your send as admin password here.
- `$allow_send_file` = `true` or `false`<br>
`true` for allow user to upload file, `false` for do not allow user to upload file.
- `$allow_overwrite_file` = `true` or `false`<br>
`true` if the file is already exist in `/files/` directory with the same file name, user allowed to upload that file and will overwrite the existing file. `false` if the file is already exist in `/files/` directory with the same file name, user do not allowed to upload that file.
- `$restrict_file_extension` = `true` or `false`<br>
`true` for just allowing file with the extension in `$allowed_file_extension` can be uploaded, `false` can upload file with any extension.
- `$allowed_file_extension` = `list`<br>
List (array) of allowed file extension.

####View
- `$allow_view` = `true` or `false`<br>
`true` for allow user to view record, `false` for do not allow user to view record.
- `$set_password_view` = `true` or `false`<br>
`true` for activate password for view record, user can not view record without input the correct password. `false` for allow user to view record without inputting password.
- `$password_view` = `"password string"`<br>
Set your view record password here.
- `$number_of_items` = `integer number`<br>
Set your maximum number of records displayed in one page.

####Other
- `$description` = `"description string"`<br>
Set your site description, it is placed under site title (KUMPUL).
- `$root_directory` = `"directory"`<br>
Set your root directory for this application, usually `/kumpul` or `/`.


Other
---
Created with <3 by Fikri Arroisi.<br>
Be sure to let me know if you like and find this application is useful.