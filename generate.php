<?php

// Hello there. This is the generator.
// Written and coded by Scott Brown (twitter: @thewebdes) on 16/07/2012.
// It gets data from the submitted form, queries the database to get that person's info and creates and saves .html files based upon submitted preferences.

// -----------------------------------------------------------------------------
// Connect to db to get everything we need
// -----------------------------------------------------------------------------

  require('config/connect.php');
  
  // Get people data based on id submitted by generator
    $personid = $_POST['name'];
    $getperson = mysql_query('SELECT * FROM people WHERE idpeople = "' . $personid . '"');
    $person = mysql_fetch_assoc($getperson);
  
  // Create variables to populate templates
  // Simple bits
    $name = $person['name'];
    $job = $person['job'];
    $tel = $person['tel'];
    $mob = $person['mob'];
    $emaillink = $person['email'];
  // fiddling about
  // get sbrown from Scott Brown, for example...
    $shortname = str_replace(' ','',strtolower(substr($person['name'],0,1)) . strtolower(substr($person['name'],strrpos($person['name'], ' '))));
  // ...unless accounts@lsi.co.uk is your e-mail address
    if($emaillink === "accounts@lsi.co.uk") { $shortname = 'accounts'; }
  // Put caps in where the boss asks
    $email = ucfirst(str_replace('lsi.co.uk','LSi.co.uk',$person['email']));
  // Get lower case first name for artwork approval
    $firstnameprep = explode(' ',$person['name']);
    $firstname = strtolower($firstnameprep[0]); 
  
  require('inc/disconnect.php');


// -----------------------------------------------------------------------------
// get posted data and create a nice variable for it (as long the option was ticked)
// -----------------------------------------------------------------------------
  if(isset($_POST['tmp-standard'])) { $tmp_standard = $_POST['tmp-standard']; }
  if(isset($_POST['tmp-artworkapproval'])) { $tmp_artworkapproval = $_POST['tmp-artworkapproval']; }
  if(isset($_POST['tmp-artworkrequest'])) { $tmp_artworkrequest = $_POST['tmp-artworkrequest']; }
  if(isset($_POST['tmp-buyyorkshire'])) { $tmp_buyyorkshire = $_POST['tmp-buyyorkshire']; }
  if(isset($_POST['tmp-customerinv'])) { $tmp_customerinv = $_POST['tmp-customerinv']; }     
  if(isset($_POST['tmp-newacct'])) { $tmp_newacct = $_POST['tmp-newacct']; }
  if(isset($_POST['tmp-orderack'])) { $tmp_orderack = $_POST['tmp-orderack']; }
  if(isset($_POST['tmp-payment'])) { $tmp_payment = $_POST['tmp-payment']; }        
  if(isset($_POST['tmp-proforma'])) { $tmp_proforma = $_POST['tmp-proforma']; }  
  if(isset($_POST['tmp-po'])) { $tmp_po = $_POST['tmp-po']; }
  if(isset($_POST['tmp-quote'])) { $tmp_quote = $_POST['tmp-quote']; }
  if(isset($_POST['tmp-samplecust'])) { $tmp_samplecust = $_POST['tmp-samplecust']; }
  if(isset($_POST['tmp-samplesupp'])) { $tmp_samplesupp = $_POST['tmp-samplesupp']; }  
  if(isset($_POST['tmp-supplierawk'])) { $tmp_supplierawk = $_POST['tmp-supplierawk']; }
  if(isset($_POST['tmp-usb'])) { $tmp_usb = $_POST['tmp-usb']; }
  if(isset($_POST['tmp-voucher'])) { $tmp_voucher = $_POST['tmp-voucher']; }


