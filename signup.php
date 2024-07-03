<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "demo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $passwordRepeat = $_POST['psw-repeat'];

    // Validate form data
    if (empty($email) || empty($password) || empty($passwordRepeat)) {
        echo "<p style='color: red;'>All fields are required.</p>";
    } elseif ($password !== $passwordRepeat) {
        echo "<p style='color: red;'>Passwords do not match.</p>";
    } else {
        // Check if email already exists
  $sql = "SELECT id FROM signup WHERE email=?";
  $stmt = $conn->prepare($sql);
  if ($stmt === false) {
      // Display SQL error message
      echo "<p style='color: red;'>Error preparing statement: " . htmlspecialchars($conn->error) . "</p>";
  } else {
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
          echo "<p style='color: red;'>Email already exists.</p>";
      } else {
          // Hash the password
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          // Insert user into the database
          $sql = "INSERT INTO signup (email, password) VALUES (?, ?)";
          $stmt = $conn->prepare($sql);
          if ($stmt === false) {
              // Display SQL error message
              echo "<p style='color: red;'>Error preparing statement: " . htmlspecialchars($conn->error) . "</p>";
          } else {
            $stmt->bind_param("ss", $email, $hashedPassword);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Registration successful!</p>";
            } else {
                echo "<p style='color: red;'>Error: " . htmlspecialchars($stmt->error) . "</p>";
            }
        }
    }

    $stmt->close();
}
}

$conn->close();
}
?>
<center>
<form action="signup.php" method="post" style="border:1px solid #ccc">
<div class="container">
<h1>Sign Up</h1>
<p>Please fill in this form to create an account.</p>


<label for="email"><b>Email</b></label>
<input type="text" placeholder="Enter Email" name="email" required><br>

<label for="psw"><b>Password</b></label>
<input type="password" placeholder="Enter Password" name="psw" required><br>
<label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label><br>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p><br>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
</center>
</body>
</html>