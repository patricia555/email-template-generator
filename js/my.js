$(document).ready(function(){

  // Get info
  $.ajaxSetup({
    cache: false
  });
  var ajax_load = "Loading...";
  
  var loadUrl = "ajax/peopleinfo.php";
  $('.index #name').change(function(){
    $('#personinfo').html(ajax_load).load(loadUrl, 'name=' + $(this).val());
  });
  
  // Edit & update button
  $('.edit a').click(function(){
    $(this).parents('tr').children('td:not(.edit)').each(function(){
      $(this).html('<input type="text" value="' + $(this).text() + '">');
    });
    $(this).parents('td').html('<input type="submit" value="Update">');
  });
  
  // Packs
  $('input[name="pack"]').change(function(){
    if($('#pack-standard').is(':checked')) {
      $('input[type="checkbox"]').attr("checked",false);
      $('#tmp-standard').attr("checked",true);
    }
    if($('#pack-salesexec').is(':checked')) {
      $('input[type="checkbox"]').attr("checked",false);
      $('#tmp-newacct, #tmp-standard, #tmp-usb').attr("checked",true);
    }
    if($('#pack-salessupp').is(':checked')) {
      $('input[type="checkbox"]').attr("checked",false);
      $('#tmp-newacct, #tmp-standard, #tmp-samplecust, #tmp-samplesupp, #tmp-usb').attr("checked",true);
    }
    if($('#pack-salesasst').is(':checked')) {
      $('input[type="checkbox"]').attr("checked",false);
      $('#tmp-newacct, #tmp-quote, #tmp-standard, #tmp-samplecust, #tmp-samplesupp, #tmp-usb').attr("checked",true);
    }
    if($('#pack-adminmgr').is(':checked')) {
      $('input[type="checkbox"]').attr("checked",false);
      //$('#tmp-standard, #tmp-artworkapproval, #tmp-artworkrequest, #tmp-customerinv, #tmp-orderack, #tmp-payment, #tmp-proforma, #tmp-po, #tmp-supplierawk, #tmp-voucher').attr("checked",true);
      $('#tmp-standard, #tmp-artworkapproval, #tmp-artworkrequest, #tmp-customerinv, #tmp-orderack, #tmp-payment, #tmp-penwarehouse, #tmp-proforma, #tmp-voucher').attr("checked",true); // #tmp-po, #tmp-supplierawk remmed at BH's request, 26/06/2015
    }
    if($('#pack-admin').is(':checked')) {
      $('input[type="checkbox"]').attr("checked",false);
      //$('#tmp-standard, #tmp-artworkapproval, #tmp-customerinv, #tmp-orderack, #tmp-proforma, #tmp-po, #tmp-supplierawk').attr("checked",true);
      $('#tmp-standard, #tmp-artworkapproval, #tmp-customerinv, #tmp-orderack, #tmp-penwarehouse, #tmp-proforma').attr("checked",true); // #tmp-po, #tmp-supplierawk remmed at BH's request, 26/06/2015
    }
    if($('#pack-artwork').is(':checked')) {
      $('input[type="checkbox"]').attr("checked",false);
      $('#tmp-standard, #tmp-artworkrequest').attr("checked",true);
    }
  });
  
  $('#peopleupdate table').dataTable();
  
  $('.generate p:contains("Success!")').prepend("<span style='display: inline-block;background:#FFF;border-radius:10px; height: 20px; width: 20px; line-height: 20px; text-align: center; color:#3C3; box-shadow: 0 1px 1px rgba(0,0,0,0.2)'>&#x2713;</span>&nbsp;&nbsp;");

});