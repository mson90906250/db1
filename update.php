<?php require_once('Connections/cdb1.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE db1 SET Name=%s, `Old`=%s, Addr=%s WHERE ID=%s",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Old'], "int"),
                       GetSQLValueString($_POST['Addr'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_cdb1, $cdb1);
  $Result1 = mysql_query($updateSQL, $cdb1) or die(mysql_error());

  $updateGoTo = "detail.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['ID'] : addslashes($_GET['ID']);
}
mysql_select_db($database_cdb1, $cdb1);
$query_Recordset1 = sprintf("SELECT * FROM db1 WHERE ID = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $cdb1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table border="1" align="center">
  <tr>
    <td>ID</td>
    <td><label>
      <input name="ID" type="text" id="ID" value="<?php echo $row_Recordset1['ID']; ?>" readonly="true" />
    </label></td>
  </tr>
  <tr>
    <td>姓名</td>
    <td><input name="Name" type="text" id="Name" value="<?php echo $row_Recordset1['Name']; ?>" /></td>
  </tr>
  <tr>
    <td>年齡</td>
    <td><input name="Old" type="text" value="<?php echo $row_Recordset1['Old']; ?>" /></td>
  </tr>
  <tr>
    <td>居住地</td>
    <td><input name="Addr" type="text" value="<?php echo $row_Recordset1['Addr']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <div align="center">
        <input type="submit" name="Submit" value="送出" />
        </div>
    </label></td>
    </tr>
</table>

  <input type="hidden" name="MM_update" value="form1">
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
