<?php
require_once 'auth.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = isset($_POST['userid']) ? trim($_POST['userid']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (check_credentials($userid, $password)) {
        // mark session and redirect
        $_SESSION['is_admin'] = true;
        header('Location: secure.php');
        exit;
    } else {
        $error = 'Invalid userid or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TechFlow</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f6f8; }
        .login-box { max-width: 420px; margin: 6rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); }
        label { display:block; margin-bottom:0.5rem; color:#2c3e50; font-weight:600; }
        input { width:100%; padding:0.8rem; margin-bottom:1rem; border:1px solid #e9ecef; border-radius:6px; }
        .btn { background:#e74c3c; color:white; padding:0.8rem 1.2rem; border:none; border-radius:6px; cursor:pointer; }
        .error { background:#f8d7da; color:#721c24; padding:0.6rem; border-radius:6px; margin-bottom:1rem; }
        .nav { text-align:center; margin-bottom:1rem; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="nav">
            <a href="index.php">← Back to Home</a>
        </div>
        <h2>Administrator Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="userid">User ID</label>
            <input id="userid" name="userid" required autofocus>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <button class="btn" type="submit">Log in</button>
        </form>
        <p style="margin-top:1rem; color:#555; font-size:0.9rem;">Default admin: <strong>admin</strong> / <strong>adminpass</strong>. Change immediately in <code>auth.php</code>.</p>
    </div>
</body>
</html>
