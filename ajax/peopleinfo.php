<?php

require('../config/connect.php');
if(!$link) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('templates',$link);

$selected = $_GET['name']; 
$getpeople = mysql_query('SELECT * FROM people WHERE idpeople = ' . $selected);
$person = mysql_fetch_array($getpeople);
if(!$getpeople) {
  die('Invalid query: ' . mysql_error());
}

mysql_close($link);

?>

<p>
  <?php if($selected === '0') { echo '<p>Come on now, don\'t deselect people. What\'s the point in that?!</p>'; } else { ?>
    <?php if(!empty($person['name'])) { echo $person['name'] . '<br />'; } ?>
    <?php if(!empty($person['job'])) { echo $person['job'] . '<br />'; } ?>
    <?php if(!empty($person['tel'])) { echo 'DDi: ' . $person['tel'] . '<br />'; } ?>
    <?php
		if($person['job'] === "Sales Executive" || $person['job'] === "Sales Support Executive" || $person['job'] === "Sales Manager" || $person['job'] === "Sales Support Manager") { echo 'Main: 01274 854996<br />'; }
		else { echo 'Main: 01274 852598<br />'; }
    ?>
    <?php if(!empty($person['mob'])) { echo 'Mobile: ' . $person['mob'] . '<br />'; } ?>  
    <?php if(!empty($person['email'])) { echo 'E-Mail: <a href="mailto:' . $person['email'] . '">' . ucfirst(str_replace('lsi-gifts','LSi-Gifts',$person['email'])) . '</a>'; } ?>  
  <?php } ?>
</p>