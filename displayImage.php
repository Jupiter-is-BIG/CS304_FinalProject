<?php
header("Content-Type: image/jpeg");

$id = $_GET['id'];
   
if ($id == null)
    return;

include 'include/db_credentials.php';

$con = mysqli_connect($connectionInfo["HOST"],$connectionInfo["UID"],$connectionInfo["PWD"]);
if(!$con) die("Database connection failed: " . mysqli_error());

$db_select = mysqli_select_db($con, $connectionInfo["Database"]);
if(!$db_select) die("Database selection failed: " . mysqli_error());



// TODO: Modify SQL to retrieve productImage given productId
$sql = "Select productImage from product where productId = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$rst = mysqli_fetch_assoc($result);

if ($rst) 
{
    echo $rst['productImage'];
}
                    

mysqli_close($con);

?>