// -----------------------------------------------------------------------------
// Template parts key:
// (U)niversal. Will appear on all templates.
// (P)ersonal. Contains elements grabbed from db on submit.
// (S)pecific wording for special templates. Wording for Artwork Approval, Quotation templates and everything else. 
// (T)emplates that are completed. Built using bits of U, P and S. 
// -----------------------------------------------------------------------------

  // Universal e-mail template
    $uHtmlHead = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"><title>E-Mail Template</title></head>' . "\n";
    $uStart = '<body><table cellpadding="0" cellspacing="0" width="100%"><tr><td><!-- left padding --></td><td width="600"><table cellpadding="0" cellspading="0" width="600"><tr><!-- header --><td>' . "\n";
    $uBodyHi = '</td></tr><tr><!-- content --><td><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Dear ,</p>' . "\n";
    $uBodyBye = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Kind regards,</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin-bottom:10px;">' . "\n";
    if($person['job'] === "Sales Executive" || $person['job'] === "Sales Support Executive" || $person['job'] === "Sales Director" || $person['job'] === "Sales Support Manager") { $uMainTel = 'Main: 01274 854996<br>' . "\n"; }
	else { $uMainTel = 'Main: 01274 852598<br>' . "\n"; }
    $uBanner = '</p></td></tr><tr><!-- banner --><td><a href="http://www.lsi.co.uk/util/email/redir/footerbanner.php"><img src="http://www.lsi.co.uk/util/email/banner/footerbanner.png" border="0" width="600" height="100"></a> <br></td></tr>';
	$uFooter = '<tr><!-- logos --> <td><table cellpadding="0" cellspacing="0" width="600"><tr> <td width="120" align="center"> <a href="http://www.lsi.co.uk/util/email/logo/logo1.php"><img src="http://www.lsi.co.uk/util/email/logo/logo1.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"> <a href="http://www.lsi.co.uk/util/email/logo/logo2.php"><img src="http://www.lsi.co.uk/util/email/logo/logo2.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"><a href="http://www.lsi.co.uk/util/email/logo/logo3.php"><img src="http://www.lsi.co.uk/util/email/logo/logo3.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"> <a href="http://www.lsi.co.uk/util/email/logo/logo4.php"><img src="http://www.lsi.co.uk/util/email/logo/logo4.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"> <a href="http://www.lsi.co.uk/util/email/logo/logo5.php"><img src="http://www.lsi.co.uk/util/email/logo/logo5.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td></tr></table> <br></td></tr><tr><!-- tree --> <td><table cellpadding="0" cellspacing="0" width="600"><tr> <td width="50"><img src="http://www.lsi.co.uk/util/email/img/tree.png" alt="Please consider the environment before printing this e-mail" width="34" height="50"></td><td valign="center" style="font-family:calibri,arial,sans-serif;color:#9FA28B;font-size:11px;">Please consider the environment before printing this e-mail</td></tr></table></td></tr><tr><!-- address --> <td><p style="font-family:calibri,arial,sans-serif;color:#9FA28B;font-size:11pt;margin-top:10px;"><strong style="color:#595F51;">LSi Limited</strong><br>Braemar House, Snelsins Road, Cleckheaton, BD19 3UE.<br><span style="font-size:11px">LSi Ltd is a limited company registered in England with Company Number 2991695.</span></p></td></tr><tr><!-- disclaimer --><td><p style="font-family:calibri,arial,sans-serif;color:#AAAAAA;font-size:11px;margin-top:10px;">This e-mail transmission and any attachments to it are intended solely for the use of the individual or entity to whom it is addressed and may contain confidential and privileged information. If you are not the intended recipient, your use, forwarding, printing, storing, disseminating, distribution, or copying of this communication is prohibited. If you received this communication in error, please notify the sender immediately by replying to this message and delete it from your computer.</p></td></tr><tr><!-- awards --> <td> <a href="http://www.lsi-gifts.co.uk/awards"><img src="http://www.lsi.co.uk/util/email/img/awards.png" alt="Award Winners" width="600" height="120" border="0"></a></td></tr></table></td> <td><!-- right padding --></td></tr></table></body></html>';
	// $uFooter - logos removed: $uFooter = '</p></td></tr><tr><!-- banner --><td><a href="http://www.lsi.co.uk/util/email/redir.php"><img src="http://www.lsi.co.uk/util/email/img/didyouknow.png" alt="Did you know we also do...?" border="0" width="600" height="80"></a> <br></td></tr><tr><!-- tree --> <td><table cellpadding="0" cellspacing="0" width="600"><tr> <td width="50"><img src="http://www.lsi.co.uk/util/email/img/tree.png" alt="Please consider the environment before printing this e-mail" width="34" height="50"></td><td valign="center" style="font-family:calibri,arial,sans-serif;color:#9FA28B;font-size:11px;">Please consider the environment before printing this e-mail</td></tr></table></td></tr><tr><!-- address --> <td><p style="font-family:calibri,arial,sans-serif;color:#9FA28B;font-size:11pt;margin-top:10px;"><strong style="color:#595F51;">LSi Limited</strong><br>Braemar House, Snelsins Road, Cleckheaton, BD19 3UE.<br><span style="font-size:11px">LSi Ltd is a limited company registered in England with Company Number 2991695.</span></p></td></tr><tr><!-- disclaimer --><td><p style="font-family:calibri,arial,sans-serif;color:#AAAAAA;font-size:11px;margin-top:10px;">This e-mail transmission and any attachments to it are intended solely for the use of the individual or entity to whom it is addressed and may contain confidential and privileged information. If you are not the intended recipient, your use, forwarding, printing, storing, disseminating, distribution, or copying of this communication is prohibited. If you received this communication in error, please notify the sender immediately by replying to this message and delete it from your computer.</p></td></tr><tr><!-- awards --> <td> <a href="http://www.lsi-gifts.co.uk/awards"><img src="http://www.lsi.co.uk/util/email/img/awards.png" alt="Award Winners" width="600" height="120" border="0"></a></td></tr></table></td> <td><!-- right padding --></td></tr></table></body></html>';
	
  // Accounts bit
    $uPaymentterms = '<p style="font-family:calibri,arial,sans-serif;color:#A70060;font-size:11pt;">PLEASE NOTE OUR PAYMENT TERMS ARE STRICTLY 30 DAYS DATE OF INVOICE.</p>';

  // personalised bits
    $pStandard = '<a href="http://www.lsi.co.uk/"><img src="http://www.lsi.co.uk/util/email/img/' . $shortname . 'header.png" alt="LSi - Make An Impression" border="0" width="600" height="140"></a><br>' . "\n";
	// xmas banner -- $pStandard = '<a href="http://www.lsi.co.uk/"><img src="http://www.lsi.co.uk/util/email/img/xmas14/' . $shortname . 'header.jpg" alt="LSi - Make An Impression" border="0" width="600" height="140"></a><br>' . "\n";
    $pName = $name . '<br />' . "\n";
    $pJob = $job . '<br />' . "\n";
    if(!empty($tel)) { $pTel = 'DDi: ' . $tel . '<br />' . "\n"; } else { $pTel = ''; }
    if(!empty($mob)) { $pMob = 'Mobile: ' . $mob . '<br />' . "\n"; } else { $pMob = ''; }
    $pEmail = 'E-Mail: <a href="mailto:' . $emaillink . '">' . $email . '</a>' . "\n";

  // Bits for other templates
    // Artwork Approval (this requires an exception for Helen Bell as the '?admin=' url variable is generated from the first name of the sender. Helen Miskell would get Helen Bell's e-mails in this case)
      $sArtworkHi = '<p style="font-family:calibri,arial,sans-serif;font-size:11pt;font-weight:bold;color:#B90000;">Job Number: LS <br />Product: </p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Please find attached a copy of your artwork approval sheet, showing your logo and how it will appear on the item you have ordered.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Please open the attachment, check all logos, details, print colours and positions. If all details are correct, please click the <span style="font-weight:bold;color:#368036">\'Approve\'</span> button. If you need us to make changes/corrections, please click the <span style="font-weight:bold;color:#B90000">\'Reject\'</span> button.</p>';
      if($firstname == "helen") { $sArtworkBody = '<div align="center"><a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=approval&admin=' . $firstname . 'b"><img src="http://www.lsi.co.uk/util/email/img/approve.png" alt="Approve" border="0" width="170" height="170" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=rejection&admin=' . $firstname . 'b"><img src="http://www.lsi.co.uk/util/email/img/reject.png" alt="Reject" border="0" width="170" height="170" /></a></div><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">If you are unable to click the buttons above due to security restrictions or otherwise, please visit <a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=approval&admin=' . $firstname . 'b">http://www.lsi.co.uk/util/artwork-approval/index.php?type=approval&admin=' . $firstname . 'b</a> to approve the artwork or <a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=rejection&admin=' . $firstname . 'b">http://www.lsi.co.uk/util/artwork-approval/index.php?type=rejection&admin=' . $firstname . 'b</a> to reject the artwork.</p>'; } else { $sArtworkBody = '<div align="center"><a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=approval&admin=' . $firstname . '"><img src="http://www.lsi.co.uk/util/email/img/approve.png" alt="Approve" border="0" width="170" height="170" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=rejection&admin=' . $firstname . '"><img src="http://www.lsi.co.uk/util/email/img/reject.png" alt="Reject" border="0" width="170" height="170" /></a></div><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">If you are unable to click the buttons above due to security restrictions or otherwise, please visit <a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=approval&admin=' . $firstname . '">http://www.lsi.co.uk/util/artwork-approval/index.php?type=approval&admin=' . $firstname . '</a> to approve the artwork or <a href="http://www.lsi.co.uk/util/artwork-approval/index.php?type=rejection&admin=' . $firstname . '">http://www.lsi.co.uk/util/artwork-approval/index.php?type=rejection&admin=' . $firstname . '</a> to reject the artwork.</p>'; }
      $sArtworkBye = '<p style="font-family:calibri,arial,sans-serif;font-size:11pt;font-weight:bold;color:#B90000;">Due to the print schedule involved in your items, please act upon this e-mail immediately.</p><p style="font-family:calibri,arial,sans-serif;font-size:11pt;font-weight:bold;color:#B90000;">Delays in responding to this artwork approval request may result in the delivery of your order being delayed.</p>';
    // Artwork Request
	  $sArtworkRequestBody = '<h1 style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:16pt;">Design Type: Order Procedure</h1><h1 style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:16pt;margin-top: 20px;">Item Type: Promotional Merchandise/Corporate Schemes/Far East Sourcing/Corporate Clothing/Eco Friendly Products</h1><h1 style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:16pt;margin-top: 20px;">Order Info</h1><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Date:</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Job Number:</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Customer:</p>		<h1 style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:16pt;margin-top: 20px;">Item Info</h1><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Item:</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Item Colour:</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Print Position:</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Print Colour(s):</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Thread Colour(s):</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Print Area:</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Method:</p> <h1 style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:16pt;margin-top: 20px;">Artwork Info: Full Colour Artwork/Colour Seperated Artwork/One Colour Artwork</h1><h1 style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:16pt;margin-top: 20px;">Additional Info</h1><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Please put additional info here</p><h1 style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:16pt;margin-top: 20px;">Dates Required</h1><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;margin: 0 0 5px;">Date Needed For:</p>';
	// Buy Yorkshire Exhibition, Created March 2013
	  $sBuyYorkshireBody = '<table cellpadding="0" cellspacing="0" width="580"><tr><td width="360"><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Dear Client</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">We are pleased to announce and confirm LSi\'s forthcoming attendance at the Buy Yorkshire conference taking place at The Royal Armouries on 23-25th April. </p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">We have secured two stands (22 and 28) for the two days and are looking forward to meeting with existing and prospective clients and explaining how clever use of promotional merchandise can really prove effective in promoting your products and services to your own clients.</p></td><td width="20"></td><td width="200"><img src="http://lsi.co.uk/util/email/img/buyyorkshire.jpg" alt="Buy Yorkshire" width="200" height="239" /></td></tr></table><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">As a fellow exhibitor we would welcome the opportunity of working with you to assess your forthcoming requirements for the show, and if you are thinking of simply offering pens and mints... STOP... please think again, everybody takes the easy option! Here at LSi we can work with you, understand your market and your objectives for the event and put together some really interesting, useful and exciting ideas for use at the forthcoming show.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Our team of 25 are based in Cleckheaton at our brand new offices and are ready to tackle your brief. So please call us, we wont just sell you a pen, we will offer you proven promotional product solutions that work!!</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Oh... we nearly forgot - we\'ve also just been voted "Best Distributor of the Year 2013" by the members of British Promotional Merchandise Association, so if you are looking to use the proven most cost effective advertising method please contact us, we\'d be happy to offer our ideas.</p>';
	// Customer Invoice
      $sCustomerinvBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Please find attached your invoice for the above order. Payment terms are strictly 30 days from date of invoice.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">If you have any queries regarding payment, please contact our Accounts department on 01274 854982.</p>';
    // New Account
      $sNewacctBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Many thanks for your first order placed with LSi. In line with our ISO 9001 procedures, and as discussed previously, your order is subject to the following payment terms:-</p><ul style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><li>Your first order will be will be on a 100% pro forma basis. Payment can be made to LSi by credit card, BACS or cheque.  Your invoice will be generated by our Administration team shortly and sent directly to you.  Please await this document before making payment.</li><li>Your first order will be on a 50% Pro forma basis. Payment can be made to LSi by credit card, BACS or cheque.  Your invoice will be generated by our Admin team shortly and sent directly to you, please await this final invoice before making payment.</li><li>We are happy to give credit terms on this order to the value of £00.00, subject to completion of our Credit Application Form (attached) and satisfactory credit checks.</li></ul><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">To pay by credit card, please call 01274 854982. Your payment will be processed immediately and your order will not be subject to delay, providing you have made payment by the requested date.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">To pay by BACS, please inform us if this is your preferred method. Our account details are : Account No - 80172286, Sort Code - 20-11-81, IBAN - GB17BARC20118180172286, SWIFT – BARC GB22. You must submit a remittance advice or email confirming your payment has been made. Any delay in payment being received could affect your delivery date.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">To pay by cheque, please inform us if this is your preferred method. Send your cheque to LSi Ltd, Braemar House, Snelsins Road, Cleckheaton, BD19 3UE. We are unable to process an order until cleared funds have been received into our account. Any delay in payment being received, and cleared, could affect your delivery date.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">If you have any questions, please do not hesitate to contact me.</p>';
    // Order Acknowledgement
      $sOrderackBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><b>Order ref LS</b></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Thank you for your recent order. Attached is your order acknowledgement.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Please check that all your instructions have been interpreted correctly. <font color="#CC0000"><b><i>**Although every effort is made to ensure all information is correct, LSi Ltd cannot be held responsible for any errors, alterations or omissions brought to our attention after your order has been delivered.**</i></b></font></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">You do not need to reply to this e-mail unless there are discrepancies regarding delivery, price etc.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Thanks once again for your order.</p>';
    // Payment
      $sPaymentBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Order Ref: LS</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Many thanks for your recent order. Attached is your Pro Forma invoice which we require full payment in order to progress your order further.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:16px;color:#595F51"><b>Payment Methods</b></p><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Credit Card" src="http://www.lsi.co.uk/util/email/img/card.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><b>Credit Card</b><br>Please contact us in order to process your payment. Once the card details are accepted, your order will be processed.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="bacs" src="http://www.lsi.co.uk/util/email/img/bacs.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><b>BACS</b><br>Will take 3 days for funds to be transferred, please provide a remittance statement in order for your order to be processed.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Cheque" src="http://www.lsi.co.uk/util/email/img/cheque.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><b>Cheque</b><br>Will take 3 days to clear, once we have received the cheque your order will be processed, however, the order will be put on hold if funds do not clear.</p></td></tr></tbody></table><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#CC0000"><b>Please Note:</b> Orders will only be processes once we have received payment. If your order is required for a specific date, we will require payment immediately.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#CC0000">Once we have received payment, a paid receipt will be emailed to confirm receipt.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">If you have any queries regarding this or wish to make payment through an alternative method, please do not hesitate to contact myself or Accounts on 01274 854982.</p>';
    // Proforma Invoice
      $sProformaBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Order Ref: LS</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Many thanks for your recent order. Please find attached your Pro Forma invoice for which we require full payment to enable us to progress your order.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;font-weight:bold">Your requested delivery date is __________</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;font-weight:bold">We would require cleared funds no later than ________ to ensure there is no delay in processing your order due to late payment. Should funds not be received by the above date your requested delivery date will be affected.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Below lists the preferred payment methods and the timescales for funds to clear.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:15px;"><b>Payment Methods</b></p><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Credit Card" src="http://www.lsi.co.uk/util/email/img/card.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;"><b>Credit Card</b><br>Please contact us with your card details and once the payment has been accepted, your order will be processed immediately.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="bacs" src="http://www.lsi.co.uk/util/email/img/bacs.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;"><b>BACS</b><br>Will take 3 working days for funds to be transferred. Please provide a remittance advice to enable your order to be processed.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Cheque" src="http://www.lsi.co.uk/util/email/img/cheque.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;"><b>Cheque</b><br>Will take 3 working days to clear. Only when we have received cleared funds will your order be progressed.</p></td></tr></tbody></table><p style="font-family:calibri,arial,sans-serif;color:#990000;font-size:15px;"><b>Please Note:</b> LSi will not progress any artwork, order stock or secure print schedules until payment is received.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Once we have received payment, a paid receipt will be emailed to confirm receipt.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;font-weight:bold;">If you have any queries regarding this or wish to make payment through an alternative method, please do not hesitate to contact myself or Accounts on 01274 854982.</p>';
    // Purchase Order - remmed at BH's request, 26/06/2015
      //$sPoBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Please find attached purchase order. Artwork will follow in due course.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;"><font color="#CC0000"><b>**Please deliver under LSI cover using the attached Despatch Note, and advise us of any overs at the time of despatch**</b></font></p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;"><font color="#CC0000">**Please acknowledge our order at your earliest convenience.</font></p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Should you have any problems please do not hesitate to contact me.</p>';
    // Quotation
      $sQuoteBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">It\'s my pleasure to provide as discussed your quotation for the</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">Let me know your thoughts and if I can be of further assistance please do not hesitate to contact me.</p>';
    // Sample (Customer)
      $sSamplecustBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Please find attached acknowledgement of your sample request. These items will be delivered to you shortly.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">These samples are supplied on a 30 day \'Sale or Return\' basis.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">If you cannot make your decision within this period and you need more time, please contact us as soon as possible and we can arrange an extension.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Samples must be returned in good condition and within the initial or agreed extended loan period to avoid an invoice being issued. If any are returned which have been washed, worn or are in poor condition they will be considered as sold and an invoice will be issued.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Please return any items to us by recorded delivery as we cannot be held responsible for lost packages.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">N.B &ndash; All samples must be returned in their original packaging.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">We hope these samples are of interest and if we can be of any further assistance please do not hesitate to contact us on our details below.</p>';
    // Sample (Supplier)
      $sSamplesuppBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Please find attached a purchase order for a sample request to be sent out directly to our customer, the address can be found at the bottom of the attached purchase order along with the name of the contact. This order must be sent out under LSi cover only.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><font color="#FF0000"><b><u>Please note that if you do not state our purchase order number on your invoice this may delay payment.</u></b></font></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">If you have any problems please do not hesitate to contact me.</p>';
    // Supplier Artwork - remmed at BH's request, 26/06/2015
      //$sSupplierawkBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Please find attached the artwork and order procedure for the above order.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51"><font color="#CC0000"><b>**Please confirm you have received all artwork correctly and acknowledge our order at your earliest convenience.**</b></font></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Our artwork is sent in Illustrator format, colour separated and converted to layers, all fonts are converted to paths.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:11pt;color:#595F51">Should you have any trouble opening any of the files attached please do not hesitate to contact me.</p>';
    // USB
      $sUsbBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">It\'s definitely worth pointing out a few issues when it comes to USB memory sticks because this particular area of our market is very much a minefield:</p><ul><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">All our USB memory sticks come with a year warranty</li><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">All our USB chips are brand new promotion quality* chips NOT recycled memory &ndash; this is a growth area for some factories from China to cut costs.</li><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">All our chips are genuine chips NOT downgraded memory, if we sell you a 512MB chip then you get 512MB</li><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">If you would like an additional quote on retail grade chips, please let me know.</li></ul><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:11pt;">* Promotion quality chips are grade B chips.</p>';
    // Voucher
      $sVoucherBody = '<table width="600" cellspacing="0" cellpadding="0"><tbody><tr> <td width="600"><img width="600" height="156" alt="" src="http://www.lsi.co.uk/util/email/img/voucher_01.jpg"></td></tr><tr> <td><table width="600" cellspacing="0" cellpadding="0"><tbody><tr> <td width="200"><img width="200" height="32" alt="" src="http://www.lsi.co.uk/util/email/img/voucher_02.jpg"></td> <td width="200" align="center" style="font-family:calibri,arial,sans-serif;font-size:11pt;font-weight:bold;">Code</td> <td width="200"><img width="200" height="32" alt="" src="http://www.lsi.co.uk/util/email/img/voucher_04.jpg"></td></tr></tbody></table></td></tr><tr> <td width="600"><img width="600" height="16" alt="" src="http://www.lsi.co.uk/util/email/img/voucher_05.jpg"></td></tr><tr> <td><table width="600" cellspacing="0" cellpadding="0"><tbody><tr> <td width="302"><img width="302" height="26" alt="" src="http://www.lsi.co.uk/util/email/img/voucher_06.jpg"></td><td width="79" style="font-family:calibri,arial,sans-serif;font-size:11px;">Date</td> <td width="219"><img width="219" height="26" alt="" src="http://www.lsi.co.uk/util/email/img/voucher_08.jpg"></td></tr></tbody></table></td></tr><tr> <td width="600"> <img width="600" height="32" alt="" src="http://www.lsi.co.uk/util/email/img/voucher_09.jpg"></td></tr></tbody></table>';      

  // Generated Template: Standard
    if($shortname == "accounts") { $tStandard = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uPaymentterms . $uBanner . $uFooter; }
    else { $tStandard = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter; }    
  // Generated Template: Artwork Approval
    $tArtworkapproval = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sArtworkHi . $sArtworkBody . $sArtworkBye . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;    
  // Generated Template: Artwork Request
    $tArtworkrequest = $uHtmlHead . $uStart . $pStandard . $sArtworkRequestBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;    
  // Generated Template: Buy Yorkshire
    $tBuyYorkshire = $uHtmlHead . $uStart . $pStandard . $sBuyYorkshireBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;    
  // Generated Template: Customer Invoice
    $tCustomerinv = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sCustomerinvBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;    
  // Generated Template: New Account
    $tNewacct = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sNewacctBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;
  // Generated Template: Order Acknowledgement
    $tOrderack = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sOrderackBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;          
  // Generated Template: Payment
    $tPayment = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sPaymentBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;            
  // Generated Template: Proforma Invoice
    $tProforma = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sProformaBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;          
  // Generated Template: Purchase Order - remmed at BH's request, 26/06/2015
    $tPo = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sPoBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;
  // Generated Template: Quotation
    $tQuote = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sQuoteBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;                               
  // Generated Template: Sample (Customer)
    $tSamplecust = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sSamplecustBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;    
  // Generated Template: Sample (Supplier)
    $tSamplesupp = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sSamplesuppBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;  
  // Generated Template: Supplier Artwork - remmed at BH's request, 26/06/2015
    //$tSupplierawk = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sSupplierawkBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;
  // Generated Template: USB
    $tUsb = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sUsbBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;
  // Generated Template: Voucher
    $tVoucher = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sVoucherBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uBanner . $uFooter;   
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Templates Generated | E-Mail Template Generator</title>
  
  <?php include('inc/js.php'); ?>
  <?php include('inc/css.php'); ?>
