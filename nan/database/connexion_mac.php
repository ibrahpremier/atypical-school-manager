<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename="nandb";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password, array(
            PDO::ATTR_PERSISTENT => true
        ));
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        die("Connection failed: " . $e->getMessage());
    }
    
?>