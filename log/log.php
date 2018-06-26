<?php

require_once (__DIR__ . "/../config.php");
// 提供log文件输出

function ErrLogChain($content){
    $logfile = log_path . "php-common" . date('Ymd').'.log';  
    if(!file_exists(dirname($logfile)))  
    {  
        @File_Util::mkdirr(dirname($logfile));  
    }  
    //$message = " [" . basename(__FILE__) . "]" .  "[" . __LINE__ . "]" . ": " . $content;
    //echo "\n" , $message , "\n",$content,"\n";
    
    error_log(date("[Y-m-d H:i:s]").$content."\n", 3,$logfile);  
} 

?>
