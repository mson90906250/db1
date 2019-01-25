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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO db1 (Name, `Old`, Addr) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Old'], "int"),
                       GetSQLValueString($_POST['Addr'], "text"));

  mysql_select_db($database_cdb1, $cdb1);
  $Result1 = mysql_query($insertSQL, $cdb1) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
	<form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
		<table width="500" border="1" align="center">
  <tr>
    <td>姓名</td>
    <td><label>
      <input name="Name" type="text" id="Name" />
    </label></td>
  </tr>
  <tr>
    <td>年齡</td>
    <td><label>
      <input name="Old" type="text" id="Old" />
    </label></td>
  </tr>
  <tr>
    <td>住址</td>
    <td><label>
      <input name="Addr" type="text" id="Addr" />
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <div align="center">
        <input type="submit" name="Submit" value="送出" />
      </div>
      </label></td>
    </tr>
</table>

	    <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>
