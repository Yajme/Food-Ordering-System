<?php

interface IFunctions{
    public function execute($query);
    public function read($query);
    public function escape_string($value);
    
}
abstract class Database implements IFunctions
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_boos";
    protected $connection;

    public function __construct()
    {
        if (!isset($this->connection)) 
        {
            $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);

            // Check the connection
            if ($this->connection->connect_error) {
                die('Cannot connect to the database server: ' . $this->connection->connect_error);
            }
        }

        return $this->connection;
    }
    /**
     * Fetches rows from a database result set and returns them as an array of associative arrays.
     *
     * @param mysqli_result $result The result set obtained from a database query.
     * @return array An array containing the fetched rows as associative arrays.
     */
    private function fetchRows($result) {
        $dataArray = array();

        while ($row = $result->fetch_assoc()) {
            // Create a new associative array for each row
            $rowData = array();

            // Iterate over each column in the row
            foreach ($row as $columnName => $columnValue) {
                // Add each column to the $rowData array
                $rowData[$columnName] = $columnValue;
            }

            // Append the row data to the main array
            $dataArray[] = $rowData;
        }

        return $dataArray;
    }

    public function execute($query){
        return  $this->connection->query($query);
    }
    /**
     * Reads data from the database based on the provided query.
     *
     * @param string $query The SQL query to execute.
     * @return array The fetched rows from the database.
     * @throws Exception If no data is found.
     */
    public function read($query){
        // Execute the query
        $result = $this->connection->query($query);
        //@Exception if no data found
        if (!$result) throw new Exception("No Data Found");
        
        return $this->fetchRows($result);
    }
    /**
     * Escapes a string value to prevent SQL injection.
     *
     * @param string $value The string value to be escaped.
     * @return string The escaped string value.
     * @throws Exception If the input value is not a string or if the escape operation fails.
     */
    public function escape_string($value) {
        // Check if the input is a valid string
        if (!is_string($value)) {
            throw new Exception('Invalid input: $value must be a string.');
        }
        // Escape the string
        $escapedValue = $this->connection->real_escape_string($value);

        // Check if the escape was successful
        if ($escapedValue === false) {
            throw new Exception('Invalid input: $value must be valid');
        }
        return $escapedValue;
    }
    
}
?>
