<?php
    $servername='127.0.0.1';
    $host='localhost';
    $username='noura';
    $password='12345';
    $dbname = "123";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
    if(!$conn){
        die('Could not Connect MySql Server:' .mysqli_connect_error());
    }
    if($conn){
        echo'welcome';
    }
?>
