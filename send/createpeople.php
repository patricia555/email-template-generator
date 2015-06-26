<?php

  require('../config/connect.php');
  if (!$link)
    {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("templates") or die(mysql_error());
  
  $name = $_POST['name'];
  $job = $_POST['job'];
  $tel = $_POST['tel'];
  $mob = $_POST['mob'];
  $email = $_POST['email'];
  
  $createpersonquery = "INSERT INTO people (name,job,tel,mob,email) VALUES ('$name','$job','$tel','$mob','$email')";
  
  $createperson = mysql_query($createpersonquery);
  
  if(!$createperson) {
    echo 'Eek... something\'s wrong: ' . mysql_error();
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?created=yes');
  }

?>