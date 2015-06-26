<?php
require('config/connect.php');

$getpeople = mysql_query('SELECT * FROM people');
if(!$getpeople) {
  die('Invalid query: ' . mysql_error());
}

require('inc/disconnect.php');
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Create People | E-Mail Template Generator</title>
  
  <?php include('inc/js.php'); ?>
  <?php include('inc/css.php'); ?>
</head>

<body class="<?php echo $currentfile; ?>">

  <div id="wrapper">  
    <nav>
      <?php include('inc/nav.php'); ?>
    </nav>
    
    <h1>E-Mail Template Generator</h1>
    
    <h2>Create</h2>
    
    <form method="post" action="send/createpeople.php">
      <label for="name">Name</label><input type="text" name="name" id="name">
      <label for="job">Job Title</label>
        <select id="job" name="job">
		  <option value="Accounts Assistant">Accounts Assistant</option>
		  <option value="Accounts Controller">Accounts Controller</option>
          <option value="Company Secretary">Company Secretary</option>
          <!--<option value="External Sales Executive">External Sales Executive</option>-->
          <option value="Graphic Designer">Graphic Designer</option>
          <option value="Managing Director">Managing Director</option>
          <option value="Operations Manager">Operations Manager</option>
          <option value="Sales Administration Manager">Sales Administration Manager</option>
          <option value="Sales Administrator">Sales Administrator</option>
          <option value="Sales Assistant to M.D.">Sales Assistant to M.D.</option>
          <option value="Sales Executive">Sales Executive</option>
          <option value="Sales Manager">Sales Manager</option>
          <option value="Sales Support Executive">Sales Support Executive</option>
          <option value="Senior Graphic Designer">Senior Graphic Designer</option>
          <option value="Senior Sales Support Executive">Senior Sales Support Executive</option>
          <option value="Warehouse Assistant">Warehouse Assistant</option>
          <option value="Warehouse Manager">Warehouse Manager</option>
          <option value="Web Designer">Web Designer</option>
        </select>
      <label for="tel">Telephone Number</label><input type="text" name="tel" id="tel">
      <label for="mob">Mobile Number</label><input type="text" name="mob" id="mob">
      <label for="email">E-Mail Address</label><input type="text" name="email" id="email">
      <input type="submit" value="Create">
    </form>
  
  </div>

</body>
</html>