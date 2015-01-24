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
$query_rs_offices = "SELECT officeCode, city, phone, country, postalCode, territory FROM Offices  ORDER BY city";
$rs_offices = mysql_query($query_rs_offices, $classicmodels) or die(mysql_error());
$row_rs_offices = mysql_fetch_assoc($rs_offices);
$totalRows_rs_offices = mysql_num_rows($rs_offices);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Offices</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body id="offices">
<h1>Offices</h1>
<p>| <a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="offices.php" id="officesLink">Offices</a> | <a href="employees.php">Employees</a> | <a href="customers.php">Customers</a> | <a href="addcustomer.php">Add Customer</a> |</p>
<table width="50%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><strong>Office Code </strong></td>
    <td><strong>City</strong></td>
    <td><strong>Phone</strong></td>
    <td><strong>Country</strong></td>
    <td><strong>Postal Code</strong></td>
    <td><strong>Territory</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs_offices['officeCode']; ?></td>
      <td><?php echo $row_rs_offices['city']; ?></td>
      <td><?php echo $row_rs_offices['phone']; ?></td>
      <td><?php echo $row_rs_offices['country']; ?></td>
      <td><?php echo $row_rs_offices['postalCode']; ?></td>
      <td><?php echo $row_rs_offices['territory']; ?></td>
    </tr>
    <?php } while ($row_rs_offices = mysql_fetch_assoc($rs_offices)); ?>
</table>
<p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<div class="footer">&copy; International School of Kenya 2011, Akkshay Khoslaa</div>
<!-- #EndLibraryItem --></p>
</body>
</html>
<?php
mysql_free_result($rs_offices);
?>

