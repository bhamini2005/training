<?php
include 'connect.php';
 if(isset($_GET['name'])){
    $a=$_GET['name'];
    $b="DELETE FROM FORM WHERE Name='$a'";
    $c=mysqli_query($conn,$b);
    if($c)
{
    header('location:table.php');
}
    else
    {
        echo "not deleted";
        }

 }

?>