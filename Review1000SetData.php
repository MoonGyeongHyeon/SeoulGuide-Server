<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$review_writer = $_POST['REVIEW_WRITER'];
$review_info = $_POST['REVIEW_INFO'];
$review_point = $_POST['REVIEW_POINT'];
$sight_id = $_POST['SIGHT_ID'];

$query = "insert into REVIEW1000 (REVIEW_ID, REVIEW_WRITER, REVIEW_INFO, REVIEW_DATE, REVIEW_POINT, SIGHT_ID) values (NULL, '$review_writer', '$review_info', CURRENT_TIMESTAMP, '$review_point', '$sight_id')";
$result = mysqli_query($connect, $query);

if($result){
echo 'success';
}
else{
echo 'failure';
}

mysqli_close($connect);

?>