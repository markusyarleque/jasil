<?php
include 'load.php';

$section = $_POST['section'];
$contents = find_content($section);
foreach ($contents as $content) :
    echo $content['content'];
endforeach;
