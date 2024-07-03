<?php

include 'connect.php';



$sql = "UPDATE form SET 'name'='Doe' WHERE id=2";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
$conn->close();

    ?>
