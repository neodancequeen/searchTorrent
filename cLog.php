<?php

class Log{
    
    //项目跟路径
    private $root_path;
    
    //日志文件绝对路径
    private static $log_file_path;
    
    function __construct($root_path){
        $this->root_path = $root_path.DIRECTORY_SEPARATOR;
        self::$log_file_path = $this->root_path .'logfile'.DIRECTORY_SEPARATOR .date('Y_m_d',time()).'.log';
    }
   
    // 获取访问者ip地址
    private static function getRealIp(){
        $ip = false;
        if (!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip){
                array_unshift($ips, $ip);
                $ip = false;
            }
            for ($i = 0; $i < count($ips); $i++){
                if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])){
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }
   
    // 写访问日志
    public function writeLog($type){
        
        //浏览当前页面的用户的主机名
        $uhost = (isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : '-');
        
        //请求时间
        $rtime =  date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
        
        //请求类型
        $rmethod = $_SERVER['REQUEST_METHOD'];
        
        //请求来路
        $ref = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '-');
        
        //请求协议类型
        $rprotocol = $_SERVER['SERVER_PROTOCOL'];
        
        //请求浏览器的用户浏览器信息
        $ragent = empty($_SERVER['HTTP_USER_AGENT']) ? 'Unknown' : $_SERVER['HTTP_USER_AGENT'];
        
        $durl = $_SERVER['REQUEST_URI'];

        $logStr = self::getRealIp() .' '.$type.' '.$uhost.' '.$rtime.' "'.$rmethod.' '.$ref.' '.$rprotocol.'" '.$ragent.' '.$durl."\r\n";

        if(!file_exists($this->root_path .'logfile')){
            mkdir($this->root_path .'logfile');    
        }
        
        $flog = fopen(self::$log_file_path,'a');
        fwrite($flog,$logStr);
        fclose($flog);
    }
}
?>