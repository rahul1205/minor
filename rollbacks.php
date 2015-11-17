<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hindidictionary";


    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $sth = $dbh->prepare("SELECT * FROM report");
    $sth->execute();


$result = $sth->fetchAll(PDO::FETCH_ASSOC);
/*foreach($result as $row) {
   echo $row['words'];
   echo "&nbsp&nbsp";
   echo $row['codes'];
   echo "<br>";

}*/
$count=$sth->rowCount();
print_r($count);




  $sth1 = $dbh->prepare("ALTER TABLE report DROP COLUMN newcolumn");
  $sth1->execute();

  //$sth2 = $dbh->prepare("ALTER TABLE report DROP COLUMN codes");
  //$sth2->execute();

  /*$new=array('a','b','c','d','e','f','g');
for($i=0;$i<=6;$i++){
  $sth2 = $dbh->prepare("UPDATE report SET newcolumn = '$new[$i]' WHERE id=($i+1)");
  $sth2->execute();
}*/



?>
