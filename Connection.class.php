<?php
    /**
     * Represents a connection to a mySQL database.
     * @author Chinenye Ndili
     */
    class Connection
    {
            /**
             * Stores the connection between PHP and a mySQL database.
             * Stores a single instance of this connection; can only be accessed
             * through public interface. 
             * @var object SQL connection object
             * @access private 
             */
        private static $connSDB;

            /**
             * Stores hostname 
             * @access private 
             */
        private $hostname = 'localhost';

            /**
             * Stores database information 
             * @access private
             */
        private $database = 'databasename';

            /**
             * Stores username
             * @access private
             */
        private $username = 'root';

            /**
             * Stores connection password
             * @access private 
             */
        private $password = 'password';

            /**
             * Private constructor to limit object instantiation to within the class.
             * Triggers error if connection to mySQL database fails.
             * @access private
             */
        private function __construct()
        {
            $connSDB = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            if ($connSDB->connect_error) 
            {
                trigger_error($connSDB->connect_error, E_USER_ERROR);
            }

        }

            /**
             * Creates and returns a single mySQL connection.
             * @access public
             * @return object returns mySQL connection as 'Connection' object
             */
        public static function getConn()
        {
            if (!self::$connSDB)
            {
                self::$connSDB = new Connection; 
            }
            return self::$connSDB;
        }

            /**
             * Performs query on the database using current connection
             * @param string A mySQL query 
             * @return object mysqli_result || bool
             * @access public
             * @link https://www.php.net/manual/en/mysqli.query
             */
        public function query($query)
        {
            return self::$connSDB->query($query);
        }

            /**
             * Changes the database connection
             * @param string mySQL Database
             * @return bool True on Success || False on failiure
             * @access public 
             * @link https://www.php.net/manual/en/mysqli.select-db.php
             */
        public function dbselect($database)
        {
            return self::$connSDB->select_db($database);
        }
    }
?>