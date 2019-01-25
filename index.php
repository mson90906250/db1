<?php require_once('Connections/cdb1.php'); ?>
<?php
mysql_select_db($database_cdb1, $cdb1);
$query_rsdb1 = "SELECT * FROM db1 ORDER BY ID ASC";
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
	<table width="500" border="1" align="center">
  <tr>
    <td width="161"><div align="center">姓名</div></td>
    <td width="125"><div align="center">年齡</div></td>
    <td width="250"><div align="center">
      <p>地址</p>
      </div></td>
  </tr>
  <tr>
    <td><div align="center"><?php echo $row_rsdb1['Name']; ?></div></td>
    <td><div align="center"><?php echo $row_rsdb1['Old']; ?></div></td>
    <td><div align="center"><?php echo $row_rsdb1['Addr']; ?></div></td>
  </tr>
</table>
<table width="500" border="1" align="center">
  <tr>
    <td><div align="center">
      <form id="form1" name="form1" method="post" action="">
        <label>
          <input type="submit" name="Submit" value="第一頁" />
          </label>
      </form>
      </div></td>
    <td><div align="center">
      <form id="form2" name="form2" method="post" action="">
        <label>
          <input type="submit" name="Submit2" value="上一頁" />
          </label>
      </form>
      
      </div></td>
    <td><div align="center">
      <form id="form3" name="form3" method="post" action="">
        <label>
          <input type="submit" name="Submit3" value="下一頁" />
          </label>
      </form>
      </div></td>
    <td><div align="center">
      <form id="form4" name="form4" method="post" action="">
        <label>
          <input type="submit" name="Submit4" value="最後一頁" />
          </label>
      </form>
      </div></td>
  </tr>
</table>


</body>
</html>
<?php
mysql_free_result($rsdb1);
?>
