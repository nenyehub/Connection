# The CNConnect class 

CNConnect is a class designed to supplement connection between PHP and MySQL. 

CNConnect is an object oriented solution aiming to reduce the amount of code neccesary to work with the mysqli connection objects. 

As of 9/21/20, I've redesigned the entire class with the below notable changes:
* Added support for prepared statements
* Added namespace 'CN'
* Removed hard-coded configuration values 
* Removed static member variables
* Removed new() and freeResult() functions
* Improved security by removing configuration member variables (such as $password)



    

## Project Files

`CNConnect.class.php` - The CNConnect class source code 
`Notes.md` - General notes and ideas on which direction I want the class to head in (old)
`readme.md` - The readme file
`testConnection.php` - Tester script to test MySQL connection and various methods within CNConnect (needs updating)