</head>

<body class="<?php echo $currentfile; ?>">

  <div id="wrapper">  
    <nav>
      <?php include('inc/nav.php'); ?>
    </nav>
    
    <h1>E-Mail Template Generator</h1>
    
    <h2>Templates: Generated!</h2>

<?php
// -----------------------------------------------------------------------------
// Now it's time to generate and to create save the template .html files
// -----------------------------------------------------------------------------

// I expect there's a lovely way of putting the checkbox values into an array and looping through all this. A job for another day, perhaps.

// Here's something useful... This is the block of code that creates and writes to the file.
// Replace [#TMPTICKED#] with 'standard','artworkapproval', 'customerinv' etc as found in the 'get posted data' section above.
// Replace [#TMPTYPE#] with 'Standard', 'Artworkapproval', 'Customerinv' etc as found in the 'Template: ...' section(s) above.
// Replace [#TMPTYPENICE#] with 'Standard', 'Artwork Approval', 'Customer Invoice' etc to give the file a nice, easily readable, filename.
  /*
  if(isset($tmp_[#TMPTICKED#])) {
    $t[#TMPTYPE#]Out = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - [#TMPTYPENICE#] (P).html';
    fopen($t[#TMPTYPE#]Out,'w');
    if(is_writeable($t[#TMPTYPE#]Out)){
      if(!$handle = fopen($t[#TMPTYPE#]Out,'w')){
        echo "<p>Cannot open file $t[#TMPTYPE#]Out.</p>";
        exit;
      }
      if(fwrite($handle, $t[#TMPTYPE#]) === FALSE) {
        echo "<p>Cannot write to file $t[#TMPTYPE#]Out.</p>";
      }
      
      echo "<p>Success! $t[#TMPTYPE#]Out has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $t[#TMPTYPE#]Out is not writable.</p>";
    }  
  }
  */

