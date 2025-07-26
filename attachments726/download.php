<?php
//MIME校验
header("Content-type: text/html;charset=utf-8");
error_reporting(0);
file_put_contents("/tmp/flag",$_ENV["TARMAN_DYNAMIC_FLAG"]);

define("WWW_ROOT",$_SERVER['DOCUMENT_ROOT']);
define("APP_ROOT",str_replace('\\','/',dirname(__FILE__)));
define("APP_URL_ROOT",str_replace(WWW_ROOT,"",APP_ROOT));
//文件包含漏洞页面
define("INC_VUL_PATH",APP_URL_ROOT . "/include.php");
//设置上传目录
define("UPLOAD_PATH", "./upload");$is_upload = false;
$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        if (($_FILES['upload_file']['type'] == 'image/jpeg') || ($_FILES['upload_file']['type'] == 'image/png') || ($_FILES['upload_file']['type'] == 'image/gif')) {
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH . '/' . $_FILES['upload_file']['name'];          
            if (move_uploaded_file($temp_file, $img_path)) {
                $is_upload = true;
            } else {
                $msg = '上传出错！';
            }
        } else {
            $msg = '文件类型不正确，请重新上传！';
        }
    } else {
        $msg = UPLOAD_PATH.'文件夹不存在,请手工创建！';
    }
}
?>

<form enctype="multipart/form-data" method="post">
	<p>请选择要上传的图片：</p>
	<input class="input_file" type="file" name="upload_file"/>
	<input class="button" type="submit" name="submit" value="上传"/>
</form>

<div id="msg">
    <?php 
    if($msg != null){
        echo "提示：".$msg;
    }
        ?>
        </div>
<div id="img">
    <?php
    if($is_upload){
        echo "上传成功";
        echo '<img src="'.$img_path.'" width="250px" />';
    }
    ?>
    </div>