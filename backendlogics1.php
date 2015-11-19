<html>
<head>
  <link rel="stylesheet" href="new.css" type="text/css">
      </head>
<body bgcolor="yellow">

  <?php

  header( 'Content-Type: text/html; charset=utf-8' );
  include 'global.php';
  include 'global2.php';
  #include 'hindi.php';
  /*$hindi='नुपूर';
  print_r(mb_strlen($hindi,'UTF-8'));
  print_r(str_split_unicode($hindi,1));*/
  session_start();
  //open db connection

  $servername=$_SESSION['sname']=$_POST['sname'];
  $username=$_SESSION['uname']=$_POST['uname'];
  $password=$_SESSION['pass']=$_POST['pass'];
  $dbname=$_SESSION['dname']=$_POST['dname'];
  $tbname=$_SESSION['tname']=$_POST['tname'];




  try{
      $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo '<font face="Times New Roman" size=5 color="red">connection established</font>';
    }

    catch(PDOException $e){

      echo "Connection failed: " . $e->getMessage();
    }








  /*$str1='नुपुर';                                                                      //change string here
  $str1array=str_split_unicode($str1,1);
  $str2='नुपूर';                                                                        //change string here
  $str2array=str_split_unicode($str2,1);


  $result1=code($str1);
  $result2=code($str2);

  print_r('<br>'.$result1);
  print_r('<br>'.$result2);


  $stringmatch=similar_text($str1,$str2,$percent1);                                 //generates number of equal bits in string
  $codematch=similar_text($result1,$result2,$percent2);                             //generates number of equal bits in code
  */


  $q = $dbh->prepare("DESCRIBE $tbname");                                            //query checking whether or not a column exists
  $q->execute();
  $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
  $check=in_array("newcolumn",$table_fields);

  if($check==FALSE){
  $sth1 = $dbh->prepare("ALTER TABLE $tbname ADD newcolumn VARCHAR( 255 ) after words");     //query adding a new column
  $sth1->execute();
  }

  $sth = $dbh->prepare("SELECT words FROM $tbname");                                 //query selecting names from array
  $sth->execute();
  $result = $sth->fetchAll(PDO::FETCH_ASSOC);
  $count=$sth->rowCount();


  $newarray=array();
  for($i=0;$i<$count;$i++){                                                         //recursively calling function and storing
  $cgen=code($result[$i]['words']);                                                 //generated codes
  $newarray[]=$cgen;
  }


  for($i=0;$i<$count;$i++){
    $sth2 = $dbh->prepare("UPDATE $tbname SET newcolumn = '$newarray[$i]' WHERE id=($i+1)");
    $sth2->execute();
  }

  ?>

  <form action="result.php" method="get">
<div id="first">
<img id="logo" src="logo.png"><br><br>
<label>Enter word</label>
<input id="sname" name="keyword" placeholder="" type="text"><br><br>
<input id="submit" type="submit" value="Submit">

</form>
</body>

</html>
