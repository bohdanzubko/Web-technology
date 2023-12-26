<?php
function getParams($name, $def = "")
{
	$val = $def;
	if (isset($_POST[$name])) {
		// Getting $_POST parameters
		$val = $_POST[$name];
	}
	else if (isset($_GET[$name])) {
		// Getting $_GET parameters
		$val = $_GET[$name];
	}
	return $val;
}

// Formatting the file size
function formatSize($size)
{
	$units = array('B', 'KB', 'MB', 'GB');
	$i = 0;

	while ($size >= 1024 && $i < count($units) - 1) {
		$size /= 1024;
		$i++;
	}

	return round($size, 2) . ' ' . $units[$i];
}

// Creating the file relative path
function createRelativePath($fullFilePath)
{
	$rootDir = __DIR__;
    $relativePath = substr($fullFilePath, strlen($rootDir));
    $relativePath = ltrim($relativePath, '/');

    return $relativePath;
}

// Checking if directory is empty
function isDirectoryEmpty($dir) {
    $items = scandir($dir);
    $itemCount = count($items) - 2;
    return $itemCount === 0;
}

// Getting the directory content and crating files array
function getDirCont($dir)
{
	$res = array();

	if (is_dir($dir)) {
		$files = scandir($dir);

		if ($dir !== __DIR__ && $dir !== __DIR__ . '/') {
			$info = array(
				'name' => '<a href="?dir='. createRelativePath(dirname($dir)) .'"><button id="file-btn">..</button></a>',
				'type' => 'DIR',
				'size' => '',
				'created' => '',
				'remove' => ''
			);
			$res[] = $info;
		}

		foreach ($files as $file) {
			// Exclude current and parent directories
			if ($file != "." && $file != "..") {
				$filePath = realpath($dir . '/' . $file);
				// Check for dangerous characters in the path
				if (strpos($file, '..') === false) {
					$info = array(
						'name' => $file,
						'path' => $filePath,
						'relativePath' => createRelativePath($filePath),
						'type' => is_dir($filePath) ? 'DIR' : 'file',
						'size' => formatSize(filesize($filePath)),
						'created' => date("Y-m-d H:i:s", filectime($filePath)),
						'remove' => 'file_manager.php?dir=' . createRelativePath(dirname($filePath)) . '&removeDir=' . createRelativePath($filePath)
					);
					$res[] = $info;
				}
			}
		}

		usort($res, function ($a, $b) {
			return $a['type'] == 'DIR' ? -1 : 1;
		});
	}

	return $res;
}

$currentDir = __DIR__; // The root directory
$errorMsg = ''; // Error massage

// Request for creating the new directory
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create-dir-btn"])) {
	$newDirName = getParams('create-dir');
	if (isset($_GET['dir'])){
		$requestedDir = getParams('dir');
		$newDirPath = $currentDir . '/' . $requestedDir;
	}

	if (!empty($newDirName)) {
		$newDirPath .= '/' . $newDirName;
		
		if (!file_exists($newDirPath)) {
			mkdir($newDirPath);
		} else {
			$errorMsg = 'Directory already exists';
		}
	} else {
		$errorMsg = 'Please enter a directory name';
	}
}

// Request for removing directory
if (isset($_GET['removeDir'])) {
	$dirToRemove = getParams('removeDir');

	if (!empty($dirToRemove)) {
		$dirToRemovePath = $currentDir . '/' . $dirToRemove;

		if (is_dir($dirToRemovePath)) {
			if (isDirectoryEmpty($dirToRemovePath)) {
				rmdir($dirToRemovePath);
			} else {
				$errorMsg = 'Directory is not empty.';
			}
		} else {
			$errorMsg = 'Directory does not exist.';
		}
	} else {
		$errorMsg = 'Invalid directory name.';
	}
}

// Changing viewed directory if $_GET['dir'] is set
if (isset($_GET['dir'])) {
	$requestedDir = getParams('dir');
	$currentDir .= '/' . $requestedDir;
	// Protection against possible attacks like "../../../../"
	if (strpos($currentDir, '..') === false) {
		$dirCont = getDirCont($currentDir);
	} else {
		$errorMsg = 'The forbidden path!';
		exit;
	}
}
else{
	// Root directory view
	$dirCont = getDirCont($currentDir);
}

$CSS_DOP = Array("css/additional_styles.css");

include('php/header.php');
?>

<section class="main-content">
	<div class="main-top"><b>FILE MANAGER</b></div>
	<div class="main-center">
		<div class="main-cnt-text"><b>Navigation through the server file system within a directory.</b></div>
		<div class="main-cnt-text">
		<form method="POST" action="">
			<input type="hidden" name="action" value="procrm">
			<input type="text" id="create-dir" name="create-dir" placeholder="Type directory name">
			<input type="submit" id="create-dir-btn" name="create-dir-btn" value="Create directory">
			<div id="error-msg" style="margin: 10px 45px;"><?=$errorMsg?></div>
		</form id="fm-form">
		<table id="fm-table">
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Size</th>
				<th>Date</th>
				<th></th>
			</tr>
			<?php foreach ($dirCont as $item): ?>
				<tr>
					<td><?php echo is_dir($item['path']) ? '<a href="?dir=' . $item['relativePath'] . '"><button id="file-btn">' . $item['name'] . '</button></a>' : $item['name']; ?></td>
					<td><?php echo $item['type']; ?></td>
					<td><?php echo $item['size']; ?></td>
					<td><?php echo $item['created']; ?></td>
					<td><?php echo is_dir($item['path']) ? '<a href="'. $item['remove'] .'"><button id="remove-dir-btn">X</button></a>' : ''; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		</div>
	</div>
</section>

<?php
include('php/footer.php');
?>