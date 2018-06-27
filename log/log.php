<?php

require_once (__DIR__ . "/../config.php");
// 提供log文件输出

function ErrLogChain($file,$line,$content){
    // 设置中国时区
    date_default_timezone_set("Asia/Shanghai");
    // 设置日志名称
    $logfile = log_path . "php-common" . date('Ymd').'.log';  
    if(!file_exists(dirname($logfile)))  
    {  
        @File_Util::mkdirr(dirname($logfile));  
    }  

    // 拼装日志信息
    $message = " [" . basename($file) . "]" .  "[" . $line . "]: " . $content;
    //$message = " [" . basename(__FILE__) . "]" .  "[" . __LINE__ . "]" . ": " . $content;
    //echo "\n" , $message , "\n",$content,"\n";
    
    error_log(date("[Y-m-d H:i:s]").$message."\n", 3,$logfile);  
} 

?>
