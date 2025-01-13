<!-- <?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];

    $stmt = $pdo->prepare('INSERT INTO posts (title, body, category_id) VALUES (?, ?, ?)');
    $stmt->execute([$title, $body, $category_id]);
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
    <title>Create Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9f7ef; /* Brighter background color */
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
        <h1 class="text-center">Create Post</h1>
        <form method="POST">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter post title" required>
            </div>




            <div class="form-group">
                <label for="body">Post Body</label>
                <textarea name="body" id="body" class="form-control" rows="5" placeholder="Enter post body" required></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Select Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Post</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary btn-block mt-3">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> -->




<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];

    // Handle image upload
    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_dir = 'uploads/'; // Make sure this directory exists and is writable
        $image_path = $image_dir . $image_name;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            $image_url = $image_path;
        }
    }

    // Insert post with image URL
    $stmt = $pdo->prepare('INSERT INTO posts (title, body, category_id, image_url) VALUES (?, ?, ?, ?)');
    $stmt->execute([$title, $body, $category_id, $image_url]);
    
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
    <title>Create Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9f7ef; /* Brighter background color */
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
        <h1 class="text-center">Create Post</h1>
        <form method="POST" enctype="multipart/form-data"> <!-- Added enctype -->
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter post title" required>
            </div>

            <div class="form-group">
                <label for="body">Post Body</label>
                <textarea name="body" id="body" class="form-control" rows="5" placeholder="Enter post body" required></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Select Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Create Post</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary btn-block mt-3">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
