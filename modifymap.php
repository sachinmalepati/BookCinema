<?php
session_start();
$movieid=$_POST['movieid'];
$smap=$_POST['str'];
$seatnum = $_POST['seatnumber'];
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("BookMovie", $connection); 
$result = mysql_query("START TRANSACTION;
	SELECT * from seatmap where MovieId=$movieid for UPDATE;
	UPDATE seatmap SET Map='$smap' where MovieId=$movieid; 
	COMMIT TRANSACTION;" ) ;
//$mp=mysql_fetch_array($result);
$abc=$_SESSION['id'];
mysql_query("INSERT INTO tickets(UserId,MovieId,Seat) VALUES ($abc , $movieid , '$seatnum' )");
$result = mysql_query("SELECT * FROM movieinfo where MovieId=$movieid") ;
        $row = mysql_fetch_assoc($result);
        $act = $row['M_Action'] ;
        $com = $row['M_Comedy'];
        $hor = $row['M_Horror'];
        $sci = $row['M_SciFi'];
        $rom = $row['M_Romance'];
 mysql_query("INSERT INTO userinterest(UserId,Action,Comedy,Romance,Horror,SciFi) VALUES($abc ,$act,$com,$rom,$hor,$sci) ")or die('Unable to run query:');
 
echo mysql_error();
//echo json_encode($emparr);
?>