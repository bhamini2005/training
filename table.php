<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table</title>
</head>
<body>


    <table border="1" cellspacing="0" cellpadding="10"><tr>
        <td >Name</td>
        <td>Email</td>
        <td>Mobile</td>
        <td>Password</td>
        <td>Delete</td>
        <td>Update</td>
<tr>
</tr>
<?php
include 'connect.php';

$sql = 'select * from form';
$a=mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($a)){
    $Name=$row['Name'];
    $Email=$row['Email'];
    $Mobile=$row['Mobile'];
    $Pass=$row['Password'];
    
    echo ' <tr>
    <td>'.$Name.'</td>
    <td>'.$Email.'</td>
    <td>'.$Mobile.'</td>
    <td>'.$Pass.'</td>
    <td><a href="delete.php?name='.$Name.'">delete</a></td>
    <td><a href="update.php?name='.$Name.'">update</a></td>
    </tr>';

}
?>
</table>

</body>
</html>