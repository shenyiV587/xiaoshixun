<?php
//M 表
  function M($tableName)
  {
    $arr = new  Core\Model($tableName);
    return $arr;
  }
  //接值
  function I($val){ 

    $request=http_request();

      $str = '';  
      if (strpos($val, '.')) { 
        $val_arr = explode('.',$val);
      switch ($val_arr[0]) { 
          case 'get':
             $str = $request[$val_arr[0]][$val_arr[1]]; 
            break;
          case 'post':
             $str = $request[$val_arr[0]][$val_arr[1]]; 
            break;
           case 'put':
            $str = $request[$val_arr[0]][$val_arr[1]]; 
            break;
           case 'delete':
            $str = $request[$val_arr[0]][$val_arr[1]]; 
            break;
          default:
            $str='';
            break;
        }

      }else{
        $str = $_REQUEST[$val];  
        
      }

      if (!empty($str)) {
       
        return $str;
      }else{
        return false;
      }
}
//语言包
function L($name){
  $path =  CORE.'/lan/'.$name.'.php';
  if (is_file($path)) {
     $data = include $path;
     return $data;
  }else{
     return false;
  }
}
 function http_request()
 {
      $str_request = '';
      $http_request = $_SERVER['REQUEST_METHOD'];
      
      if (isset($http_request) && !empty($http_request)) {
        switch ($http_request) {
        case 'GET':
            $str_request['get'] = $_GET;
          break;
        case 'POST':
             $str_request['post'] = $_POST;
          break;
          case 'PUT':
         if (!isset($_REQUEST['put'])) {
            parse_str(file_get_contents("php://input"),$_REQUEST['put']); 
         }
          $str_request['put'] = $_REQUEST['put'];
          break;
        case  "DELETE":
          parse_str(file_get_contents("php://input"),$str_request['delete']);
           break; 
        default:
          $str_request = '';
          break;
      }
    }   
    return $str_request;
 }
?>