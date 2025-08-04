<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "bike_store"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn){
    mysqLi_query($conn, "SET NAMES 'utf8' ");

}else{
    echo "Disconnected!";
}