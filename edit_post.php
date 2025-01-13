<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
$stmt->execute([$id]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];

    $stmt = $pdo->prepare('UPDATE posts SET title = ?, body = ?, category_id = ? WHERE id = ?');
    $stmt->execute([$title, $body, $category_id, $id]);
    header('Location: admin_dashboard.php');
    exit;
}

$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe0b2; /* Bright peach background */
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            margin-top: 100px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin-bottom: 20px;
        }
        textarea {
            resize: none; /* Prevent resizing of the textarea */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center">Edit Post</h1>
        <form method="POST">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="body">Post Body</label>
                <textarea name="body" id="body" class="form-control" rows="5" required><?php echo htmlspecialchars($post['body']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Select Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $post['category_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Post</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary btn-block mt-3">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
