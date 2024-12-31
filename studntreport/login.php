<?php
// Start session
session_start();

// Array to store validation errors
$errmsg_arr = array();

// Validation error flag
$errflag = false;

// Connect to MySQL server using MySQLi
$link = new mysqli('localhost', 'root', '', 'model');

// Check connection
if ($link->connect_error) {
    die('Failed to connect to server: ' . $link->connect_error);
}

// Function to sanitize values received from the form
function clean($str, $link) {
    $str = trim($str);
    return $link->real_escape_string($str);
}

// Sanitize the POST values
$login = isset($_POST['username']) ? clean($_POST['username'], $link) : '';
$password = isset($_POST['password']) ? clean($_POST['password'], $link) : '';

// Input Validations
if ($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if ($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

// If there are input validations, redirect back to the login form
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
}

// Create query using prepared statements to prevent SQL injection
$stmt = $link->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $login, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check whether the query was successful or not
if ($result) {
    if ($result->num_rows > 0) {
        // Login Successful
        session_regenerate_id();
        $member = $result->fetch_assoc();
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['name'];
        $_SESSION['SESS_LAST_NAME'] = $member['position'];
        // Redirect to main page
        session_write_close();
        header("location: main/index.php");
        exit();
    } else {
        // Login failed
        $_SESSION['ERRMSG_ARR'] = ['Invalid username or password'];
        session_write_close();
        header("location: index.php");
        exit();
    }
} else {
    die("Query failed: " . $link->error);
}

// Close the statement and connection
$stmt->close();
$link->close();
?>
