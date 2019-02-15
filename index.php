<?php require_once('Connections/cdb1.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsdb1 = 10;
$pageNum_rsdb1 = 0;
if (isset($_GET['pageNum_rsdb1'])) {
  $pageNum_rsdb1 = $_GET['pageNum_rsdb1'];
}
$startRow_rsdb1 = $pageNum_rsdb1 * $maxRows_rsdb1;

mysql_select_db($database_cdb1, $cdb1);
$query_rsdb1 = "SELECT * FROM db1 ORDER BY ID ASC";
$query_limit_rsdb1 = sprintf("%s LIMIT %d, %d", $query_rsdb1, $startRow_rsdb1, $maxRows_rsdb1);
$rsdb1 = mysql_query($query_limit_rsdb1, $cdb1) or die(mysql_error());
$row_rsdb1 = mysql_fetch_assoc($rsdb1);

if (isset($_GET['totalRows_rsdb1'])) {
  $totalRows_rsdb1 = $_GET['totalRows_rsdb1'];
} else {
  $all_rsdb1 = mysql_query($query_rsdb1);
  $totalRows_rsdb1 = mysql_num_rows($all_rsdb1);
}

//ceil(x) 函数 回傳一個>=x的float值
$totalPages_rsdb1 = ceil($totalRows_rsdb1/$maxRows_rsdb1)-1;

$queryString_rsdb1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsdb1") == false && 
        stristr($param, "totalRows_rsdb1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsdb1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsdb1 = sprintf("&totalRows_rsdb1=%d%s", $totalRows_rsdb1, $queryString_rsdb1);

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
      <td><div align="center"><a href="detail.php?ID=<?php echo $row_rsdb1['ID']; ?>"><?php echo $row_rsdb1['Name']; ?></a></div></td>
      <td><div align="center"><?php echo $row_rsdb1['Old']; ?></div></td>
      <td><div align="center"><?php echo $row_rsdb1['Addr']; ?></div></td>
    </tr> <?php } while ($row_rsdb1 = mysql_fetch_assoc($rsdb1)); ?>
</table>
    <table width="500" border="1" align="center">
      <tr bordercolor="#F0F0F0">
        <td width="111"><div align="center">
            <?php if ($pageNum_rsdb1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsdb1=%d%s", $currentPage, 0, $queryString_rsdb1); ?>">第一頁</a>
            <?php } // Show if not first page ?>
        </div></td>
        <td width="111"><div align="center">
            <?php if ($pageNum_rsdb1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsdb1=%d%s", $currentPage, max(0, $pageNum_rsdb1 - 1), $queryString_rsdb1); ?>">上一頁</a>
            <?php } // Show if not first page ?>
        </div></td>
        <td width="103"><?php if ($pageNum_rsdb1 < $totalPages_rsdb1) { // Show if not last page ?>
            <div align="center"> <a href="<?php printf("%s?pageNum_rsdb1=%d%s", $currentPage, min($totalPages_rsdb1, $pageNum_rsdb1 + 1), $queryString_rsdb1); ?>">下一頁</a></div>
        <?php } // Show if not last page ?></td>
        <td width="147"><?php if ($pageNum_rsdb1 < $totalPages_rsdb1) { // Show if not last page ?>
            <div align="center"><a href="<?php printf("%s?pageNum_rsdb1=%d%s", $currentPage, $totalPages_rsdb1, $queryString_rsdb1); ?>">最後一頁</a> </div>
        <?php } // Show if not last page ?></td>
      </tr>
    </table>
</body>
</html>
<?php
mysql_free_result($rsdb1);
?>
