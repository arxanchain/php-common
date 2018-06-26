<?php

require (__DIR__ . "/../config.php");
// 提供log文件输出

function logError($content)  
{  
    
    $logfile = $log_path . "php-common" . date('Ymd').'.log';  
    if(!file_exists(dirname($logfile)))  
    {  
        @File_Util::mkdirr(dirname($logfile));  
    }  
    $massage = " [" . basename(__FILE__) . "]" .  "[" . __LINE__ . "]" . ": " . $content;
    
    error_log(date("[Y-m-d H:i:s]").$massage."\n", 3,$logfile);  
} 
