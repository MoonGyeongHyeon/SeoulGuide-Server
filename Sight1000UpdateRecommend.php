<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$sight_id = $_POST['SIGHT_ID'];

$query = "update SIGHT1000 set SIGHT_RECOMMEND_COUNT=SIGHT_RECOMMEND_COUNT+1 where SIGHT_ID='$sight_id'";

$result = mysqli_query($connect, $query);

$query2 = "select SIGHT_RECOMMEND_COUNT from SIGHT1000 where SIGHT_ID='$sight_id'";

$result2 = mysqli_query($connect, $query2);

$row = mysqli_fetch_array($result2);

echo json_encode($row);

mysqli_close($connect);

?>
