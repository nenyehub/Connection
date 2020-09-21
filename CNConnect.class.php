<?php

namespace CN; 

        /**
         * MySQLI - PHP "wrapper" script.
         * @author Chinenye Ndili 
         */
    class CNConnect
    {
            /** 
             * Holds a reference to the mysqli connection object that is created using the class constructor.
             * @var object mysqli
             * @link https://www.php.net/manual/en/class.mysqli.php
             */
        private $connSDB = null;

            /**
             * Stores the most recent prepared and binded statement.
             * @var mysqli_stmt
             */
        private $pstate;

            /**
             * Stores the number of rows in most recent query result.
             * @var string 
             */
        public int $numRows = 0; 
        
            /**
             * Constructs a mysqli object and assgins it to member variable $connSDB
             * Triggers an error if the connection to mySQL fails.
             * @param host Hostname or IP address. Localhost is assumed if no value is passed.
             * @param user MySQL username 
             * @param pass By default, this authenticates the user by records which have no password only. 
             * @param db The default database to be used during queries. 
             * @param port The port number to use when connecting to the MySQL server.
             * @param socket The socket that should be used for connection.
             * @link https://www.php.net/manual/en/mysqli.construct.php
             */
        public function __construct(string $host = ini_get("mysqli.default_host"), string $user = ini_get("mysqli.default_user"), string $pass = ini_get("mysqli.default_pw"), string $db = "", int $port = ini_get("mysqli_default_port"), string $socket = ini_get("mysqli.default_socket"))
        {
            self::$connSDB = new \mysqli($host, $user, $pass, $db, $port, $socket); 

            if (self::$connSDB->connect_error)
            {
                trigger_error(self::$connSDB->connect_error, E_USER_ERROR);
            }
        }

            /**
             * Prepares and SQL statement for execution and binds variables as parameters.
             * Prepared / parameterized statement support.
             * @param sql The SQL query to prepare.
             * @param types A string that contains one or more characters which specify the types for the corresponding bind variables. Types: ('i' integer, 'd' double, 's' string, 'b' blob).
             * @param var The variable to bind prepared statement to.
             * @return bool True / False If prepare and binding was successful or failed.
             * @link https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php
             */
        public function prep(string $sql, string $types, &$var)
        {
            // Check if database connection is opened 
            if (self::$connSDB == null)
            {
                // Can disable error triggers and instead rely on function returning false.
                trigger_error("Connection to MySQL server is not yet opened. Create a connection using the class constructor before calling this function. Function will return false.", E_USER_WARNING);
                return false;
            }
            
            // Prepare statement
            if (!(self::$pstate = self::$connSDB->prepare($sql)))
            {
                // Can disable error triggers and instead rely on function returning false.
                trigger_error("Prepare failed: (" . self::$connSDB->errno . ") " . self::$connSDB->error);
                return false;
            }

            // Bind parameters
            if (!self::$connSDB->bind_param($types, $var))
            {
                // Can disable error triggers and instead rely on function returning false.
                trigger_error("Binding parameters failed: (" . self::$pstate->errno . ") " . self::$pstate->error);
                return false;
            }

            return true;

        }

            /**
             * Executes the prepared statement. 
             * @return bool True / False on success or failiure
             */
        public function execPrep() {
            return self::$pstate->execute();
        }
        

            /**
             * Executes an SQL query and returns the nth result row as a numeric / associative array (default BOTH).
             * Keeps a reference to the most recent query result object and its number of rows in class variables $numRows and $result. Executes in constant time - O(1) time complexity. Uses the current connection created with new(). 
             * @param string $sql SQL query to be executed
             * @param int $rowNum [optional] Number of the row that is fetched from query result (1-based). Default value is 1.
             * @param int $arrayType [optional] MYSQLI_NUM | MYSQLI_ASSOC | MYSQLI_BOTH. The type of array that will be returned from query. Default value is MYSQLI_BOTH, which returns both an associative and numeric array.
             * @return array|bool Returns the nth result row as an associative and / or numeric array if the query is a sucessful SELECT, SHOW, DESCRIBE or EXPLAIN query. Returns true for other successful queries. Returns false on query failure, if mySQL connection does not exist, or if the selected row is out of bounds or otherwise DNE.
             */
        public function getRow(string $sql, int $rowNum = 1, int $arrayType = MYSQLI_BOTH)
        {
            if (self::$connSDB) // Check if mySQL connection exists
            {
                $result = self::$connSDB->query($sql) or die(mysqli_error(self::$connSDB)); // Execute query
                if (is_object($result)) // Check if $query result is a mysqli_result object ... dont want to use for loop on a bool. This line WOuld have to be updated if mysqli_query stopped returning obj
                {
                    self::$numRows = mysqli_num_rows($result); // Stores number of rows in result to a static field

                    $rowNum--; // Changes rowNum to 0-based number for use in mysqli_data_seek()
                    if (!mysqli_data_seek($result, $rowNum)) // Adjusts result pointer to the ($rowNum)th row 
                    {
                        return false; //return false if row is out of bounds
                    }
                    
                    $row = mysqli_fetch_array($result, $arrayType);

                    return $row;
                }
                else {return $result;} // Returns true or false if query result is a boolean, not mysqli_result object
            }
            else
            {
                trigger_error("Connection to MySQL server is not yet opened. Create a connection using the class constructor before calling this function. Function will return false.", E_USER_WARNING);
                return false;
            }
        }

            /**
             * Executes an SQL query on the established connection.
             * Keeps a reference to the most recent query result object and its number of rows in class variables $numRows and $result. Make a MySQL connection object using new() before calling this function.
             * @param string $sql SQL query to be executed 
             * @return mysqli|bool Returns 'mysqli_result' object on successful SELECT, SHOW, DESCRIBE or EXPLAIN queries. Returns TRUE on other successful queries. Returns FALSE on failure. (php.net)
             * @link https://php.net/manual/en/mysqli.query.php
             */
        public function query(string $sql)
        {
            if (self::$connSDB)
            {
                $result = self::$connSDB->query($sql) or die(mysqli_error(self::$connSDB));
                if (is_object($result))
                {
                    self::$numRows = mysqli_num_rows($result);
                    return $result; 
                }
                else {return $result;}
            }
            else
            {
                trigger_error("Connection to MySQL server is not yet opened. Create a connection using the class constructor before calling this function. Function will return false.", E_USER_WARNING);
                return false;
            }
        }

    }
?>
