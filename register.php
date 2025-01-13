<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $is_admin = isset($_POST['user_type']) && $_POST['user_type'] === 'admin' ? 1 : 0;

    $stmt = $pdo->prepare('INSERT INTO users (username, password, email, first_name, last_name, is_admin) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$username, $password, $email, $first_name, $last_name, $is_admin]);
    header('Location: user_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        body {
            background: hsl(210, 100%, 95%);
            color: hsl(210, 50%, 20%);
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            background: hsl(210, 80%, 60%);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
        }
        button {
            background: hsl(150, 100%, 40%);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: hsl(150, 100%, 50%);
        }
        label {
            display: block;
            margin: 10px 0;
        }
        a {
            margin-top: 10px;
            color: hsl(210, 50%, 20%);
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Registration</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>

        <label>
            <input type="radio" name="user_type" value="user" checked> Regular User
    </label>

        <button type="submit">Register</button>
    </form>
    <a href="admin_login.php">Already have an account? Login as Admin here</a>
    <a href="user_login.php">Already have an account? Login As User</a>
</body>
</html>

