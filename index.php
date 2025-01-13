<!-- <?php
session_start();
require 'db.php';

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

$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
?>

<h1>Posts</h1>

<form method="GET">
    <select name="category_id">
        <option value="">All Categories</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $category_filter) ? 'selected' : ''; ?>>
                <?php echo $category['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Filter</button>
</form>

<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <h2><?php echo $post['title']; ?></h2>
            <p><?php echo $post['body']; ?></p>
            <p>Category: <?php echo $post['category_name']; ?></p>
            <p><a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a> | <a href="delete_post.php?id=<?php echo $post['id']; ?>">Delete</a></p>
        </li>
    <?php endforeach; ?>
</ul>

<a href="create_post.php">Create New Post</a>
<a href="admin_logout.php">Logout</a> -->
