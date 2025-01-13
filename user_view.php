<!-- <?php
session_start();
require 'db.php';

$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
$category_filter = isset($_GET['category_id']) ? $_GET['category_id'] : null;

$posts_query = 'SELECT p.*, c.name AS category_name FROM posts p LEFT JOIN categories c ON p.category_id = c.id';
if ($category_filter) {
    $posts_query .= ' WHERE p.category_id = ?';
    $stmt = $pdo->prepare($posts_query);
    $stmt->execute([$category_filter]);
} else {
    $stmt = $pdo->query($posts_query);
}
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts by Category</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: hsl(200, 100%, 90%); /* Light blue background */
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            color: hsl(200, 100%, 20%); /* Darker blue for headings */
        }
        .post-container {
            background-color: hsl(50, 100%, 95%); /* Light yellow background for posts */
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .filter-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .filter-container select {
            width: 200px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: hsl(200, 100%, 30%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Posts</h1>
        
        <div class="filter-container">
            <form method="GET">
                <select name="category_id" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $category_filter) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <div>
            <?php foreach ($posts as $post): ?>
                <div class="post-container">
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php echo htmlspecialchars($post['body']); ?></p>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($post['category_name']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <a href="user_login.php">Logout</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> -->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts by Category</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: hsl(200, 100%, 90%); /* Light blue background */
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            color: hsl(200, 100%, 20%); /* Darker blue for headings */
        }
        .card-container {
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .filter-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .filter-container select {
            width: 200px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: hsl(200, 100%, 30%);
        }
        a button{
            font-size:1.2rem;
            background-color:blue;
            color:white;
        }
    </style>
</head>
<body>
    <div class="container">

    <div class="filter-container">
        <h2>Categories</h2>
            <form method="GET">
                <select name="category_id" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $category_filter) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <h2>Posts</h2>

        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4 card-container">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($post['body']); ?></p>
                            <p class="card-text"><small class="text-muted">Category: <?php echo htmlspecialchars($post['category_name']); ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <a href="user_login.php"><button >Logout</button></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 

