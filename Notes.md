## Objectives:
    - Make script more secure (password)
    - Use this class as a memory saver (optimize memory)


## Ideas:
    - Can make this class a stack of mysqli objects... stack/queue storing multiple db connections
    - Having password stored in plaintext is insecure... possible way to fix this? 
    - Integrate hashing algorithm to store password
    - Use $var-> operator to access 'mysqli' object functions, use Connection:: operator to access
      'Connection' class functions
    - Replace __construct function with another name ... becaus as of now using it by 'new Connection;' is useless
    - Make 'new Connection' actually do something and change current constructor's name


## Notes;
    - This file is the weak point of every database... because contains plaintext password; use different authentication method ???
    - Any result object generated in this class' functions will be deallocated when the function call is finished. Therefore, to save the most memory the field $result can be deleted.
    - If you wish to pass a pointer to a function (sharing) and not an object (cloning), using &ampersand syntax: &$object where $object is the obj of interest. Passes pointer to obj instead of obj

