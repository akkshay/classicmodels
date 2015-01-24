<?php require_once('Connections/classicmodels.php'); ?>
<?php
//delete survey entry using ID nuber in query string
if (isset ($_GET['delete'])) {
		if (isset($_GET['ID'])) {
			$ID = $_GET ['ID'];
			$strSQL = "DELETE FROM Customers WHERE customerNumber = " . $ID;
echo $strSQL . "<BR>";
			mysql_query($strSQL, $classicmodels) or die(mysql_error());
			//header(sprintf("location: %s", "survey_results.php"));
		}
}
?>
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
$query_rs_customers = "SELECT c.salesRepEmployeeNumber, customerNumber, customerName, contactLastName, contactFirstName, phone, city, postalCode, country, creditLimit, lastName FROM Customers AS c INNER JOIN Employees AS e ON c.salesRepEmployeeNumber = e.employeeNumber ORDER BY " . $sort;
$rs_customers = mysql_query($query_rs_customers, $classicmodels) or die(mysql_error());
$row_rs_customers = mysql_fetch_assoc($rs_customers);
$totalRows_rs_customers = mysql_num_rows($rs_customers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Customers</title>
<script>
function deleteRecord(customerName, customerNumber) {
	var response = confirm("Do you want to delete the record for " + customerName + "?");
	if (response) {
		window.location.href = "customers.php?sort=<?php echo $sort; ?>&delete=y&ID=" + customerNumber;
	} else {
		return false;
	}
}
</script>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body id="customers">
<h1>Customers</h1>
<p>| <a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="offices.php">Offices</a> | <a href="employees.php">Employees</a> | <a href="customers.php" id="customersLink">Customers</a> | <a href="addcustomer.php">Add Customer</a> |</p>
<table width="50%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><a href="?sort=customerNumber">Customer Number</a></td>
    <td><a href="customers.php?sort=customerName">Customer Name</a></td>
    <td><a href="?sort=contactLastName">Contact Last Name</a></td>
    <td><a href="?sort=contactFirstName">Contact First Name</a></td>
    <td><a href="?sort=phone">Phone</a></td>
    <td><a href="?sort=city">City</a></td>
    <td><a href="?sort=postalCode">Postal Code</a></td>
    <td><a href="?sort=country">Country</a></td>
    <td><a href="?sort=salesRepEmployeeNumber">Sales Rep Last Name</a></td>
    <td><a href="?sort=creditLimit">Credit Limit</a></td>
  </tr>
  <?php
  	$i = 0;
  	do {
	  if ($i % 2 == 0) $even = "class='even'"; else $even = ""; 
	?>
    <tr <?php echo $even ; ?>>
      <td><?php echo $row_rs_customers['customerNumber']; ?></td>
      <td><?php echo $row_rs_customers['customerName']; ?></td>
      <td><?php echo $row_rs_customers['contactLastName']; ?></td>
      <td><?php echo $row_rs_customers['contactFirstName']; ?></td>
      <td><?php echo $row_rs_customers['phone']; ?></td>
      <td><?php echo $row_rs_customers['city']; ?></td>
      <td><?php echo $row_rs_customers['postalCode']; ?></td>
      <td><?php echo $row_rs_customers['country']; ?></td>
      <td><?php echo $row_rs_customers['lastName']; ?></td>
      <td><?php echo $row_rs_customers['country']; ?></td>
      <td><a href="#" onclick="deleteRecord( '<?php echo $row_rs_customers['customerName']; ?>',<?php echo $row_rs_customers['customerNumber']; ?>)">Delete</a></td>
    </tr>
    <?php 
	$i = $i + 1;
	} while ($row_rs_customers = mysql_fetch_assoc($rs_customers)); ?>
</table>
<p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<div class="footer">&copy; International School of Kenya 2011, Akkshay Khoslaa</div>
<!-- #EndLibraryItem --></p>
</body>
</html>
<?php
mysql_free_result($rs_customers);
?>
