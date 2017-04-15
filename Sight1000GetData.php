<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$query = "select * from SIGHT1000 order by sight_id asc";
$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'sight_id'=>$row[SIGHT_ID], 
'sight_name'=>$row[SIGHT_NAME], 
'sight_info'=>$row[SIGHT_INFO], 
'sight_recommend_count'=>$row[SIGHT_RECOMMEND_COUNT], 
'sight_location_x'=>$row[SIGHT_LOCATION_X], 
'sight_location_y'=>$row[SIGHT_LOCATION_Y], 
'sight_weekrecommend'=>$row[SIGHT_WEEKRECOMMEND], 
'sight_monthrecommend'=>$row[SIGHT_MONTHRECOMMEND],
'sight_thumbnail'=>$row[THUMBNAIL],
'sum_point'=>$row[SUM_POINT],
'p_count'=>$row[P_COUNT],
'category'=>$row[CATEGORY]
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>