// If 'Standard' is selected...
  if(isset($tmp_standard)) {
    $tStandardOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Standard (P).html';
    fopen($tStandardOut,'w');
    if(is_writeable($tStandardOut)){
      if(!$handle = fopen($tStandardOut,'w')){
        echo "<p>Cannot open file $tStandardOut.</p>";
        exit;
      }
      if(fwrite($handle, $tStandard) === FALSE) {
        echo "<p>Cannot write to file $tStandardOut.</p>";
      }
      
      echo "<p>Success! $tStandardOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tStandardOut is not writable.</p>";
    }  
  }

// If 'Artwork Approval' is selected...
  if(isset($tmp_artworkapproval)) {
    $tArtworkapprovalOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Artwork Approval (P).html';
    fopen($tArtworkapprovalOut,'w');
    if(is_writeable($tArtworkapprovalOut)){
      if(!$handle = fopen($tArtworkapprovalOut,'w')){
        echo "<p>Cannot open file $tArtworkapprovalOut.</p>";
        exit;
      }
      if(fwrite($handle, $tArtworkapproval) === FALSE) {
        echo "<p>Cannot write to file $tArtworkapprovalOut.</p>";
      }
      
      echo "<p>Success! $tArtworkapprovalOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tArtworkapprovalOut is not writable.</p>";
    }  
  }
  
