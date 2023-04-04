<?php
session_start();

if (isset($_SESSION['username'])) {
    // Redirect to dashboard if user is already logged in
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "maseno university";

    $conn = new mysqli($host, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect, display error message
            $error_message = "Invalid password.";
        }
    } else {
        // User does not exist, display sign-in option
        echo "<p>This username does not exist. Would you like to sign up?</p>";
        echo "<a href='signup.php?username=" . urlencode($username) . "'>Sign up</a>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
