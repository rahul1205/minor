<html>
<body bgcolor="yellow">


<?php

header( 'Content-Type: text/html; charset=utf-8' );
include 'global.php';
include 'global2.php';
session_start();

$servername=$_SESSION['sname'];
$username=$_SESSION['uname'];
$password=$_SESSION['pass'];
$dbname=$_SESSION['dname'];
$tbname=$_SESSION['tname'];

try{
  $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }

  catch(PDOException $e){

    echo "Connection failed: " . $e->getMessage();

  }

$keyword=$_GET['keyword'];
$codeofkeyword=code($keyword);
echo '<br><br><br><pre><b><font face="arial" size=4>GENERATED CODE:    </font></b></pre>';
print_r($codeofkeyword);
echo '<br><br>';


$query=$dbh->prepare("SELECT * FROM $tbname");                                    //select all records from table
$query->execute();
$result = $query->fetchAll();
$count=$query->rowCount();

echo '<b><font face="arial" size=4>RESULT:    </font></b><br>';                                                      //loop to find the word
$flag=0;
for($i=0;$i<$count;$i++){
if($result[$i]['newcolumn']==$codeofkeyword){
print_r('<br>'.$result[$i]['id'].'&nbsp&nbsp&nbsp&nbsp&nbsp'.$result[$i]['words'].'<br>');
$flag++;
}
}

if($flag==0)
{echo 'no words found';}


 ?>
 </div>
 </body>
 </html>