// If 'Artowrk Request' is selected...
  if(isset($tmp_artworkrequest)) {
    $tArtworkrequestOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Artwork Request (P).html';
    fopen($tArtworkrequestOut,'w');
    if(is_writeable($tArtworkrequestOut)){
      if(!$handle = fopen($tArtworkrequestOut,'w')){
        echo "<p>Cannot open file $tArtworkrequestOut.</p>";
        exit;
      }
      if(fwrite($handle, $tArtworkrequest) === FALSE) {
        echo "<p>Cannot write to file $tArtworkrequestOut.</p>";
      }
      
      echo "<p>Success! $tArtworkrequestOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tArtworkrequestOut is not writable.</p>";
    }  
  }

// If 'Buy Yorkshire' is selected...
  if(isset($tmp_buyyorkshire)) {
    $tBuyYorkshireOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Buy Yorkshire (P).html';
    fopen($tBuyYorkshireOut,'w');
    if(is_writeable($tBuyYorkshireOut)){
      if(!$handle = fopen($tBuyYorkshireOut,'w')){
        echo "<p>Cannot open file $tBuyYorkshireOut.</p>";
        exit;
      }
      if(fwrite($handle, $tBuyYorkshire) === FALSE) {
        echo "<p>Cannot write to file $tBuyYorkshireOut.</p>";
      }
      
      echo "<p>Success! $tBuyYorkshireOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tBuyYorkshireOut is not writable.</p>";
    }  
  }
  
