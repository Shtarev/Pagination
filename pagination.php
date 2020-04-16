<?php
/*Paginations Cage*//*Andrey Shtarev*//*23.07.2017*/
/**************************************************/ 

$vsego = 6; // NITIALISATION - quantity of paginate output 
$mysqli = mysqli_connect ("localhost","root","","table"); 
$result = $mysqli->query ("SELECT id, title FROM wares ORDER BY id DESC");

$row = mysqli_num_rows($result);
$i = 0;
$key1 = 1;
$key2 = 0;

$myrow = $result->fetch_array();

while ($myrow == true){
	if($vsego == $i){
	$i = 1;
	$key1++;
	$key2 = 1;
	}
	else{
		$i++;
		$key2++;
	}
	$id = $myrow['id'];
	$idArray[$key1][$key2] = array('id'=>$myrow['id'], 'title'=>$myrow['title']);
	$myrow = $result->fetch_array();
}

if (isset($_GET["vivod"])) {$vivod = $_GET["vivod"];}
else {$vivod = 1;}

$key1 = $vivod;
$key2 = 1;
while ($key2 <= $vsego){
	if ($idArray[$key1][$key2] != ""){
		echo "HERE id: ".$idArray[$key1][$key2]['id']."<br>HERE title: ".$idArray[$key1][$key2]['title']."<br>________<br><br>";
		$key2++;
	}
	else {$key2 = $vsego + 1;}
}

if ($vivod == 1 && $row <= $vsego){
	$weiter = "";
	$zuruck = "";
	echo $zuruck." ".$weiter;
    }

elseif ($vivod == 1 && $row > $vsego){
	$weiter = "<input value=\"weiter\" type=\"button\" onclick=\"location.href='".$_SERVER['PHP_SELF']."?vivod=".++$vivod."'\" />";
	$zuruck = "";
	echo $zuruck." ".$weiter;
    }

elseif ($vivod > 1 && $row > $vsego * $vivod){
	$weiter = $vivod + 1;
	$zuruck = $vivod - 1;
	$weiter = "<input value=\"weiter\" type=\"button\" onclick=\"location.href='".$_SERVER['PHP_SELF']."?vivod=".$weiter."'\" />";
	$zuruck = "<input value=\"zuruck\" type=\"button\" onclick=\"location.href='".$_SERVER['PHP_SELF']."?vivod=".$zuruck."'\" />";
	echo $zuruck." ".$weiter;
	}

elseif ($vivod > 1 && $row <=  $vsego * $vivod){
	$weiter = "";
	$zuruck = "<input value=\"zuruck\" type=\"button\" onclick=\"location.href='".$_SERVER['PHP_SELF']."?vivod=".--$vivod."'\" />";
	echo $zuruck." ".$weiter;
}