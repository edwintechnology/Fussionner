<?php
// GrabFile.php: Takes the details
// of the new file posted as part
// of the form and adds it to the
// myBlobs table of our myFiles DB.
include("connection.php");

global $strDesc;
global $fileUpload;
global $fileName;
global $fileSize;
global $fileType;
global $tmpName;

echo $HTTP_GET_VARS["myName"];
echo $HTTP_POST_VARS["myName"];

if($fileUpload == "none")
die("You must enter a file");

$fileName = $_FILES[fileUpload][name]; // image file name
$tmpName  = $_FILES[fileUpload][tmp_name]; // name of the temporary stored file name
$fileSize = $_FILES[fileUpload][size]; // size of the uploaded file
$fileType = $_FILES[fileUpload][type]; // file type

$fileHandle = fopen($tmpName, "r");
$fileContent = fread($fileHandle, $fileSize);
$fileContent = addslashes($fileContent);
fclose($fileHandle);

$dbQuery = "INSERT INTO myphotos (img_name, img_type, img_size, img_data) VALUES ('$fileName', '$fileType', '$fileSize', '$fileContent')";
mysql_query($dbQuery) or die("Couldn't add file to database" . mysql_error());

if (isset($_POST['check'])) {
    header("location: checkIO.php");
} 
else if(isset($_POST['receipt'])){
	// do something
	header("location: receiptIO.php");
}
else{
 header("location: account_home.php");	
}

?>