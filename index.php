<?php
  if (!isset($_GET['file'])) {
    header("HTTP/1.1 400 Bad Request");
    echo "未提供文件路径或 URL。";
    exit;
  }
  $file = "./files/".$_GET['file'];
  $filename = basename($file);
  $size = filesize($file);
  header("Content-Description: File Transfer");
  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("content-Transfer-Encoding: binary");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Pragma: public");
  header("Content-Length: ".$size);
  ob_clean();
  flush();
  readfile($file);
?>
