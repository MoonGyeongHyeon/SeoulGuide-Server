<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$startNumber = $_GET['start_number'];
$dataCount = $_GET['data_count'];

$tagIds = $_POST['tag_ids'];

$tagIdSplit = split('[,]',$tagIds);

$whereQuery = "TAG_ID='$tagIdsSplit[0]' ";

for($i=1; $i<sizeof($tagIdSplit); $i++) {
	$whereQuery = $whereQuery . "or TAG_ID='$tagIdSplit[$i]' ";
}

$query = "select SIGHT_ID from TAG1200 where $whereQuery";

$result = mysqli_query($connect, $query);

$sightIDList = '';

while($row = mysqli_fetch_array($result)) {
	$sightIDList = $sightIDList . $row['SIGHT_ID'] . ',';
}

$sightIDSplit = NULL;

if(!empty($sightIDList)) {
	$sightIDSplit = split('[,]', $sightIDList);
}

$whereQuery = '';

if(!empty($sightIDSplit)) {
	$whereQuery = "where sight_id=$sightIDSplit[0]";
	
	for($i=1; $i<sizeof($sightIDSplit)-1; $i++) {
		$whereQuery = $whereQuery . " or sight_id=$sightIDSplit[$i]";
	}
} else if(!empty($q)) {
	exit(0);
}

$query = "select * from SIGHT1000 $whereQuery limit $startNumber,$dataCount";

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
