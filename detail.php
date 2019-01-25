<?php require_once('Connections/cdb1.php'); ?>
<?php
$colname_rsdb1 = "-1";
if (isset($_GET['ID'])) {
  $colname_rsdb1 = (get_magic_quotes_gpc()) ? $_GET['ID'] : addslashes($_GET['ID']);
}
mysql_select_db($database_cdb1, $cdb1);
$query_rsdb1 = sprintf("SELECT * FROM db1 WHERE ID = %s ORDER BY ID ASC", $colname_rsdb1);
$rsdb1 = mysql_query($query_rsdb1, $cdb1) or die(mysql_error());
$row_rsdb1 = mysql_fetch_assoc($rsdb1);
$totalRows_rsdb1 = mysql_num_rows($rsdb1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
	<table width="508" border="1" align="center">
  <tr>
    <td width="92"><div align="center">ID</div></td>
    <td width="120"><div align="center">姓名</div></td>
    <td width="102"><div align="center">年齡</div></td>
    <td width="112"><div align="center">地址</div></td>
    <td width="21"><div align="center">更新</div></td>
    <td width="21"><div align="center">刪除</div></td>
  </tr>
  <tr>
    <td><div align="center"><?php echo $row_rsdb1['ID']; ?></div></td>
    <td><div align="center"><?php echo $row_rsdb1['Name']; ?></div></td>
    <td><div align="center"><?php echo $row_rsdb1['Old']; ?></div></td>
    <td><div align="center"><?php echo $row_rsdb1['Addr']; ?></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($rsdb1);
?>
