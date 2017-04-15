<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$id = $_POST['SIGHT_ID'];

$totalArray = array();

$query = "select * from SIGHT1000 where SIGHT_ID='$id'";

$result = mysqli_query($connect, $query);

$row = mysqli_fetch_array($result);

array_push($totalArray, array(
'sight_name'=>$row[SIGHT_NAME],
'sight_info'=>$row[SIGHT_INFO],
'sight_recommend_count'=>$row[SIGHT_RECOMMEND_COUNT],
'sight_location_x'=>$row[SIGHT_LOCATION_X],
'sight_location_y'=>$row[SIGHT_LOCATION_Y],
'sum_point'=>$row[SUM_POINT],
'p_count'=>$row[P_COUNT]
));

$query = "select * from TAG1200 join TAG1100 on TAG1200.TAG_ID=TAG1100.TAG_ID where TAG1200.SIGHT_ID='$id'";

$result = mysqli_query($connect, $query);

$tagArray = array();

while($row = mysqli_fetch_array($result)) {
array_push($tagArray, array(
'tag_name'=>$row[TAG_NAME]
));
}

array_push($totalArray, $tagArray);

$query = "select * from SIGHT1100 where SIGHT_ID='$id'";

$result = mysqli_query($connect, $query);

$pathArray = array();

while($row = mysqli_fetch_array($result)) {
array_push($pathArray, array(
'sight_image_filepath'=>$row[SIGHT_IMAGE_FILEPATH],
'sight_image_filename'=>$row[SIGHT_IMAGE_FILENAME]
));
}

array_push($totalArray, $pathArray);

$query = "select * from REVIEW1000 where SIGHT_ID='$id' order by REVIEW_DATE desc";

$result = mysqli_query($connect, $query);

$reviewArray = array();

while($row = mysqli_fetch_array($result)) {
array_push($reviewArray, array(
'review_writer'=>$row[REVIEW_WRITER],
'review_info'=>$row[REVIEW_INFO],
'review_date'=>$row[REVIEW_DATE],
'review_point'=>$row[REVIEW_POINT],
));
}

array_push($totalArray, $reviewArray);

echo json_encode(array("result"=>$totalArray));

mysqli_close($connect);

?>
