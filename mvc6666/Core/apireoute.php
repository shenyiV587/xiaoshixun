<?php
  namespace Core;
  //接口路由
  class apireoute{
  	 public $controller;
  	 public $action;
  	 public function __construct()
  {
     if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO']!='/') {
     	  $path = trim($_SERVER['PATH_INFO'],'/');
     	  $path_arr = explode('/',$path);
     	  //控制器
     	  $this->controller = $path_arr[0];
     	  //方法
     	  $this->action = strtolower($_SERVER['REQUEST_METHOD']);
     	  //拼接
     	  unset($path_arr[0]);
     	  $sum = count($path_arr)+1;
     	  
     	  for ($i=1; $i <$sum ; $i++) { 
     	  	  if (isset($path_arr[$i+1])) {
     	  	  	 $_GET[$path_arr[$i]] = $path_arr[$i+1];
     	  	  }
     	  	  $i++;
     	  }
     	   //print_r($_GET);die;
     }else
      echo json_encode([
         'code'=>'404',
          'res'=>[
            'msg'=>'不要再来',
            'error'=>1
          ]
    ]);
  }
 }
 
?>