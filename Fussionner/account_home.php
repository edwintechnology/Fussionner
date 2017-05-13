<?php // account_home.php
include("connection.php");
session_start();
$username = $_SESSION["username"];
$password = $_SESSION["password"];

$mypass = md5($password);
$sql="SELECT * FROM users WHERE username = '$username' AND password='$mypass'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count == 1){
$result = mysql_query("SELECT firstname FROM users WHERE username='$username'");
list($name) = mysql_fetch_array($result);

echo <<<_END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"></link>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
	<script src="js/popup.js" type="text/javascript"></script>
	<script src="js/popupR.js" type="text/javascript"></script>
	<script src="js/popupP.js" type="text/javascript"></script>
	<script src="js/popupH.js" type="text/javascript"></script>
	<script src="js/popupShow.js" type="text/javascript"></script>
	<script src="js/popupListC.js" type="text/javascript"></script>
	<script src="js/popupListR.js" type="text/javascript"></script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
	<link rel="stylesheet" type"text/css" href="style/popup.css"></link>
	<link rel="stylesheet" type="text/css" href="style/main.css"></link>
	<style>
		body {
		    font-size: 62.5%;
		}
		label { 
			display:block; 
			color: #006537;
		}
		input.text { 
			margin-bottom:12px; width:95%; padding: .4em; 
		}
		fieldset { 
			padding:0; border:0; margin-top:25px; 
		}
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain { 
			width: 400px; margin: 20px 0; 
		}
		div#users-contain table { 
			margin: 1em 0; border-collapse: collapse; width: 125%; 
		}
		div#users-contain table td, div#users-contain table th { 
			border: 1px solid #eee; padding: .6em 10px; text-align: left; 
		}
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; color: red;}
	</style>
	
<script language="javascript" type="text/javascript">
var checked = "";
var limit = "";

function determineType(type)
{
	checked = type;
	if (type == "Checking")
	{
		document.getElementById("creditLimit").value = ""; // Clear any value previously entered
		// Hide the field
		document.getElementById("creditLimit").style.visibility = "Hidden"; 
		document.getElementById("creditLimitLabel").style.visibility = "Hidden";
		limit = "--";
	}
	else
	{
		// Make the field visible
		document.getElementById("creditLimit").style.visibility = ""; 
		document.getElementById("creditLimitLabel").style.visibility = "";
		limit = "0"; 
	}
};
function addAccount(account)
{
	$("#accounts").append("<a href='#'>"+account+"</a>"+
			"<div id='users-contain' class='ui-widget' style='font-size: 75.0%;'>"+
			"<table id='"+stripText(account)+"' class='ui-widget ui-widget-content'>"+
			"<thead><tr class='ui-widget-header '><th>Account Type</th>"+
			"<th>Balance</th><th>Credit Limit</th><th>Action</th>"+
			"</tr></thead><tbody><tr></tr></tbody></table></div>"
			);	

	
};
function fillAccount(a, t, b, l)
{

$( "#"+stripText(a)+" tbody" ).append( "<tr>" +
						"<td>" + t + "</td>" + 
						"<td>$ " + b + "</td>" +
						"<td>$ " + l + "</td>" + 
						"<td width='40px'>" +
						"<a href='#'>" + 
						"<img src='img/edit.png' width='40%' style='padding-right: 4px' alt='Edit' title='Edit' />"+	
						"</a> "+
						"<img src='img/delete.png' onclick='deleteAccount(\""+a+"\", \""+t+"\");' width='40%' "+
						"alt='Delete' title='Delete' style='cursor:pointer'/> </td>"+"</tr>" );
};
function deleteAccount(account, type)
{
	$.ajax({type: "POST",
		  url:  "deleteAccount.php", 
		  data: {accountName : account, accountType : type},
		  });
	
};
function fillTransactions(td, a, c, d)
{
	$( "#transactions tbody" ).append( "<tr>" +
						"<td>" + td + "</td>" + 
						"<td> " + a + "</td>" +
						"<td>$ " + c + "</td>" + 
						"<td> " + d + "</td>" + 
						"</tr>" );
};

