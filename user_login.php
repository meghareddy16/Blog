
<?php
session_start();
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: user_view.php');
    } else {
        echo "<p style='color:red;'>Invalid credentials.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgb(238,174,202);
            background: radial-gradient(circle, rgba(238,174,202,1) 6%, rgba(164,93,125,1) 11%, rgba(161,161,161,1) 100%);             height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: #333;
        }
        .login-container {
            background: #ffffff; /* White background for the form */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #007bff; /* Blue color for the heading */
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            backgroud-color:#00FFFF;
        }
        input:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            background-color: #007bf0;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        p {
            margin-top: 10px;
            color: #666; /* Gray text for feedback messages */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>User Login</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
