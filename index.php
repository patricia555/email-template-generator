<?php
require('config/connect.php');

$getpeople = mysql_query('SELECT * FROM people ORDER BY name');
if(!$getpeople) {
  die('Invalid query: ' . mysql_error());
}

require('inc/disconnect.php');
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Generator | E-Mail Template Generator</title>
  
  <?php include('inc/js.php'); ?>
  <?php include('inc/css.php'); ?>
</head>

<body class="<?php echo $currentfile; ?>">
  
  <div id="wrapper">
  
    <nav>
      <?php include('inc/nav.php'); ?>
    </nav>
    
    <h1>E-Mail Template Generator</h1>
    
    <h2>Generator</h2>
    
    <form action="generate.php" method="post">
      <fieldset id="gen-details">
        <legend>Details</legend>
        <label for="name">Name</label>
        <select name="name" id="name">
          <option value="0">[Select A Person]</option>
          <?php while($person = mysql_fetch_array($getpeople)) { ?>
            <option value="<?php echo $person['idpeople']; ?>"><?php echo $person['name']; ?></option>
          <?php } ?>
        </select>
        <div id="personinfo"></div>
      </fieldset>
      <fieldset id="packselect">
        <legend>Packs</legend>
        <input type="radio" name="pack" id="pack-standard"><label for="pack-standard">Standard</label>
        <input type="radio" name="pack" id="pack-salesexec"><label for="pack-salesexec">Sales Executive</label>
        <input type="radio" name="pack" id="pack-salessupp"><label for="pack-salessupp">Sales Support</label>
        <input type="radio" name="pack" id="pack-salesasst"><label for="pack-salesasst">Sales Assistant to M.D.</label>
        <input type="radio" name="pack" id="pack-adminmgr"><label for="pack-adminmgr">Admin Manager</label>
        <input type="radio" name="pack" id="pack-admin"><label for="pack-admin">Admin</label>        
		<input type="radio" name="pack" id="pack-artwork"><label for="pack-artwork">Artwork</label>        
      </fieldset>
      
      <fieldset id="templateselect">
        <legend>Templates</legend>
        <input type="checkbox" id="tmp-standard" name="tmp-standard" checked="checked" value="yes"><label for="tmp-standard">Standard</label>
        <input type="checkbox" id="tmp-artworkapproval" name="tmp-artworkapproval" value="yes"><label for="tmp-artworkapproval">Artwork Approval</label>
		<input type="checkbox" id="tmp-artworkrequest" name="tmp-artworkrequest" value="yes"><label for="tmp-artworkrequest">Artwork Request</label>
        <input type="checkbox" id="tmp-buyyorkshire" name="tmp-buyyorkshire" value="yes"><label for="tmp-buyyorkshire">Buy Yorkshire</label>
		<input type="checkbox" id="tmp-customerinv" name="tmp-customerinv" value="yes"><label for="tmp-customerinv">Customer Invoice</label>
        <input type="checkbox" id="tmp-newacct" name="tmp-newacct" value="yes"><label for="tmp-newacct">New Account</label>
        <input type="checkbox" id="tmp-orderack" name="tmp-orderack" value="yes"><label for="tmp-orderack">Order Ack.</label>
        <input type="checkbox" id="tmp-payment" name="tmp-payment" value="yes"><label for="tmp-payment">Payment</label>        
        <input type="checkbox" id="tmp-proforma" name="tmp-proforma" value="yes"><label for="tmp-proforma">Proforma Invoice</label>  
        <!--<input type="checkbox" id="tmp-po" name="tmp-po" value="yes"><label for="tmp-po">Purchase Order</label> - remmed at BH's request, 26/06/2015 -->
        <input type="checkbox" id="tmp-quote" name="tmp-quote" value="yes"><label for="tmp-quote">Quotation</label>
        <input type="checkbox" id="tmp-samplecust" name="tmp-samplecust" value="yes"><label for="tmp-samplecust">Sample (Customer)</label>
        <input type="checkbox" id="tmp-samplesupp" name="tmp-samplesupp" value="yes"><label for="tmp-samplesupp">Sample (Supplier)</label>  
        <!--<input type="checkbox" id="tmp-supplierawk" name="tmp-supplierawk" value="yes"><label for="tmp-supplierawk">Supplier Artwork</label> -->
        <input type="checkbox" id="tmp-usb" name="tmp-usb" value="yes"><label for="tmp-usb">USB</label>
        <input type="checkbox" id="tmp-voucher" name="tmp-voucher" value="yes"><label for="tmp-voucher">Voucher</label>
      </fieldset>
      <!-- For Christmas versions, etc, in the future
      <fieldset id="gen-versions">
        <legend>Versions</legend>
      </fieldset>
      -->
      <fieldset id="gen-submit">
        <legend>All done?</legend>
        <input type="submit" value="Generate Templates">
      </fieldset>
    </form>
  
  </div>

</body>
</html>