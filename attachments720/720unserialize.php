<?php
  class Wrapper {
      public $handler;
      public function __destruct() {
          $this->handler->read();
      }
  }
  class FileHandler {
      public $file;
      public function read() {
          if (strpos($this->file, '/') === 0) {
              echo "文件路径不能以 '/' 开头";
              exit;
          }
          if (strpos($this->file, '..') !== false) {
              echo "文件路径不能包含 '..'";
              exit;
          }
          $content = file_get_contents($this->file);
          echo $content;
      }
  }
  if($_GET["action"]=="src"){
    highlight_file(__FILE__);
    exit;
  }
  // 用户输入
  if (isset($_GET['data'])) {
    $data = $_GET['data'];
    unserialize($data);
  }else{
    echo "<a href='?action=src'>源代码</a> | <a href='/tmp/flag'>Flag</a>";
  }
?>