<?php require_once('Connections/cdb1.php'); ?>
<?php
$maxRows_rsdb1 = 3;//限制每一頁顯示幾筆資料
$pageNum_rsdb1 = 0;//預設開始頁面為零
if (isset($_GET['pageNum_rsdb1'])) {
  $pageNum_rsdb1 = $_GET['pageNum_rsdb1'];
}
$startRow_rsdb1 = $pageNum_rsdb1 * $maxRows_rsdb1;//設定每頁的第一筆資料從多少開始(ex 第零頁 第零筆;第一頁 第三筆)

mysql_select_db($database_cdb1, $cdb1);
//sql語法
$query_rsdb1 = "SELECT * FROM db1 ORDER BY ID ASC";
$query_limit_rsdb1 = sprintf("%s LIMIT %d, %d", $query_rsdb1, $startRow_rsdb1, $maxRows_rsdb1);
//執行sql語法
$rsdb1 = mysql_query($query_limit_rsdb1, $cdb1) or die(mysql_error());

$row_rsdb1 = mysql_fetch_assoc($rsdb1);

if (isset($_GET['totalRows_rsdb1'])) {
  $totalRows_rsdb1 = $_GET['totalRows_rsdb1'];
} else {
  $all_rsdb1 = mysql_query($query_rsdb1);
  $totalRows_rsdb1 = mysql_num_rows($all_rsdb1);
}
$totalPages_rsdb1 = ceil($totalRows_rsdb1/$maxRows_rsdb1)-1;
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
  
    <?php do { ?>
	<tr>
      <td><div align="center"><?php echo $row_rsdb1['Name']; ?></div></td>
      <td><div align="center"><?php echo $row_rsdb1['Old']; ?></div></td>
      <td><div align="center"><?php echo $row_rsdb1['Addr']; ?></div></td>
    </tr> <?php } while ($row_rsdb1 = mysql_fetch_assoc($rsdb1)); ?>
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
