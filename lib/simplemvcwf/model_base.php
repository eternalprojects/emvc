<?php
// ModelBase contains all of the base functions necessary for
//   each model class to execute queries as easily as
//   possible
class ModelBase {    
    private function __construct() {
    }    

    // Executes a SQL query and returns the result
    protected function query($sql) {
        // Retrieve the database configuration values from the dbconfig.php file
        global $dbconfig_host;
        global $dbconfig_database;
        global $dbconfig_username;
        global $dbconfig_password;
    
        try {
            $conn = new PDO('mysql:host=' . $dbconfig_host . ';dbname=' . $dbconfig_database, $dbconfig_username, $dbconfig_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->query($sql);
            $conn = null;
                    
            $result = array();
            $i = 0;
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $result[$i] = $row;
                $i++;
            }
        }
        catch(PDOException $e)
        {
            // This is example try/catch error handling. For the purposes of this demo,
            //   we don't need to do much here.
            echo $e->getMessage();
        }
        return $result;
    }
    
    // Executes a SQL query and returns only the first row
    protected function queryFirst($sql) {
        $result = $this->query($sql);
        
        return $result[0];
    }
    
    // Executes a non-query SQL statement
    protected function execute($sql) {
        // Retrieve the database configuration values from the dbconfig.php file
        global $dbconfig_host;
        global $dbconfig_database;
        global $dbconfig_username;
        global $dbconfig_password;
     
        try {   
            $conn = new PDO('mysql:host=' . $dbconfig_host . ';dbname=' . $dbconfig_database, $dbconfig_username, $dbconfig_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $count = $conn->exec($sql);
            $conn = null;
        }
        catch(PDOException $e)
        {
            // This is example try/catch error handling. For the purposes of this demo,
            //   we don't need to do much here.
            echo $e->getMessage();
        }
        return $count;
    }
}
?>