//Removes spaces and makes text lower case (used when pulling account names from database)
function stripText(text)
{
	var string = text.toLowerCase();
	return string.split(' ').join('');
};

function loadAccounts(){

_END;

$result = mysql_query("SELECT * FROM myaccounts WHERE username='$username' GROUP BY accountname ASC");

while($row = mysql_fetch_array($result))
{
	echo "addAccount('" . $row['accountname'] . "');";
	echo "fillAccount('" . $row['accountname'] . "', '" . $row['type'] . "', '" . $row['balance'] . "', '" . $row['creditline'] . "');";
}
echo <<<_END

};

function loadTransactions(){

_END;

$count = 0;
$result = mysql_query("SELECT * FROM mytransactions WHERE username='$username' GROUP BY ID DESC");

while($row = mysql_fetch_array($result))
{
	if ($count == 5)
	{
		break;
	}
	echo "fillTransactions('" . $row['date'] . "', '" . $row['accountname'] . "', '" . $row['amount'] . "', '" . $row['description'] . "');";
	$count += 1;
}
echo <<<_END


};
</script>

<script>
$("select").change(function () {
    var str = "";
    $("select option:selected").each(function () {
          str += $(this).text() + " ";
        });
    $("div").text(str);
  })
  .trigger('change');
</script>
<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		var accountNumber = $( "#accountNumber"),
			accountName = $( "#accountName" ), 
			accountType = $( "#accountType" ),
			balance = $( "#balance" ),
			creditLimit = $( "#creditLimit" ),
			allFields = $( [] ).add ( accountNumber) .add( accountName ).add( accountType ).add( balance ).add( creditLimit ),
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 470,
			width: 250,
			modal: true,
			buttons: {
				"Add": function() {
					
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
					if (limit == "0" || limit == "")
					{
						limit = creditLimit.val();
						
					}
					if (checked == "")
					{
						alert("Please select an account type");
					}
					else if (accountNumber.val() == "")
					{
						alert("Please enter an account number");
						document.getElementById("accountNumber").focus();
					}
					else if (accountName.val() == "")
					{
						alert("Please enter an account name");
						document.getElementById("accountName").focus();
					}
					else if (balance.val() == "")
					{
						alert("Please enter a balance");
						document.getElementById("balance").focus();
					}
					
					else if (limit == "")
					{
						alert("Please enter a credit limit");
						document.getElementById("creditLimit").focus();
					}
					else{
						if (($('#'+stripText(accountName.val())).length == 0))
						{
							addAccount(accountName.val());
							fillAccount(accountName.val(), checked, balance.val(), limit);
							$.post('insertAccount.php', $('#myForm').serialize());
							$( this ).dialog( "close" );
						}
						else
						{
							alert("Account already exists!");
							document.getElementById("accountName").focus();
						}
					
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-account" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
	</script>
<title>Fussionner: Picture Your Finances</title>
</head>

<body onLoad="loadAccounts(); loadTransactions()">
<div id="content">
<div id="masthead">
	<img id="masthead-image" src="img/header.gif" alt="Fussionner: Picture Your Finances" />	
</div>

<div id="columns">

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size: 160%">
	<tr>
<!-- BEGIN SIDE MENU (LEFT COLUMN) -->
	<td valign="top" id="left-column">
	<div id="left-column-width">
	<div id="left-column-content">
	<table cellspacing="0" cellpadding="0" border="0" style="width: 180px; height: 200px;">
		<tr>
    	<td>
    		<div class="FormText" >
			<span style="font-weight: bold;">
   				WELCOME, $name
			</span>
			<div style="margin-top: 10px">
				Not you?<a href="signout.php"> Logout</a>
			</div>
			</div>
			<br /> <br /><br />
			<span style="color: #653700; text-decoration: underline;">View Account</span><br /><br />
			<div onclick="" id="photo" style="cursor:pointer">Upload Photo</div><br />
            
            <span class="FormText" style="font-weight:bold">Manually Edit Account</span><br />
            <div style="margin-top: 5px; margin-left: 20px">
            	<div onclick="" id="check" style="cursor:pointer; margin-top: 10px"> &#62; Insert a Check</div>
            	<div onclick="" id="receipt" style="cursor:pointer; margin-top: 10px">&#62; Insert a Receipt</div>
			<div onclick="" id="transaction" style="cursor:pointer; margin-top: 10px">&#62; Insert a Transaction</div><br />
            </div>
            
            <span class="FormText" style="font-weight:bold">View Photos </span><br />
            <div style="margin-top: 5px; margin-left: 20px">
            	<div onclick="" id="showfiles" style="cursor:pointer; margin-top: 10px">&#62; View All Photos</div>
            	<div onclick="" id="listChecks" style="cursor:pointer; margin-top: 10px">&#62; View Checks</div>
            	<div onclick="" id="listReceipts" style="cursor:pointer; margin-top: 10px">&#62; View Receipts</div><br />
            	
            </div>
			<div onclick="" id="help" style="cursor:pointer">Help</div> <br /><br />
            	<br />
        </td>
   		</tr>
	</table>
<div>&nbsp;</div>
</div>
</div>
</td>
<!-- END SIDE MENU (LEFT COLUMN) -->

<!-- BEGIN RIGHT SPACE - THIS IS WHERE FORM CONTENT SHOULD GO -->
<td valign="top" id="center-column">

<br />
<div class="header">
	<img src="img/clipboard.jpg" alt="" style="width: 40px; display: inline;"/>
	 Account Home
</div>
<br />
	<a name="main-content"></a>
	<div id="center-column-content">
	<div id="bodyCopy">
	<table id="rightTable">
<!-- PUT FORMS OR OTHER CONTENT TO BE DISPLAYED IN THE WHITE SPACE TO THE RIGHT HERE (IN THIS TABLE) -->
	    <tbody>
    	    <tr>
        	<td valign="top" align="left" rowspan="2">
        	
        <!--   This is used to make sure that the user wants to save any updates
        	   <form id="checkInForm"> 
        -->

			<div style="border: 1px solid black; width: 500px; padding: 20px;">
			<div id="accounts">
			
        	
        	<br />
			<!-- Pull these from the database -->
			
        	</div>
        	
        	<!-- Manually add another account -->
        	<center><button type="button" id="create-account" style="margin-top: 5px; margin-bottom: 10px;font-size: 62.5%;">Add Account</button></center>
        	<br />
        	
        	<!-- Pull these from the database -->
        	<span class="FormText">
        	Recent Transactions <br />
        	</span>
        	<div id="users-contain" class="ui-widget" style="font-size: 75.0%;color: black;">
			<table id="transactions" class="ui-widget ui-widget-content">
				<thead>
					<tr class="ui-widget-header ">
						<th>Date</th>
						<th>Account</th>
						<th>Charge</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					</tr>
				</tbody>
			</table>
			</div>
			<div style="font-size: 10px; margin-left: 90%">
			<a href="#"><div onclick="">more</div></a>
			|
			<a href="#" >less</a>
			</div>
<!--  </div>-->
        	</div>
        	<!--  
        	<center>
        	<button type="button" onclick="validateForm()" value="Save and check-in" >Save and check-in </button>
        	<button type="button" onclick="validateForm()" value="Save">Save </button>
        	<button type="button" onclick="show_cancelconfirmation()" value="Cancel" >Cancel</button>
        	</center>
        	</form>
        	-->
            </td>
        	</tr>
    	</tbody>
	</table>
<div>&nbsp;</div>
</div>
</div>
</td>
</tr>
</table>
<!-- END RIGHT COLUMN -->
<div class="clear"></div>
</div>

<div class="demo">

<div id="dialog-form" title="Add Account" style="font-size: 130%; text-align: left" >
	<p class="validateTips">*All form fields are required</p>
	<form id="myForm" name="myForm" action="" method="POST">
	<fieldset>
		<label for="accountType" id="accountTypeLabel">Account Type</label>
		<div style="margin-left: 30px" id="accountType">
			<input type="radio" name="accountType" value="Checking" style="display:inline;" onclick="determineType('Checking')"/>Checking/Savings<br />
			<input type="radio" name="accountType" value="Credit" style="display:inline;" onclick="determineType('Credit')"/>Credit Card <br />
		</div>
		
		<br />
		<label for="accountNumber" id="accountNumberLabel">Account Number</label>
		<input type="text" name="accountNumber" id="accountNumber" class="text ui-widget-content ui-corner-all" />


		<br />
		<label for="accountName" id="accountNameLabel">Account Name</label>
		<input type="text" name="accountName" id="accountName" class="text ui-widget-content ui-corner-all" />
		
		<!-- SQL here to check and make sure that the account name and type does not already exist -->
		
		<br />
		<label for="balance" id="balanceLabel">Account Balance</label>
		<input type="text" name="balance" id="balance" class="text ui-widget-content ui-corner-all" maxlength="10"/>
		
		<!-- Add if credit card is selected -->
		<br />
		<label for="creditLimit" id="creditLimitLabel" style="visibility: hidden"> Credit Limit  </label>
		<input type="text" name="creditLimit" id="creditLimit" class="text ui-widget-content ui-corner-all" maxlength="10" style="visibility: hidden" />
		
		
		
	</fieldset>
	</form>
</div>

</div><!-- End demo -->

<!-- END CONTENT -->

<div id="footer">
<div id="footer-content">
<div>&nbsp;</div>
	<div id="copyright" class="FormText">
		Copyright 2012 Fussionner Co. All Rights Reserved<br/> <br />
	</div>
</div>
</div>
</div>
_END;

echo "<!-- POP UP box -->";
/***************************************************************************************************************************************************************/
/***                                  Popup check 																										     ***/
/***************************************************************************************************************************************************************/ 
echo "<div class=\"popupCheck\">
        <a class=\"popupCheckClose\">x</a>
 <h1> Manually Insert Check </h1>
<form name=\"check\" action=\"insertCheck.php\" method=\"get\">
	<table id=\"tableCheck\" border=\"1\">
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Name:</td><td id=\"tdCheck\" colspan=\"2\"><input type=\"text\" name=\"name\" size=\"20\"></td>
	    <td id=\"tdCheck\" align=\"right\">Check No.: <input type=\"text\" name=\"check_num\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Address:</td><td  id=\"tdCheck\" colspan=\"2\"><input type=\"text\" name=\"address\"></td>
	    <td id=\"tdCheck\" align=\"right\">Date: <input type=\"text\" name=\"date\"></td></tr> <!-- may change to an option -->
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Pay to:</td><td  id=\"tdCheck\" colspan=\"2\"> <input type=\"text\" name=\"payInorderTo\" size=\"63\"></td>
	    <td id=\"tdCheck\" align=\"right\">Amount: <input type=\"text\" name=\"amount\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" colspan=\"4\"><input type=\"text\" size=\"115\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Memo:</td><td id=\"tdCheck\" colspan=\"2\"><input type=\"text\" name=\"memo\"></td>
	    <td align=\"right\" id=\"tdCheck\">Sign:<input type=\"text\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Routing:</td><td id=\"tdCheck\"> <input type=\"text\" name=\"routing\"></td>
	    <td id=\"tdCheck\">Account Number: <input type=\"text\" name=\"accountNumber\"</td>
	    <td align=\"right\" id=\"tdCheck\"><input type=\"submit\" name=\"submit\" id=\"button\"></td></tr>
	</table>
</form>
</div>  ";

/***************************************************************************************************************************************************************/
/***                                  Popup receipt 																										 ***/
/***************************************************************************************************************************************************************/ 
echo "<div class=\"popupReceipt\">
	<a class=\"popupReceiptClose\">X</a>
	<h1> Manually Insert Receipts </h1>
<form name=\"receipt\" action=\"insertReceipt.php\" method=\"get\">
	<table id=\"tableCheck\">
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Store Name:</td><td id=\"tdCheck\"><input type=\"text\" name=\"storeName\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Invoice Number:</td><td id=\"tdCheck\"><input type=\"text\" name=\"invoice\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item1:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item2:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item3:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item4:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Total Amount:</td><td id=\"tdCheck\"><input type=\"text\" name=\"amount\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Pay Method:</td><td id=\"tdCheck\"><input type=\"text\" name=\"payMethod\"></td></tr>
    <tr id=\"trCheck\"><td id=\"tdCheck\"></td><td id=\"tdCheck\"><input type=\"submit\" name=\"submit\" id=\"button\"></td><tr>
</table>
</form>
</div>";

/***************************************************************************************************************************************************************/
/***                                  Popup photo 																										     ***/
/***************************************************************************************************************************************************************/ 

echo "<div class=\"popupPhoto\">
	<a class=\"popupPhotoClose\">x</a>
	<h1>Upload a file</h1>
	<form enctype=\"multipart/form-data\" name=\"Upload\" action=\"grabfile.php\" method=\"post\">
	<table id=\"tableCheck\">
	<tr id=\"trCheck\"><td id=\"tdCheck\" colspan=\"2\"><p> Select a file to upload.</td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\"><p>File Description:</td><td><input type=\"text\" name=\"strDesc\" size=\"20\" maxlength=\"50\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\"><p>File Location:</td><td><input type=\"file\" name=\"fileUpload\" size=\"20\"></td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\"><input type=\"checkbox\" name=\"check\" value=\"check\" />Check</td>
	<td id=\"tdCheck\"><input type=\"checkbox\" name=\"receipt\" value=\"receipt\" />Receipt</td></tr>
	<tr id=\"trCheck\"><td id=\"tdCheck\"><input id=\"button\" type=\"submit\" value=\"Upload this file\" name=\"cmdSubmit\"></td></tr>
	</table>
	</form>
</div>";

/***************************************************************************************************************************************************************/
/***                                  Popup help  																										     ***/
/***************************************************************************************************************************************************************/ 
echo "<div class=\"popupHelp\">
    <a class=\"popupHelpClose\">x</a>
    <h1>Help</h1>
    <table id=\"tableCheck\">
		<tr><td style=\"float:left;\">&#62; Insert a Check</td></tr>
		<tr><td><div class=\"FormText\">Manually insert the information pertaining to a recent check.</div></td></tr>	
		<tr><td style=\"float:left;\">&#62; Insert a Receipt</td></tr>
		<tr><td><div class=\"FormText\">Manually insert the information pertaining to a recent receipt.</div></td></tr>
		<tr><td style=\"float:left;\">&#62; Insert a Transaction</td></tr>
		<tr><td><div class=\"FormText\">Manually insert the information pertaining to a recent transaction.</div></td></tr>
		<tr><td style=\"float:left;\">&#62; View All Photos</td></tr>
		<tr><td><div class=\"FormText\"> View all of the photos that you uploaded</div></td></tr>
		<tr><td style=\"float:left;\">&#62; View Checks</td></tr>
		<tr><td><div class=\"FormText\"> View all of the photos of the checks you uploaded</div></td></tr>
		<tr><td style=\"float:left;\">&#62; View Receipts </td></tr>
		<tr><td><div class=\"FormText\"> View all of the photos of the receipts you uploaded</div></td></tr>
		<tr><td><div class=\"FormText\">
		<br />
		<span style=\"font-weight:bold\">Disclaimer: </span> Fussionner is not responsible to ensure that the financial information on 
 			your account is as accurate, the account is solely intended for consolidating financial 
  			assets into one place, any other use is strictly prohibited. </div></td></tr></table>   
 </div>";

/***************************************************************************************************************************************************************/
/***                                  Popup showfile 																								         ***/
/***************************************************************************************************************************************************************/ 

$dbQuery = "SELECT id, img_name, img_type, img_size, img_data FROM myphotos ORDER BY id ASC";
$result = mysql_query($dbQuery) or die("Couldn't get file list");
$counter = 0;
echo "<div class=\"popupShowfiles\">
      <a class=\"popupShowfilesClose\">x</a>
      <h1> Photo Gallery </h1>";
echo "<table align=\"center\" id=\"tableCheck\"><tr id=\"trCheck\">";


while($row = mysql_fetch_array($result)){
	if($counter > 4){
		echo "</tr><tr id=\"trCheck\">";
		$counter = 0;
	}
	echo "<td id=\"tdCheck\"><img src=\"getPhoto.php?id=$row[id]\" width=\"150\" height=\"150\" /></td>";
	$counter = $counter+1;
}
echo "</tr></table> 
 </div>";
 
 /***************************************************************************************************************************************************************/
/***                                  Popup list checks         																						      ***/
/****************************************************************************************************************************************************************/ 

$result = mysql_query("SELECT name, check_number, date, amount, accountNumber FROM mychecks WHERE username='$username'");
echo "<div class=\"popupListChecks\">
      <a class=\"popupListChecksClose\">x</a>
	  <h1>Checking</h1>
	  <table id=\"tableCheck\" align=\"center\">
<tr><th>Name:</th><th>Date:</th><th>Amount:</th><th>Account Number</th><th>Check Number:</th></tr>";

while($row = mysql_fetch_array($result))
{
echo "<tr id=\"trCheck\">";
echo "<td id=\"tdCheck\">" . $row['name'] . "</td>";
echo "<td id=\"tdCheck\">" . $row['date'] . "</td>"; 
echo "<td id=\"tdCheck\">" . $row['amount'] . "</td>";
echo "<td id=\"tdCheck\">" . $row['accountNumber'] . "</td>";
echo "<td id=\"tdCheck\">" . $row['check_number'] . "</td>";
echo "</tr>";
}
echo "</table></div>";

/***************************************************************************************************************************************************************/
/***                                  Popup list receipts 																								     ***/
/***************************************************************************************************************************************************************/ 
echo "<div class=\"popupListReceipts\">
    <a class=\"popupListReceiptsClose\">x</a>";
$result = mysql_query("SELECT * FROM myreceipts WHERE username='$username'");
echo "<h1>Receipts</h1>";
echo "<table align=\"center\" id=\"tableCheck\">
	  <tr id=\"trCheck\">
		<th>Store Name:</th><th>Invoice Number:</th><th>Amount:</th><th>Pay Method</th>
	   </tr>";

while($row = mysql_fetch_array($result))
{
echo "<tr id=\"trCheck\">";
echo "<td id=\"tdCheck\">" . $row['storeName'] . "</td>";
echo "<td id=\"tdCheck\">" . $row['invoiceNum'] . "</td>"; 
echo "<td id=\"tdCheck\">" . $row['amount'] . "</td>";
echo "<td id=\"tdCheck\">" . $row['payMethod'] . "</td>";
echo "</tr>";
}
echo "</table></div>";
/***************************************************************************************************************************************************************/
/***                                  Background 																										     ***/
/***************************************************************************************************************************************************************/ 
echo "<div class=\"background\" onclick=\"\"></div>"; 

echo "</body>
</html>";

}
else{
	header("location: index.html");
}
?>