// If 'Customer Invoice' is selected...
  if(isset($tmp_customerinv)) {
    $tCustomerinvOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Customer Invoice (P).html';
    fopen($tCustomerinvOut,'w');
    if(is_writeable($tCustomerinvOut)){
      if(!$handle = fopen($tCustomerinvOut,'w')){
        echo "<p>Cannot open file $tCustomerinvOut.</p>";
        exit;
      }
      if(fwrite($handle, $tCustomerinv) === FALSE) {
        echo "<p>Cannot write to file $tCustomerinvOut.</p>";
      }
      
      echo "<p>Success! $tCustomerinvOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tCustomerinvOut is not writable.</p>";
    }  
  }
  
// If 'New Account' is selected...
  if(isset($tmp_newacct)) {
    $tNewacctOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - New Account (P).html';
    fopen($tNewacctOut,'w');
    if(is_writeable($tNewacctOut)){
      if(!$handle = fopen($tNewacctOut,'w')){
        echo "<p>Cannot open file $tNewacctOut.</p>";
        exit;
      }
      if(fwrite($handle, $tNewacct) === FALSE) {
        echo "<p>Cannot write to file $tNewacctOut.</p>";
      }
      
      echo "<p>Success! $tNewacctOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tNewacctOut is not writable.</p>";
    }  
  }

