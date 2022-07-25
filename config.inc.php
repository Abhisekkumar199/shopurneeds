 <?php
global $servername;
global $username;
global $password;
global $database;
global $conn; 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "db_shopurneeds";
// Create connection 
  $conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
?>