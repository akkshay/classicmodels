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
if (isset($_GET['sort']))
	$sort = $_GET['sort'];
else
	$sort="customerName";
mysql_select_db($database_classicmodels, $classicmodels);
$query_rs_payments = "SELECT c.customerName, city, country, COUNT(*) AS 'Number of Payments' FROM Customers AS c INNER JOIN Payments AS p ON c.customerNumber=p.customerNumber WHERE customerName LIKE'M%'GROUP BY customerName ORDER BY " . $sort;
$rs_payments = mysql_query($query_rs_payments, $classicmodels) or die(mysql_error());
$row_rs_payments = mysql_fetch_assoc($rs_payments);
$totalRows_rs_payments = mysql_num_rows($rs_payments);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Count of Customer Payment</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>Count of Customer Payment (AKKSHAY KHOSLAA)</h1>
<p>| <a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="offices.php">Offices</a> | <a href="employees.php">Employees</a> | <a href="customers.php">Customers</a> | <a href="addcustomer.php">Add Customer</a> |</p>
<table width="50%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><a href="customer_payment_count.php?sort=customerName">Customers</a></td>
    <td><a href="?sort=city">City</a></td>
    <td><a href="?sort=country">Country</a></td>
    <td class="right" nowrap="nowrap">Number of Payments</td>
  </tr>
 <?php
  	$i = 0;
	$even="";
  	do {
	  if ($i % 2 == 0) $even = "class='even'"; else $even = "";
	?>
<tr <?php echo $even; ?>>
      <td><?php echo $row_rs_payments['customerName']; ?></td>
      <td><?php echo $row_rs_payments['city']; ?></td>
      <td><?php echo $row_rs_payments['country']; ?></td>
      <td class="right"><?php echo $row_rs_payments['Number of Payments']; ?></td>
    </tr>
 <?php 
	$i = $i + 1;
	} while ($row_rs_payments = mysql_fetch_assoc($rs_payments)); ?>
</table>
<p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<div class="footer">&copy; International School of Kenya 2011, Akkshay Khoslaa</div>
<!-- #EndLibraryItem --></p>
</body>
</html>
<?php
mysql_free_result($rs_payments);
?>