// If 'Order Acknowledgement' is selected...
  if(isset($tmp_orderack)) {
    $tOrderackOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Order Acknowledgement (P).html';
    fopen($tOrderackOut,'w');
    if(is_writeable($tOrderackOut)){
      if(!$handle = fopen($tOrderackOut,'w')){
        echo "<p>Cannot open file $tOrderackOut.</p>";
        exit;
      }
      if(fwrite($handle, $tOrderack) === FALSE) {
        echo "<p>Cannot write to file $tOrderackOut.</p>";
      }
      
      echo "<p>Success! $tOrderackOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tOrderackOut is not writable.</p>";
    }  
  }

// If 'Payment' is selected...
  if(isset($tmp_payment)) {
    $tPaymentOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Payment (P).html';
    fopen($tPaymentOut,'w');
    if(is_writeable($tPaymentOut)){
      if(!$handle = fopen($tPaymentOut,'w')){
        echo "<p>Cannot open file $tPaymentOut.</p>";
        exit;
      }
      if(fwrite($handle, $tPayment) === FALSE) {
        echo "<p>Cannot write to file $tPaymentOut.</p>";
      }
      
      echo "<p>Success! $tPaymentOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tPaymentOut is not writable.</p>";
    }  
  }
  
// If 'Proforma' is selected...
  if(isset($tmp_proforma)) {
    $tProformaOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Proforma Invoice (P).html';
    fopen($tProformaOut,'w');
    if(is_writeable($tProformaOut)){
      if(!$handle = fopen($tProformaOut,'w')){
        echo "<p>Cannot open file $tProformaOut.</p>";
        exit;
      }
      if(fwrite($handle, $tProforma) === FALSE) {
        echo "<p>Cannot write to file $tProformaOut.</p>";
      }
      
      echo "<p>Success! $tProformaOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tProformaOut is not writable.</p>";
    }  
  }
  
