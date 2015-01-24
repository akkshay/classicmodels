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
	$sort="productName";
mysql_select_db($database_classicmodels, $classicmodels);
$query_rs_products = "SELECT productName, productLine, productCode, productScale, productDescription, quantityInStock, MSRP FROM Products ORDER BY " . $sort;
$rs_products = mysql_query($query_rs_products, $classicmodels) or die(mysql_error());
$row_rs_products = mysql_fetch_assoc($rs_products);
$totalRows_rs_products = mysql_num_rows($rs_products);

mysql_select_db($database_classicmodels, $classicmodels);
$query_rs_productLine = "SELECT productLine FROM Products " . $sort;
$rs_productLine = mysql_query($query_rs_productLine, $classicmodels) or die(mysql_error());
$row_rs_productLine = mysql_fetch_assoc($rs_productLine);
$totalRows_rs_productLine = mysql_num_rows($rs_productLine);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Products</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body id="products">
<h1>Products</h1>
<p>| <a href="index.php">Home</a> | <a href="products.php" id="productsLink">Products</a> | <a href="offices.php">Offices</a> | <a href="employees.php">Employees</a> | <a href="customers.php">Customers</a> | <a href="addcustomer.php">Add Customer</a> |</p>
<table width="574" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="292"><strong><a href="products.php?sort=productName">Product Name</a></strong></td>
    <td width="274"><strong><a href="?sort=productLine">Product Line</a></strong></td>
    <td width="274"><strong><a href="?sort=productCode">Product Code</a></strong></td>
    <td width="274"><strong><a href="?sort=productScale">Product Scale</a></strong></td>
    <td width="274"><strong><a href="?sort=productDescription">Product Description</a></strong></td>
    <td width="274"><strong><a href="?sort=quantityInStock">Quantity in Stock</a></strong></td>
    <td width="274"><strong><a href="?sort=MSRP">MSRP</a></strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs_products['productName']; ?></td>
      <td><?php echo $row_rs_products['productLine']; ?></td>
      <td><?php echo $row_rs_products['productCode']; ?></td>
      <td><?php echo $row_rs_products['productScale']; ?></td>
      <td><?php echo $row_rs_products['productDescription']; ?></td>
      <td><?php echo $row_rs_products['quantityInStock']; ?></td>
      <td><?php echo $row_rs_products['MSRP']; ?></td>
    </tr>
    <?php } while ($row_rs_products = mysql_fetch_assoc($rs_products)); ?>
</table>
<p>
<p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<div class="footer">&copy; International School of Kenya 2011, Akkshay Khoslaa</div>
<!-- #EndLibraryItem --></p>
</body>
</html>
<?php
mysql_free_result($rs_products);

mysql_free_result($rs_productLine);
?>
