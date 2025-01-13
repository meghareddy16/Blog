
<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
$posts = $pdo->query('SELECT p.*, c.name AS category_name FROM posts p LEFT JOIN categories c ON p.category_id = c.id')->fetchAll();
$users = $pdo->query('SELECT * FROM users')->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: hsl(210, 100%, 90%);
            color: hsl(210, 50%, 20%);
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: hsl(210, 80%, 50%);
            color: white;
        }
        .list-group-item {
            background-color: hsl(210, 100%, 95%);
        }
        .list-group-item:hover {
            background-color: hsl(210, 100%, 90%);
        }
        a.btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin Dashboard</h1>

        <h2>Manage Users</h2>
        <a href="create_user.php" class="btn btn-primary mb-3">Create New User</a>
        <ul class="list-group mb-5">
            <?php foreach ($users as $user): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($user['username']); ?>
                    <div>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Categories</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($categories as $category): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                    <div>
                                        <a href="edit_category.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete_category.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="create_category.php" class="btn btn-primary mt-2">Create New Category</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Posts</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($posts as $post): ?>
                                <li class="list-group-item">
                                    <h5><?php echo htmlspecialchars($post['title']); ?></h5>

                                    

                                     <?php if (!empty($post['image_url'])): ?>
                                        <img src="<?php echo htmlspecialchars($post['image_url']); ?>" class="post-image" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                    <?php endif; ?> 



                                    <p><?php echo htmlspecialchars($post['body']); ?></p>
                                    <p><strong>Category:</strong> <?php echo htmlspecialchars($post['category_name']); ?></p>
                                    <div>
                                        <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="create_post.php" class="btn btn-primary mt-2">Create New Post</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="admin_logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 



