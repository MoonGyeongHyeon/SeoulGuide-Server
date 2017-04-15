<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$startNumber = $_POST['start_number'];
$dataCount = $_POST['data_count'];

$query = "select * from SIGHT1000 order by sight_id asc limit $startNumber,$dataCount";
$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'sight_id'=>$row[SIGHT_ID], 
'sight_name'=>$row[SIGHT_NAME], 
'sight_recommend_count'=>$row[SIGHT_RECOMMEND_COUNT], 
'sight_thumbnail'=>$row[THUMBNAIL],
'sum_point'=>$row[SUM_POINT],
'p_count'=>$row[P_COUNT],
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>
