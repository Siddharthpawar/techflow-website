<?php
require_once 'auth.php';
require_admin();

$usersFile = 'secure_users.txt';
$users = [];
if (file_exists($usersFile)) {
    $contents = file_get_contents($usersFile);
    $lines = explode("\n", $contents);
    foreach ($lines as $line) {
        $n = trim($line);
        if ($n !== '') $users[] = $n;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure: Current Users</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f8f9fa; color:#333; }
        .container { max-width:900px; margin:3rem auto; background:white; padding:2rem; border-radius:8px; box-shadow:0 8px 30px rgba(0,0,0,0.06); }
        h1 { color:#2c3e50; }
        ul.users { list-style:none; padding-left:0; }
        ul.users li { background:#fff; border-radius:6px; padding:0.8rem 1rem; margin-bottom:0.6rem; border:1px solid #eef2f5; }
        .actions { margin-top:1rem; }
        .btn { background:#e74c3c; color:white; padding:0.6rem 1rem; border:none; border-radius:6px; text-decoration:none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Secure — Current Users</h1>
        <p>This page is accessible only to authenticated administrators.</p>
        <?php if (count($users) === 0): ?>
            <p><em>No users found.</em></p>
        <?php else: ?>
            <ul class="users">
                <?php foreach ($users as $u): ?>
                    <li><?php echo htmlspecialchars($u); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="actions">
            <a class="btn" href="logout.php">Log out</a>
            <a href="index.php" style="margin-left:1rem; color:#2c3e50;">Back to home</a>
        </div>
    </div>
</body>
</html>
