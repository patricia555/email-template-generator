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
  <title>People List | E-Mail Template Generator</title>
  
  <?php include('inc/js.php'); ?>
  <?php include('inc/css.php'); ?>
</head>

<body class="<?php echo $currentfile; ?>">
  
  <div id="wrapper">
    <nav>
      <?php include('inc/nav.php'); ?>
    </nav>
    
    <h1>E-Mail Template Generator</h1>
    
    <h2>People List</h2>
    
    <nav>
      <a href="createpeople.php">Create People</a>
    </nav>
    
    <form id="peopleupdate" method="post" action="send/peopleupdate.php">
      <table>
        <thead>
          <tr>
            <th class="hide">id</th>
            <th>Name</th>
            <th>Job Title</th>
            <th>Phone Number</th>
            <th>Mobile Number</th>
            <th>E-Mail Address</th>
            <!--<th>Edit</th> THIS FUNCTIONALITY IS TO COME...
            <th>Remove</th>-->
          </tr>
        </thead>
        <tbody>
          <?php while($person = mysql_fetch_array($getpeople)) { ?>
            <tr>
              <td class="hide"><?php echo $person['idpeople']; ?></td>
              <td><?php echo $person['name']; ?></td>
              <td><?php echo $person['job']; ?></td>
              <td><?php echo $person['tel']; ?></td>
              <td><?php echo $person['mob']; ?></td>
              <td><?php echo $person['email']; ?></td>
              <!--<td class="edit"><a href="javascript:;">Edit</a></td>
              <td class="remove"><a href="javascript:;">Remove</a></td>-->
            </tr>      
          <?php } ?>
        </tbody>
      </table>
    </form>
  </div>

</body>
</html>