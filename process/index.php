<?php
include_once '../utils/index.php';

set_time_limit(1440);

$source_path = "../audio-files";
$processed_path = "../audio-files-processed";

ob_start();
@mkdir($processed_path, 777);

$directory = new \RecursiveDirectoryIterator($source_path);
$iterator = new \RecursiveIteratorIterator($directory);
$files = array();
$i = 0;

foreach ($iterator as $info) {
    $file = $info->getFileName();
    $path = $info->getPathName();

    if (isset($isAudioFile) && !$isAudioFile($file)) {
        continue;
    } else {
        if (is_dir("$processed_path/" . substr($file, 0, (strrpos($file, "."))))) continue;
        $files[] = "'$path'";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spleeter PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .highlight {
            color: green;
            background-color: white;
        }

        .success {
            color: white;
            padding: 2px 5px;
            background-color: green;
        }

        .error {
            color: white;
            padding: 2px 5px;
            background-color: red;
        }
    </style>
</head>
<body class="bg-secondary text-white mt-3">
<div class="d-flex justify-content-between align-items-center">
    <h1><?= sizeof($files) ?> files found</h1>
    <div id="loading"></div>
</div>
<hr/>

<?php
echo str_repeat(' ', 1024 * 64);
echo "<script>document.getElementById('loading').innerHTML = '<div class=\"spinner-border\" role=\"status\"></div>';</script>";
ob_flush();
flush();

if ($_GET['stems'] ?? false) {
    $stems = "{$_GET['stems']}stems" . (isset($_GET['high-khz']) ? '-16kHz' : '');
    $command = "spleeter separate -b {$_GET['quality']}k -c {$_GET['codec']} -p spleeter:$stems -o $processed_path";
    foreach ($files as $key => $file) {
        $command = "$command $file";
        $result = exec($command, $output, $resultCode);
        if ($resultCode === 0) {
            echo ($key + 1) . ". $file";
            if ((strpos(implode(" ", $output), "succesfully")) >= 0)
                echo " <span class='success'>success</span>";
            else
                echo " <span class='error'>error</span><span class='text-white-50 small'>" . implode("<br />", $output) . "</span>";
        }

        echo "<hr />";
        echo str_repeat(' ', 1024 * 64);

        sleep(2);
        ob_flush();
        flush();
    }

    $done = true;
} else {
    echo "<h5>Press 'process' button to start</h5>";
}
?>

<?php if ($done ?? false): ?>
    <div class="py-1 bg-white text-success text-center text-uppercase font-weight-bolder">
        <h3 class="m-0">All done, <span class="bg-success text-white px-2"><?= sizeof($files) ?></span> files processed
    </div>
<?php endif; ?>

<script>
    document.getElementById('loading').innerHTML = '';
</script>

</body>
</html>
