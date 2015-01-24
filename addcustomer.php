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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO Customers (customerName, contactLastName, contactFirstName, phone, city, postalCode, country, salesRepEmployeeNumber, creditLimit) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['customerName'], "text"),
                       GetSQLValueString($_POST['contactLastName'], "text"),
                       GetSQLValueString($_POST['contactFirstName'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['postalCode'], "text"),
                       GetSQLValueString($_POST['lstcountry'], "text"),
                       GetSQLValueString($_POST['salesRepEmployeeNumber'], "int"),
                       GetSQLValueString($_POST['creditLimit'], "double"));
echo "SQLstring: " . $insertSQL;
  mysql_select_db($database_classicmodels, $classicmodels);
  $Result1 = mysql_query($insertSQL, $classicmodels) or die(mysql_error());
}

mysql_select_db($database_classicmodels, $classicmodels);
$query_rs_country = "SELECT * FROM countries";
$rs_country = mysql_query($query_rs_country, $classicmodels) or die(mysql_error());
$row_rs_country = mysql_fetch_assoc($rs_country);
$totalRows_rs_country = mysql_num_rows($rs_country);

mysql_select_db($database_classicmodels, $classicmodels);
$query_rs_addcustomer = "SELECT * FROM Customers";
$rs_addcustomer = mysql_query($query_rs_addcustomer, $classicmodels) or die(mysql_error());
$row_rs_addcustomer = mysql_fetch_assoc($rs_addcustomer);
$totalRows_rs_addcustomer = mysql_num_rows($rs_addcustomer);

mysql_select_db($database_classicmodels, $classicmodels);
$query_salesrep_rs = "SELECT c.salesRepEmployeeNumber, customerNumber, customerName, contactLastName, contactFirstName, phone, city, postalCode, country, creditLimit, lastName FROM Customers AS c INNER JOIN Employees AS e ON c.salesRepEmployeeNumber = e.employeeNumber";
$salesrep_rs = mysql_query($query_salesrep_rs, $classicmodels) or die(mysql_error());
$row_salesrep_rs = mysql_fetch_assoc($salesrep_rs);
$totalRows_salesrep_rs = mysql_num_rows($salesrep_rs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add Customer</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body id="addcustomer">
<h1>Add Customer</h1>
<p>| <a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="offices.php">Offices</a> | <a href="employees.php">Employees</a> | <a href="customers.php">Customers</a> | <a href="addcustomer.php" id="addcustomerLink">Add Customer</a> |</p>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="50%" border="1" cellspacing="0" cellpadding="2">
    <tr>
      <td>Customer Name:</td>
      <td><label for="customerName"></label>
      <input name="customerName" type="text" id="customerName" /></td>
    </tr>
    <tr>
      <td>Contact Last Name:</td>
      <td><label for="contactLastName"></label>
      <input name="contactLastName" type="text" id="contactLastName" /></td>
    </tr>
    <tr>
      <td>Contact First Name:</td>
      <td><label for="contactFirstName"></label>
      <input name="contactFirstName" type="text" id="contactFirstName" /></td>
    </tr>
    <tr>
      <td>Phone:</td>
      <td><label for="phone"></label>
      <input name="phone" type="text" id="phone" /></td>
    </tr>
    <tr>
      <td>City:</td>
      <td><label for="city"></label>
      <input name="city" type="text" id="city" /></td>
    </tr>
    <tr>
      <td>Postal Code:</td>
      <td><label for="postalCode"></label>
      <input name="postalCode" type="text" id="postalCode" /></td>
    </tr>
    <tr>
      <td>Country:</td>
      <td><label for="lstcountry"></label>
        <select name="lstcountry" id="lstcountry" title="<?php echo $row_rs_country['Country']; ?>">
          <option value="""">Select:</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rs_country['Country']?>"><?php echo $row_rs_country['Country']?></option>
          <?php
} while ($row_rs_country = mysql_fetch_assoc($rs_country));
  $rows = mysql_num_rows($rs_country);
  if($rows > 0) {
      mysql_data_seek($rs_country, 0);
	  $row_rs_country = mysql_fetch_assoc($rs_country);
  }
?>
        </select></td>
    </tr>
    <tr>
      <td>Sales Rep Last Name</td>
      <td><label for="salesRepEmployeeNumber"></label>
        <select name="salesRepEmployeeNumber" id="salesRepEmployeeNumber">
          <option value="""">Select:</option>
          <?php
do {  
?>
          <option value="<?php echo $row_salesrep_rs['salesRepEmployeeNumber']?>"><?php echo $row_salesrep_rs['contactLastName']?>, <?php echo $row_salesrep_rs['contactFirstName']?></option>
          <?php
} while ($row_salesrep_rs = mysql_fetch_assoc($salesrep_rs));
  $rows = mysql_num_rows($salesrep_rs);
  if($rows > 0) {
      mysql_data_seek($salesrep_rs, 0);
	  $row_salesrep_rs = mysql_fetch_assoc($salesrep_rs);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Credit Limit</td>
      <td><label for="creditLimit"></label>
      <input name="creditLimit" type="text" id="creditLimit" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="buttonSubmit" id="buttonSubmit" value="Submit"  /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<div class="footer">&copy; International School of Kenya 2011, Akkshay Khoslaa</div>
<!-- #EndLibraryItem --></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_country);

mysql_free_result($rs_addcustomer);

mysql_free_result($salesrep_rs);
?>
