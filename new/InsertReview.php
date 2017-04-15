<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$id = $_POST['SIGHT_ID'];
$writer = $_POST['WRITER'];
$info = $_POST['INFO'];
$point = $_POST['POINT'];

$query = "insert into REVIEW1000(REVIEW_WRITER, REVIEW_INFO, REVIEW_POINT, SIGHT_ID) values('$writer', '$info', '$point', '$id')";

$result = mysqli_query($connect, $query);

$query = "update SIGHT1000 set SUM_POINT=SUM_POINT+$point, P_COUNT=P_COUNT+1 where SIGHT_ID='$id'";

$result = mysqli_query($connect, $query);

mysqli_close($connect);

?>
