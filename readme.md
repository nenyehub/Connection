# The CNConnect class 

CNConnect functions as both a simple MySQL connection script and a static class containing methods designed for MySQL connection objects. 

As a connection script, CNConnect stores connection information including the username, hostname, database, and password. Upon calling function CNConnect::new(), the class uses this info to create and return a mysqli_connect object. Because 'new()' doesn't return a unique 'CNConnect' object, but instead returns as 'mysqli', the rest of this class' methods can be ignored and CNConnect can be used solely to create MySQL connection objects using the encapsulated connection info. 


As a class, CNConnect aims to reduce the amount of code neccesary to work with the mysqli_result objects that successful database queries return, and to conserve the memory taken by these objects. Documentation on the class fields and methods can be found in the source code.  

    * If your MySQL server is offline, CNConnect::new() results in error "Fatal error - connection refused"
    * To connect without a password, leave $password field as ''. 
    * Call every function statically, using 'CNConnect::functionname(params)'
    

## Project Files

`CNConnect.class.php` - The CNConnect class source code 
`Notes.md` - General notes and ideas on which direction I want the class to head in
`readme.md` - The readme file
`testConnection.php` - Tester script to test MySQL connection and various methods within CNConnect

