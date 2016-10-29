# Excel2MySQL

This is an application created to export Excel spreadsheet to MySQL table using PHPExcel.

This program takes a file example1.xlsx as input and will upload the data to a table example in the database of your choice.
For now the filename and table names are hardcoded in the index.php. File example1.php must be located in root or you may change location of file in the variable 'inputFileName'.

Before using, change the database server name, username, password and database name in the files db.php as per
your server settings.

Input file must contain column names in first row as these names are used to create database table and second column should not be empty since datatype for each column is taken from second colummnn. This program may not work as intended if this pattern isn't followed.

Feedbacks are always welcome.

