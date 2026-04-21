<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Page Not Found</title>
</head>
<body>
    <div style="padding: 20px; text-align: center;">
        <h1>404 Page Not Found</h1>
        <p><?= ($message ?? "The page you requested was not found.") ?></p>
        <a href="<?= base_url() ?>">Back to Home</a>
    </div>
</body>
</html>
