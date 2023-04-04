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
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user into the database
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "maseno university";

    $conn = new mysqli($host, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $stmt->close();

    // Set session variables and redirect to dashboard
    $_SESSION['username'] = $username;
    $_SESSION['loggedin'] = true;
    header("Location: dashboard.php");
    exit();
}

// Get the username parameter from the URL if it exists
$username = "";
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
