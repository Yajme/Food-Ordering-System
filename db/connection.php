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
    public function read($query){
        $result = $this->connection->query($query);
        //@Exception if no data found
        if (!$result) throw new Exception("No Data Found");
         
        return $this->fetchRows($result);
    }
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
    
    public function statementBind($sql, $params) {
        // Prepare the query
        $sqlstmt = $sql;
        $stmt = mysqli_prepare($this->connection, $sqlstmt);
        
        $parameters = array();
        $types = ''; // Variable to store parameter types
    
        foreach ($params as $key => $value) {
            // Build the types string based on the type of each parameter
            if (is_int($value)) {
                $types .= 'i'; // 'i' represents integer
            } elseif (is_double($value)) {
                $types .= 'd'; // 'd' represents double
            } elseif (is_string($value)) {
                $types .= 's'; // 's' represents string
            } else {
                $types .= 'b'; // 'b' represents BLOB
            }
    
            $parameters[] = &$params[$key]; // Pass parameters by reference
        }
    
        // Bind parameters
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    
        // Execute the query
        return mysqli_stmt_execute($stmt);
    }
    
}

?>
