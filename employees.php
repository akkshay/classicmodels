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
$query_rs_employees = "SELECT e.officeCode, employeeNumber, lastName, firstName, extension, email, city, jobTitle FROM Employees AS e INNER JOIN Offices as z ON e.officeCode = z.officeCode  ";
$rs_employees = mysql_query($query_rs_employees, $classicmodels) or die(mysql_error());
$row_rs_employees = mysql_fetch_assoc($rs_employees);
$totalRows_rs_employees = mysql_num_rows($rs_employees);mysql_select_db($database_classicmodels, $classicmodels);
$query_rs_employees = "SELECT e.officeCode, employeeNumber, lastName, firstName, extension, email, city, jobTitle FROM Employees AS e INNER JOIN Offices as z ON e.officeCode = z.officeCode  ";
$rs_employees = mysql_query($query_rs_employees, $classicmodels) or die(mysql_error());
$row_rs_employees = mysql_fetch_assoc($rs_employees);
$totalRows_rs_employees = mysql_num_rows($rs_employees);
$query_rs_employees = "SELECT e.officeCode, employeeNumber, lastName, firstName, extension, email, city, jobTitle FROM Employees AS e INNER JOIN Offices as z ON e.officeCode = z.officeCode  ";
$rs_employees = mysql_query($query_rs_employees, $classicmodels) or die(mysql_error());
$row_rs_employees = mysql_fetch_assoc($rs_employees);
$totalRows_rs_employees = mysql_num_rows($rs_employees);
$query_rs_employees = "SELECT e.officeCode, employeeNumber, lastName, firstName, extension, email, city, jobTitle FROM Employees AS e INNER JOIN Offices as z ON e.officeCode = z.officeCode   ORDER BY firstName";
$rs_employees = mysql_query($query_rs_employees, $classicmodels) or die(mysql_error());
$row_rs_employees = mysql_fetch_assoc($rs_employees);
$totalRows_rs_employees = mysql_num_rows($rs_employees);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Employees</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body id="employees">
<h1>Employees</h1>
<p>| <a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="offices.php">Offices</a> | <a href="employees.php" id="employeesLink">Employees</a> | <a href="customers.php">Customers</a> | <a href="addcustomer.php">Add Customer</a> |</p>
<table width="50%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>Employee Number</td>
    <td>Last Name</td>
    <td>First Name</td>
    <td>Extension</td>
    <td>Email</td>
    <td>City</td>
    <td>Job Title </td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs_employees['employeeNumber']; ?></td>
      <td><?php echo $row_rs_employees['lastName']; ?></td>
      <td><?php echo $row_rs_employees['firstName']; ?></td>
      <td><?php echo $row_rs_employees['extension']; ?></td>
      <td><?php echo $row_rs_employees['email']; ?></td>
      <td><?php echo $row_rs_employees['city']; ?></td>
      <td><?php echo $row_rs_employees['jobTitle']; ?></td>
    </tr>
    <?php } while ($row_rs_employees = mysql_fetch_assoc($rs_employees)); ?>
</table>
<p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<div class="footer">&copy; International School of Kenya 2011, Akkshay Khoslaa</div>
<!-- #EndLibraryItem --></p>
</body>
</html>
<?php
mysql_free_result($rs_employees);
?>
