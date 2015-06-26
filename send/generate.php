<?php

// Hello there. This is the generator.
// Written and coded by Scott Brown (twitter: @thewebdes) on 16/07/2012.
// It gets data from the submitted form, queries the database to get that person's info and creates and saves .html files based upon submitted preferences.

// -----------------------------------------------------------------------------
// Connect to db to get everything we need
// -----------------------------------------------------------------------------

  require('../config/connect.php');
  
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
  // ...unless accounts@lsi-gifts.co.uk is your e-mail address
    if($emaillink === "accounts@lsi-gifts.co.uk") { $shortname = 'accounts'; }
  // Put caps in where the boss asks
    $email = ucfirst(str_replace('lsi-gifts.co.uk','LSi-gifts.co.uk',$person['email']));
  // Get lower case first name for artwork approval
    $firstnameprep = explode(' ',$person['name']);
    $firstname = strtolower($firstnameprep[0]); 
  
  require('../inc/disconnect.php');


// -----------------------------------------------------------------------------
// get posted data and create a nice variable for it (as long the option was ticked)
// -----------------------------------------------------------------------------
  if(isset($_POST['tmp-standard'])) { $tmp_standard = $_POST['tmp-standard']; }
  if(isset($_POST['tmp-artworkapproval'])) { $tmp_artworkapproval = $_POST['tmp-artworkapproval']; }
  if(isset($_POST['tmp-customerinv'])) { $tmp_customerinv = $_POST['tmp-customerinv']; }     
  if(isset($_POST['tmp-orderack'])) { $tmp_orderack = $_POST['tmp-orderack']; }
  if(isset($_POST['tmp-payment'])) { $tmp_payment = $_POST['tmp-payment']; }        
  if(isset($_POST['tmp-proforma'])) { $tmp_proforma = $_POST['tmp-proforma']; }  
  if(isset($_POST['tmp-po'])) { $tmp_po = $_POST['tmp-po']; }
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
// (T)emplates that are completed. Built unsing bits of U, P and S. 
// -----------------------------------------------------------------------------

  // Universal e-mail template
    $uHtmlHead = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"><title>E-Mail Template</title></head>' . "\n";
    $uStart = '<body><table cellpadding="0" cellspacing="0" width="100%"><tr><td><!-- left padding --></td><td width="600"><table cellpadding="0" cellspading="0" width="600"><tr><!-- header --><td>' . "\n";
    $uBodyHi = '</td></tr><tr><!-- content --><td><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Dear ,</p>' . "\n";
    $uBodyBye = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Kind regards,</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;margin-bottom:10px;">' . "\n";
    $uMainTel = 'Main: 01274 854996<br>' . "\n";
    $uFooter = '</p></td></tr><tr><!-- banner --><td><a href="http://www.lsi-gifts.co.uk/em2012/redir.php"><img src="http://www.lsi-gifts.co.uk/em2012/img/didyouknow.png" alt="Did you know we also do...?" border="0" width="600" height="80"></a> <br></td></tr><tr><!-- logos --> <td><table cellpadding="0" cellspacing="0" width="600"><tr> <td width="120" align="center"> <a href="http://www.lsi-gifts.co.uk/em2012/logo/logo1.php"><img src="http://www.lsi-gifts.co.uk/em2012/logo/logo1.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"> <a href="http://www.lsi-gifts.co.uk/em2012/logo/logo2.php"><img src="http://www.lsi-gifts.co.uk/em2012/logo/logo2.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"><a href="http://www.lsi-gifts.co.uk/em2012/logo/logo3.php"><img src="http://www.lsi-gifts.co.uk/em2012/logo/logo3.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"> <a href="http://www.lsi-gifts.co.uk/em2012/logo/logo4.php"><img src="http://www.lsi-gifts.co.uk/em2012/logo/logo4.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td> <td width="120" align="center"> <a href="http://www.lsi-gifts.co.uk/em2012/logo/logo5.php"><img src="http://www.lsi-gifts.co.uk/em2012/logo/logo5.png" alt="Visit the different divisions of LSi" border="0" width="120" height="78"></a></td></tr></table> <br></td></tr><tr><!-- tree --> <td><table cellpadding="0" cellspacing="0" width="600"><tr> <td width="50"><img src="http://www.lsi-gifts.co.uk/em2012/img/tree.png" alt="Please consider the environment before printing this e-mail" width="34" height="50"></td><td valign="center" style="font-family:calibri,arial,sans-serif;color:#9FA28B;font-size:11px;">Please consider the environment before printing this e-mail</td></tr></table></td></tr><tr><!-- address --> <td><p style="font-family:calibri,arial,sans-serif;color:#9FA28B;font-size:14px;margin-top:10px;"><strong style="color:#595F51;">LSi Limited</strong><br>The Old Print Works, Carr Street, Westgate, Cleckheaton, West Yorkshire, BD19 5HG.<br><span style="font-size:11px">LSi Ltd is a limited company registered in England with Company Number 2991695.</span></p></td></tr><tr><!-- disclaimer --><td><p style="font-family:calibri,arial,sans-serif;color:#AAAAAA;font-size:11px;margin-top:10px;">This e-mail transmission and any attachments to it are intended solely for the use of the individual or entity to whom it is addressed and may contain confidential and privileged information. If you are not the intended recipient, your use, forwarding, printing, storing, disseminating, distribution, or copying of this communication is prohibited. If you received this communication in error, please notify the sender immediately by replying to this message and delete it from your computer.</p></td></tr><tr><!-- awards --> <td> <a href="http://www.lsi-gifts.co.uk/awards"><img src="http://www.lsi-gifts.co.uk/em2012/img/awards.png" alt="Award Winners" width="600" height="120" border="0"></a></td></tr></table></td> <td><!-- right padding --></td></tr></table></body></html>';

  // personalised bits
    $pStandard = '<a href="http://www.lsi-gifts.co.uk/"><img src="http://www.lsi-gifts.co.uk/em2012/img/' . $shortname . 'header.png" alt="LSi - Make An Impression" border="0" width="600" height="140"></a><br>' . "\n";
    $pName = $name . '<br />' . "\n";
    $pJob = $job . '<br />' . "\n";
    if(!empty($tel)) { $pTel = 'DDi: ' . $tel . '<br />' . "\n"; } else { $pTel = ''; }
    if(!empty($mob)) { $pMob = 'Mobile: ' . $mob . '<br />' . "\n"; } else { $pMob = ''; }
    $pEmail = 'E-Mail: <a href="mailto:' . $emaillink . '">' . $email . '</a>' . "\n";

  // Bits for other templates
    // Artwork Approval
      $sArtworkHi = '<p style="font-family:calibri,arial,sans-serif;font-size:14px;font-weight:bold;color:#B90000;">Job Number: LS <br />Product: </p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Please find attached a copy of your artwork approval sheet, showing your logo and how it will appear on the item you have ordered.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Please open the attachment, check all logos, details, print colours and positions. If all details are correct, please click the <span style="font-weight:bold;color:#368036">\'Approve\'</span> button. If you need us to make changes/corrections, please click the <span style="font-weight:bold;color:#B90000">\'Reject\'</span> button.</p>';
      $sArtworkBody = '<div align="center"><a href="http://www.lsi-gifts.co.uk/artwork-approval/approve.php?admin=' . $firstname . '"><img src="http://www.lsi-gifts.co.uk/mail/img/artwork/approve.png" alt="Approve" border="0" width="170" height="170" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.lsi-gifts.co.uk/artwork-approval/reject.php?admin=' . $firstname . '"><img src="http://www.lsi-gifts.co.uk/mail/img/artwork/reject.png" alt="Reject" border="0" width="170" height="170" /></a></div><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">If you are unable to click the buttons above due to security restrictions or otherwise, please visit <a href="http://www.lsi-gifts.co.uk/artwork-approval/index.php?admin=' . $firstname . '">http://www.lsi-gifts.co.uk/artwork-approval/index.php?admin=' . $firstname . '</a>.</p>';
      $sArtworkBye = '<p style="font-family:calibri,arial,sans-serif;font-size:14px;font-weight:bold;color:#B90000;">Due to the print schedule involved in your items, please act upon this e-mail immediately.</p><p style="font-family:calibri,arial,sans-serif;font-size:14px;font-weight:bold;color:#B90000;">Delays in responding to this artwork approval request may result in the delivery of your order being delayed.</p>';
    // Customer Invoice
      $sCustomerinvBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Please find attached your invoice for the above order. Payment terms are strictly 30 days from date of invoice.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">If you have any queries regarding payment, please contact our Accounts department on 01274 854982.</p>';
    // Order Acknowledgement
      $sOrderackBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><b>Order ref LS</b></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Thank you for your recent order. Attached is your order acknowledgement.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Please check that all your instructions have been interpreted correctly. <font color="#CC0000"><b><i>**Although every effort is made to ensure all information is correct, LSi Ltd cannot be held responsible for any errors, alterations or omissions brought to our attention after your order has been delivered.**</i></b></font></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">You do not need to reply to this e-mail unless there are discrepancies regarding delivery, price etc.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Thanks once again for your order.</p>';
    // Payment
      $sPaymentBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Order Ref: LS</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Many thanks for your recent order. Attached is your Pro Forma invoice which we require full payment in order to progress your order further.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:16px;color:#595F51"><b>Payment Methods</b></p><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Credit Card" src="http://www.lsi-gifts.co.uk/mail/img/payment/card.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><b>Credit Card</b><br>Please contact us in order to process your payment. Once the card details are accepted, your order will be processed.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="bacs" src="http://www.lsi-gifts.co.uk/mail/img/payment/bacs.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><b>BACS</b><br>Will take 3 days for funds to be transferred, please provide a remittance statement in order for your order to be processed.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Cheque" src="http://www.lsi-gifts.co.uk/mail/img/payment/cheque.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><b>Cheque</b><br>Will take 3 days to clear, once we have received the cheque your order will be processed, however, the order will be put on hold if funds do not clear.</p></td></tr></tbody></table><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#CC0000"><b>Please Note:</b> Orders will only be processes once we have received payment. If your order is required for a specific date, we will require payment immediately.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#CC0000">Once we have received payment, a paid receipt will be emailed to confirm receipt.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">If you have any queries regarding this or wish to make payment through an alternative method, please do not hesitate to contact myself or Accounts on 01274 854982.</p>';
    // Proforma Invoice
      $sProformaBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Order Ref: LS</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Many thanks for your recent order. Please find attached your Pro Forma invoice for which we require full payment to enable us to progress your order.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;font-weight:bold">Your requested delivery date is __________</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;font-weight:bold">We would require cleared funds no later than ________ to ensure there is no delay in processing your order due to late payment. Should funds not be received by the above date your requested delivery date will be affected.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Below lists the preferred payment methods and the timescales for funds to clear.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:15px;"><b>Payment Methods</b></p><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Credit Card" src="http://www.lsi-gifts.co.uk/design/email/payment/card.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;"><b>Credit Card</b><br>Please contact us with your card details and once the payment has been accepted, your order will be processed immediately.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="bacs" src="http://www.lsi-gifts.co.uk/design/email/payment/bacs.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;"><b>BACS</b><br>Will take 3 working days for funds to be transferred. Please provide a remittance advice to enable your order to be processed.</p></td></tr></tbody></table> <br><table cellspacing="0" cellpadding="0" style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><tbody><tr> <td width="111" valign="top"> <img width="111" height="33" alt="Cheque" src="http://www.lsi-gifts.co.uk/design/email/payment/cheque.gif"></td> <td width="10"></td> <td valign="top"><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;"><b>Cheque</b><br>Will take 3 working days to clear. Only when we have received cleared funds will your order be progressed.</p></td></tr></tbody></table><p style="font-family:calibri,arial,sans-serif;color:#990000;font-size:15px;"><b>Please Note:</b> LSi will not progress any artwork, order stock or secure print schedules until payment is received.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Once we have received payment, a paid receipt will be emailed to confirm receipt.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;font-weight:bold;">If you have any queries regarding this or wish to make payment through an alternative method, please do not hesitate to contact myself or Accounts on 01274 854982.</p>';
    // Purchase Order
      $sPoBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Please find attached purchase order. Artwork will follow in due course.</p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;"><font color="#CC0000"><b>**Please deliver under LSi cover only**</b></font></p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;"><font color="#CC0000">**Please acknowledge our order at your earliest convenience.</font></p><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">Should you have any problems please do not hesitate to contact me.</p>';
    // Sample (Customer)
      $sSamplecustBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Please find attached acknowledgement of your sample request. These items will be delivered to you shortly.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">These samples are supplied on a 30 day \'Sale or Return\' basis.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">If you cannot make your decision within this period and you need more time, please contact us as soon as possible and we can arrange an extension.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Samples must be returned in good condition and within the initial or agreed extended loan period to avoid an invoice being issued. If any are returned which have been washed, worn or are in poor condition they will be considered as sold and an invoice will be issued.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Please return any items to us by recorded delivery as we cannot be held responsible for lost packages.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">N.B &ndash; All samples must be returned in their original packaging.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">We hope these samples are of interest and if we can be of any further assistance please do not hesitate to contact us on our details below.</p>';
    // Sample (Supplier)
      $sSamplesuppBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Please find attached a purchase order for a sample request to be sent out directly to our customer, the address can be found at the bottom of the attached purchase order along with the name of the contact. This order must be sent out under LSi cover only.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><font color="#FF0000"><b><u>Please note that if you do not state our purchase order number on your invoice this may delay payment.</u></b></font></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">If you have any problems please do not hesitate to contact me.</p>';
    // Supplier Artwork
      $sSupplierawkBody = '<p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Please find attached the artwork and order procedure for the above order.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51"><font color="#CC0000"><b>**Please confirm you have received all artwork correctly and acknowledge our order at your earliest convenience.**</b></font></p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Our artwork is sent in Illustrator format, colour separated and converted to layers, all fonts are converted to paths.</p><p style="font-family:calibri,arial,helvetica,sans-serif;font-size:14px;color:#595F51">Should you have any trouble opening any of the files attached please do not hesitate to contact me.</p>';
    // USB
      $sUsbBody = '<p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">It\'s definitely worth pointing out a few issues when it comes to USB memory sticks because this particular area of our market is very much a minefield:</p><ul><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">All our USB memory sticks come with a year warranty</li><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">All our USB chips are brand new promotion quality* chips NOT recycled memory &ndash; this is a growth area for some factories from China to cut costs.</li><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">All our chips are genuine chips NOT downgraded memory, if we sell you a 512MB chip then you get 512MB</li><li style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">If you would like an additional quote on retail grade chips, please let me know.</li></ul><p style="font-family:calibri,arial,sans-serif;color:#595F51;font-size:14px;">* Promotion quality chips are grade B chips.</p>';
    // Voucher
      $sVoucherBody = '<table width="600" cellspacing="0" cellpadding="0"><tbody><tr> <td width="600"><img width="600" height="156" alt="" src="http://www.lsi-gifts.co.uk/mail/img/voucher/voucher_01.jpg"></td></tr><tr> <td><table width="600" cellspacing="0" cellpadding="0"><tbody><tr> <td width="200"><img width="200" height="32" alt="" src="http://www.lsi-gifts.co.uk/mail/img/voucher/voucher_02.jpg"></td> <td width="200" align="center" style="font-family:calibri,arial,sans-serif;font-size:14px;font-weight:bold;">Code</td> <td width="200"><img width="200" height="32" alt="" src="http://www.lsi-gifts.co.uk/mail/img/voucher/voucher_04.jpg"></td></tr></tbody></table></td></tr><tr> <td width="600"><img width="600" height="16" alt="" src="http://www.lsi-gifts.co.uk/mail/img/voucher/voucher_05.jpg"></td></tr><tr> <td><table width="600" cellspacing="0" cellpadding="0"><tbody><tr> <td width="302"><img width="302" height="26" alt="" src="http://www.lsi-gifts.co.uk/mail/img/voucher/voucher_06.jpg"></td><td width="79" style="font-family:calibri,arial,sans-serif;font-size:11px;">Date</td> <td width="219"><img width="219" height="26" alt="" src="http://www.lsi-gifts.co.uk/mail/img/voucher/voucher_08.jpg"></td></tr></tbody></table></td></tr><tr> <td width="600"> <img width="600" height="32" alt="" src="http://www.lsi-gifts.co.uk/mail/img/voucher/voucher_09.jpg"></td></tr></tbody></table>';      

  // Generated Template: Standard
    $tStandard = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;    
  // Generated Template: Artwork Approval
    $tArtworkapproval = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sArtworkHi . $sArtworkBody . $sArtworkBye . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;    
  // Generated Template: Customer Invoice
    $tCustomerinv = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sCustomerinvBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;    
  // Generated Template: Order Acknowledgement
    $tOrderack = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sOrderackBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;          
  // Generated Template: Payment
    $tPayment = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sPaymentBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;            
  // Generated Template: Proforma Invoice
    $tProforma = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sProformaBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;          
  // Generated Template: Proforma Invoice
    $tPo = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sPoBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;                      
  // Generated Template: Sample (Customer)
    $tSamplecust = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sSamplecustBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;    
  // Generated Template: Sample (Supplier)
    $tSamplesupp = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sSamplesuppBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;  
  // Generated Template: Supplier Artwork
    $tSupplierawk = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sSupplierawkBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;
  // Generated Template: USB
    $tUsb = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sUsbBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;
  // Generated Template: Voucher
    $tVoucher = $uHtmlHead . $uStart . $pStandard . $uBodyHi . $sVoucherBody . $uBodyBye . $pName . $pJob . $pTel . $pMob . $uMainTel . $pEmail . $uFooter;   
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
    $t[#TMPTYPE#]Out = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - [#TMPTYPENICE#] (P).html';
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
    $tStandardOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Standard (P).html';
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
    $tArtworkapprovalOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Artwork Approval (P).html';
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
  
// If 'Customer Invoice' is selected...
  if(isset($tmp_customerinv)) {
    $tCustomerinvOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Customer Invoice (P).html';
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

// If 'Order Acknowledgement' is selected...
  if(isset($tmp_orderack)) {
    $tOrderackOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Order Acknowledgement (P).html';
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
    $tPaymentOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Payment (P).html';
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
    $tProformaOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Proforma Invoice (P).html';
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
    $tPoOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Purchase Order (P).html';
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
  
// If 'Sample (Customer)' is selected...
  if(isset($tmp_samplecust)) {
    $tSamplecustOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Sample (Customer) (P).html';
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
    $tSamplesuppOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Sample (Supplier) (P).html';
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
    $tSupplierawkOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Supplier Artwork (P).html';
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
    $tUsbOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - USB (P).html';
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
    $tVoucherOut = '../generated_tpl/' . strtoupper(substr($shortname, 0, 2)) . substr($shortname, 2) . ' - Voucher (P).html';
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