<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "demo";
$conn = new mysqli($servername,$username,$password,$database) or die("unable to connect");


$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$mobile = $_REQUEST['mobile'];
$password= $_REQUEST['password'];

// We are going to insert the data into our sampleDB table
$sql = "INSERT INTO form VALUES ('$name',
    '$email','$mobile','$password')";

     // Check if the query is successful
     if(mysqli_query($conn, $sql)){
        echo "<h3>data stored in a database successfully."
            . " Please browse your localhost php my admin"
            . " to view the updated data</h3>";

    } else{
        echo "ERROR: $sql. "
            . mysqli_error($conn);
    }

    
    // Close connection
    mysqli_close($conn);

   ?>
</body>
</html>