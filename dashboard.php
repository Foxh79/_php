<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Dashboard Page</title>

    <body>

        <h1>Welcome: <?php echo $_SESSION['username']; ?>!</h1>

        <form method="POST" action="logout.php">
            <button type="submit">Logout</button>
        </form>
        
    </body>

    </html>