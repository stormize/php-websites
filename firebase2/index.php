<?php
include 'graph.php';
include 'firebase.php';
header('Content-type:application/json');
$getdata = new getdata();
$graph = $getdata->formGraph();

$searching = new searching($graph);

if(!empty($_GET['origin'])&&!empty($_GET['destination'])){


$mypath =$searching->breedthfirst($_GET['origin'],$_GET['destination']);

$mypath =json_encode($mypath,JSON_UNESCAPED_UNICODE);

echo $mypath;
}
else
die("wrong  format");




?>
