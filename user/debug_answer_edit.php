<?php
echo "Testing answer_edit page access...<br>";
echo "Current URL: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";

if (isset($_GET['id'])) {
    echo "Answer ID received: " . $_GET['id'] . "<br>";
} else {
    echo "No answer ID received<br>";
}

echo "<br>Files in user directory:<br>";
$files = scandir(__DIR__);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo $file . "<br>";
    }
}
?>
