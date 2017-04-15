<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$startNumber = $_POST['start_number'];
$dataCount = $_POST['data_count'];

$q = $_POST['sub_query'];

$tagNameSplit = split('[,]',$q);

$whereQuery = "TAG_NAME='$tagNameSplit[0]' ";

for($i=1; $i<sizeof($tagNameSplit); $i++) {
	$whereQuery = $whereQuery . "or TAG_NAME='$tagNameSplit[$i]' ";
}

$query = "select TAG_ID from TAG1100 where $whereQuery";

$result = mysqli_query($connect, $query);

$tagIDList = '';

while($row = mysqli_fetch_array($result)) {
	$tagIDList = $tagIDList . $row['TAG_ID'] . ',';
}

$tagIDSplit = split('[,]', $tagIDList);

$fromQuery = "(select sight_id from TAG1200 where tag_id=$tagIDSplit[0]) as " . chr(97);

$whereQuery = "a.sight_id";

for($i=1; $i<sizeof($tagIDSplit)-1; $i++) {
	$fromQuery = $fromQuery . ", (select sight_id from TAG1200 where tag_id=$tagIDSplit[$i]) as " . chr($i+97);
	$whereQuery = $whereQuery . "=" . chr($i+97) . ".sight_id and a.sight_id";	
}

$query = "select distinct a.SIGHT_Id as id from $fromQuery where $whereQuery";

$result = mysqli_query($connect, $query);

$sightIDList = '';

while($row = mysqli_fetch_array($result)) {
	$sightIDList = $sightIDList . $row['id'] . ',';
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

$category = $_POST['main_query'];

$categorySplit = split('[,]', $category);

if(!empty($category)) {
	$fromQuery = "(select * from SIGHT1000 where category='$categorySplit[0]'";
	
	for($i=1; $i<sizeof($categorySplit); $i++) {
		$fromQuery = $fromQuery . " or category='$categorySplit[$i]'";
	}
	
	$fromQuery = $fromQuery . ") as A";
} else {
	$fromQuery = 'SIGHT1000';
}

$query = "select * from $fromQuery $whereQuery limit $startNumber,$dataCount";

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
