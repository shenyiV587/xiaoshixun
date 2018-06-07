<?php 
namespace Core;
//web路由
class route{
	public $controller;
	public $action;
	public function __construct(){
		
		if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/') {
			
			$path = trim($_SERVER['PATH_INFO'],'/');
			$path_arr = explode('/', $path);
			// print_r($path_arr);die;
			$this->controller=isset($path_arr[0])?$path_arr[0]:$_SERVER['config']['controller'];

			$this->action=isset($path_arr[1])?$path_arr[1] :$_SERVER['config']['action'];
			unset($path_arr[0]);

			unset($path_arr[1]);
			// print_r($path_arr);die;
			
			// 拼接url
			$num = count($path_arr)+2;
			
			for ($i=2; $i < $num ; $i++) { 
				if (isset($path_arr[$i+1])) {
				 $_REQUEST[$path_arr[$i]] =	$_GET[$path_arr[$i]] = $path_arr[$i+1];
				}
				$i++;
			}	
		}
		else{
			$this->controller=$_SERVER['config']['controller'];

			$this->action=$_SERVER['config']['action'];
		    }
	     }
      }
 ?>