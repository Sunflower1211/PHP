

<!DOCTYPE html>
<html>
<head>
    <title>Article List</title>
</head>
<body>
    <h1>Article List</h1>

    <a href="index.php?controller=article&action=create">Create Article</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['password']; ?></td>
                    <td>
                        <a href="index.php?controller=article&action=edit&id=<?php echo $article['id']; ?>">Edit</a>
                        <a href="index.php?controller=article&action=delete&id=<?php echo $article['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