// If 'Purchase Order' is selected...
  if(isset($tmp_po)) {
    $tPoOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Purchase Order (P).html';
    fopen($tPoOut,'w');
    if(is_writeable($tPoOut)){
      if(!$handle = fopen($tPoOut,'w')){
        echo "<p>Cannot open file $tPoOut.</p>";
        exit;
      }
      if(fwrite($handle, $tPo) === FALSE) {
        echo "<p>Cannot write to file $tPoOut.</p>";
      }
      
      echo "<p>Success! $tPoOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tPoOut is not writable.</p>";
    }  
  }

// If 'Quotation' is selected...
  if(isset($tmp_quote)) {
    $tQuoteOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Quotation (P).html';
    fopen($tQuoteOut,'w');
    if(is_writeable($tQuoteOut)){
      if(!$handle = fopen($tQuoteOut,'w')){
        echo "<p>Cannot open file $tQuoteOut.</p>";
        exit;
      }
      if(fwrite($handle, $tQuote) === FALSE) {
        echo "<p>Cannot write to file $tQuoteOut.</p>";
      }
      
      echo "<p>Success! $tQuoteOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tQuoteOut is not writable.</p>";
    }  
  }
  
  
// If 'Sample (Customer)' is selected...
  if(isset($tmp_samplecust)) {
    $tSamplecustOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Sample (Customer) (P).html';
    fopen($tSamplecustOut,'w');
    if(is_writeable($tSamplecustOut)){
      if(!$handle = fopen($tSamplecustOut,'w')){
        echo "<p>Cannot open file $tSamplecustOut.</p>";
        exit;
      }
      if(fwrite($handle, $tSamplecust) === FALSE) {
        echo "<p>Cannot write to file $tSamplecustOut.</p>";
      }
      
      echo "<p>Success! $tSamplecustOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tSamplecustOut is not writable.</p>";
    }  
  }
  
// If 'Sample (Supplier)' is selected...
  if(isset($tmp_samplesupp)) {
    $tSamplesuppOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Sample (Supplier) (P).html';
    fopen($tSamplesuppOut,'w');
    if(is_writeable($tSamplesuppOut)){
      if(!$handle = fopen($tSamplesuppOut,'w')){
        echo "<p>Cannot open file $tSamplesuppOut.</p>";
        exit;
      }
      if(fwrite($handle, $tSamplesupp) === FALSE) {
        echo "<p>Cannot write to file $tSamplesuppOut.</p>";
      }
      
      echo "<p>Success! $tSamplesuppOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tSamplesuppOut is not writable.</p>";
    }  
  }

// If 'Supplier Artwork' is selected...
  if(isset($tmp_supplierawk)) {
    $tSupplierawkOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Supplier Artwork (P).html';
    fopen($tSupplierawkOut,'w');
    if(is_writeable($tSupplierawkOut)){
      if(!$handle = fopen($tSupplierawkOut,'w')){
        echo "<p>Cannot open file $tSupplierawkOut.</p>";
        exit;
      }
      if(fwrite($handle, $tSupplierawk) === FALSE) {
        echo "<p>Cannot write to file $tSupplierawkOut.</p>";
      }
      
      echo "<p>Success! $tSupplierawkOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tSupplierawkOut is not writable.</p>";
    }  
  }
  
// If 'USB' is selected...
  if(isset($tmp_usb)) {
    $tUsbOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - USB (P).html';
    fopen($tUsbOut,'w');
    if(is_writeable($tUsbOut)){
      if(!$handle = fopen($tUsbOut,'w')){
        echo "<p>Cannot open file $tUsbOut.</p>";
        exit;
      }
      if(fwrite($handle, $tUsb) === FALSE) {
        echo "<p>Cannot write to file $tUsbOut.</p>";
      }
      
      echo "<p>Success! $tUsbOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tUsbOut is not writable.</p>";
    }  
  }
  
// If 'Voucher' is selected...
  if(isset($tmp_voucher)) {
    $tVoucherOut = 'generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Voucher (P).html';
    fopen($tVoucherOut,'w');
    if(is_writeable($tVoucherOut)){
      if(!$handle = fopen($tVoucherOut,'w')){
        echo "<p>Cannot open file $tVoucherOut.</p>";
        exit;
      }
      if(fwrite($handle, $tVoucher) === FALSE) {
        echo "<p>Cannot write to file $tVoucherOut.</p>";
      }
      
      echo "<p>Success! $tVoucherOut has been created.</p>";
      
      fclose($handle);
    }
    else {
      echo "<p>The file $tVoucherOut is not writable.</p>";
    }  
  }

?>

    </div>
  
  </body>

</html>