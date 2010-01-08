<?php

echo $_SERVER['PHP_SELF'].'<br>';
echo $_SERVER['DOCUMENT_ROOT'].'<br>';

$path = $_SERVER['PHP_SELF'];
$position = strpos($path, 'lib/tinymce');
$folder = substr($path, 0, $position);

echo $_SERVER['DOCUMENT_ROOT'].$folder;
?>