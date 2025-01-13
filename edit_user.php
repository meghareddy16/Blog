<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $stmt = $pdo->prepare('UPDATE users SET username = ?, is_admin = ? WHERE id = ?');
    $stmt->execute([$username, $is_admin, $id]);
    header('Location: admin_dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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
        input[type="text"] {
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
    <h1>Edit User</h1>
    <form method="POST">
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <label>
            <input type="checkbox" name="is_admin" <?php echo $user['is_admin'] ? 'checked' : ''; ?>> Admin
        </label>
        <button type="submit">Update User</button>
    </form>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
