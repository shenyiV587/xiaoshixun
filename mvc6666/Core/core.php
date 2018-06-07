<?php
namespace Core;

class core{
	public $val;
	static public function  run(){

		$route = new \Core\apireoute();

		$controller=$route->controller;

		$action = $route->action;

		$path ='\\Application\\controllers\\'.$controller."Controller";
		if(isset($controller) && isset($action)){
			$obj = new $path();
			$obj->$action();
		}
	}

	//自动加载
	static public function  load($class){
		$class = str_replace('\\','/',$class);
		$path = DS.'/'.$class.'.php';
		if (is_file($path)) {
			include $path;
		}else{
			return false;
		}
	}

	//渲染数据
	public function display($name,$value){
		$this->val[$name]=$value;
	}

	//渲染模板
	public function render($path){
		$path = APP.'/view/'.$path.".html";
		if (is_file($path)) {
			extract($this->val);
			include $path;
		}
	}

}