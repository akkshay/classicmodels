<?php require_once('Connections/classicmodels.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_classicmodels, $classicmodels);
$query_Recordset1 = "SELECT productLine FROM ProductLines  ORDER BY productLine";
$Recordset1 = mysql_query($query_Recordset1, $classicmodels) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Home</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body id="index">
<h1>Home</h1>
<p>| <a href="index.php" id="indexLink">Home</a> | <a href="products.php">Products</a> | <a href="offices.php">Offices</a> | <a href="employees.php">Employees</a> | <a href="customers.php">Customers</a> | <a href="addcustomer.php">Add Customer</a> |</p>
<table width="716" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="108"><strong>Product Lines</strong></td>
    <td width="600">&nbsp;</td>
  </tr>
  <tr>
    <td>Classic Cars</td>
    <td><img src="images/classiccar.jpg" width="600" height="300" alt="cannot display image" /></td>
  </tr>
  <tr>
    <td>Motorcycles</td>
    <td><img src="images/motorcycle.jpg" width="600" height="300" alt="cannot display image" /></td>
  </tr>
  <tr>
    <td>Planes</td>
    <td><img src="images/plane.jpg" width="600" height="300" alt="cannot display image" /></td>
  </tr>
  <tr>
    <td>Ships</td>
    <td><img src="images/ship.jpg" width="600" height="300" alt="cannot display image" /></td>
  </tr>
  <tr>
    <td>Trains</td>
    <td><img src="images/train.jpg" width="600" height="300" alt="cannot display image" /></td>
  </tr>
  <tr>
    <td>Trucks and Buses</td>
    <td><img src="images/truck.jpg" width="600" height="300" alt="cannot display image" /></td>
  </tr>
  <tr>
    <td>Vintage Cars</td>
    <td><img src="images/vintagecar.jpg" width="600" height="300" alt="cannot display image" /></td>
  </tr>
</table>
<p>&nbsp;</p>
<p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<div class="footer">&copy; International School of Kenya 2011, Akkshay Khoslaa</div>
<!-- #EndLibraryItem --></p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
