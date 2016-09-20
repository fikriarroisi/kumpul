Kumpul
===
Simple web based message and file collector/receiver.<br>
Not require any DBMS such as Mysql, MariDB, SQLite, ETC., just using file.<br>
Copy this little program to your server directory, start your server, and you ready to go.<br>
All stored in file and folder. All messages stored in `log.txt` file and all uploaded files stored in `/files/` directory.

Settings
---
File setting located in `/include/setting.php`, change the attribute value.

- `$receiving` = `true` or `false`<br>
`true` for allow user to send something, `false` for do not allow user to send anything.
- `$receive_message_and_file` = `true` or `false`<br>
`true` for allow user to upload file, `false` for do not allow user to upload file.
- `$allow_overwrite_file` = `true` or `false`<br>
`true` if the file is already exist in `/files/` directory with the same file name, user allowed to upload that file and will overwrite the existing file. `false` if the file is already exist in `/files/` directory with the same file name, user do not allowed to upload that file.
- `$restrict_file_extension` = `true` or `false`<br>
`true` for just allowing file with the extension in `$allowed_file_extension` can be uploaded, `false` can upload file with any extension.
- `$allowed_file_extension` = list of allowed file extension.
- `$set_password` = `true` or `false`<br>
`true` for activate password, user can not send anything without input the correct password. `false` for allow user to send anything without inputting password.
- `$password` = `"password string"`<br>
Set your password here.

Other
---
Created with <3 by Fikri Arroisi.<br>
Be sure to let me know if you like and find this application is useful.