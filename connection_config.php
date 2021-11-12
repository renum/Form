<?php
    $servername="localhost";
    $username="root";
    $password="root";
    $dbname="candDb3";

    
    //Create connection mySQLi Object oriented

    /*
    
    $sql="CREATE DATABASE candDB1";

    $conn=new mysqli($servername,$username,$password,"",3306);
    if($conn->connect_error){

        die("connection failed" . $conn->connect_error);
    }
    echo "connected successfully";

    if ($conn->query($sql) == TRUE){

        echo "candDB1 created";
        echo "<br/>";
    }
    else{

        echo "Error creating candDB1". $conn->error;
        echo "<br/>";
    }

    $conn->close();
    
    
    
    
    
    
    //Create connection mySQLi procedural

    $sql="CREATE DATABASE candDB2";
   
    $conn=mysqli_connect($servername,$username,$password);
    if(!$conn){

        die("connection failed" .mysqli_connect_error());
        
    }
    echo "connected successfully";

    if(mysqli_query($conn, $sql) ){

        echo "candDB2 created";
        echo "<br/>";
    }
    else{

        echo "Error creating canddB2". mysqli_error($conn);
        echo "<br/>";
    }

    mysqli_close($conn);

    
    
    
    //Create connection PDO
   
    $sql="CREATE DATABASE candDB3";
   
    try{

    
        $conn=new PDO("mysql:host=$servername",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //set PDO error mode to exception
        echo "Connected successfully";
        echo "<br/>";
        $conn->exec($sql);
        echo "candDB3 created";
        echo "<br/>";
    }
    catch(PDOException $e){
        echo $sql .$e->getMessage();
    }

    $conn=null;

    */

     //Create connection PDO
   
    /*$sql="CREATE TABLE $dbName.CandDetails (
            Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Name VARCHAR(30) NOT NULL,
            Email VARCHAR(50),
            Gender char(1),
            Comments VARCHAR(100),
            Preference VARCHAR(20),
            Availability VARCHAR(10),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

        )";*/

     
     


?>