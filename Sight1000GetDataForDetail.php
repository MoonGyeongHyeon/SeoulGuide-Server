<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$sight_id = $_POST['SIGHT_ID'];

$query = "select * from SIGHT1000 where SIGHT_ID='$sight_id'";

$result = mysqli_query($connect, $query);

$row = mysqli_fetch_array($result);

echo json_encode($row);

mysqli_close($connect);

?>
