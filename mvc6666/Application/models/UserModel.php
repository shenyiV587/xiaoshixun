<?php 
namespace Application\models;
use PDO;
class UserModel extends \Core\Model{
	public function show(){
		$arr = $this->select();
		return $arr;
	}

}

 ?>