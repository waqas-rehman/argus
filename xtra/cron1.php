<?php
$con = mysql_connect("localhost","waqastec_proohio","pro@12345") ;
if(!$con) die('Could not connect: ' . mysql_error()) ;

mysql_select_db("waqastec_proohio", $con) ;

//echo $_SERVER['DOCUMENT_ROOT']."<br />".$_SERVER['HTTP_HOST']."<br />" ; exit ;


$sql = "INSERT INTO states(`state_name`,`state_code`,`state_status`) VALUES ('waqas','wa','Active')" ;

mysql_query($sql,$con) ;

/*
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";
/**/
mysql_close($con);
?> 