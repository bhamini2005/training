<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "demo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $email = $_POST['email'];
    $password = $_POST['psw'];

    // Validate form data
    if (empty($email) || empty($password)) {
        echo "<p style='color: red;'>All fields are required.</p>";
    } else {
        // Check user credentials
        $sql = "SELECT id, password FROM signup WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $hashedPassword);

        if ($stmt->num_rows > 0) {
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                // Start a new session and save user ID in session
                session_start();
                $_SESSION['user_id'] = $id;
                header ("location:welcome.php");
            } else {
                echo "<p style='color: red;'>Invalid password.</p>";
            }
        } else {
            echo "<p style='color: red;'>No user found with this email.</p>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<center>
<form action="login.php" method="post" style="border:1px solid #ccc">
  <div class="container">
    <h1>Login</h1>
    <p>Please enter your email and password to log in.</p>
    

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required><br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required><br>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label><br>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="loginbtn">Login</button>
    </div>
  </div>
</form>
</center>
</body>
</html>