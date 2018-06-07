<?php 
namespace Core;

use PDO;

class Model{

	static $tablename;

	static $db;

	public function __construct($tablename){

		self::$tablename = $tablename;

		$connect = $_SERVER['config']['connect'];

		$name    = $_SERVER['config']['name'];

		$pwd     = $_SERVER['config']['pwd'];

		self::$db = new PDO($connect,$name,$pwd);

		
	}
    //无条件查询
	public function select($where=[]){
		if (!empty($where)) {
			
			$str = '';

			foreach ($where as $key => $value) {
				$str .= $key." = " .":".$key. " and ";
			}
			$str=substr($str,0,-4);
			
			$obj = self::$db->prepare("select * from ".self::$tablename." where ".$str);
			foreach ($where as $key => $value) {
				$obj->bindValue(":".$key,$value);
			}
			$obj->execute();

			$data=$obj->fetch(PDO::FETCH_ASSOC);
		
		}else{
			$sql="select * from ".self::$tablename;
			$arr=self::$db->query($sql);

			foreach ($arr as $key => $value) {

				$data[]=$value;
			}
			
		}
		return $data;

		
	}
	//删
	public function del($user_id){
		 $sql = "delete from ".self::$tablename ." where user_id = $user_id";
		 $arr=self::$db->exec($sql);
		
		return $arr;
	}
	//增 预处理
	public function add($arr){

		$k= '';
		
		$v= '';

		foreach ($arr as $key => $value) {
				$k .=$key." , ";
			}	
		$k= substr($k,0,-2);

		$y = '';
		foreach ($arr as $key => $value) {
				$y .=":".$key." , ";
		}
		$y= substr($y,0,-2);

		$obj=self::$db->prepare("insert into ".self::$tablename."(".$k.") values (".$y.")");
		foreach ($arr as $key => $value) {
			$obj->bindValue(":".$key,$value);
		}
		$res=$obj->execute();
		
		return $res;
     
	}
	// //改
	public function update($arr,$where){
		
		$str = '';
		foreach ($arr as $key => $value) {
			$str .= $key . "='" .$value . "' , ";
		}
		$str = substr($str,0,-2);
		print_r($str);

		$str_s = '';
		foreach ($where as $key => $value) {
			$str_s .= $key . "='" .$value ."' and ";
		}
		$str_s = substr($str_s,0,-4);
        print_r($str_s);
		$sql = "update ".self::$tablename." set ".$str." where ".$str_s;
		$res=self::$db->exec($sql);
		return $res;
	}

	  //数据分页
    public function page($page,$pagesize){
        $sql="select count(*) as num from ".self::$tablename;

        $num=self::$db->query($sql,PDO::FETCH_ASSOC);
        foreach ($num as $key => $value) {
            $num=$value;
        }
        $num=$num['num'];
        $total=ceil($num/$pagesize);
        $up=$page-1<1?1:$page-1;
        $down=$page+1>$total?$total:$page+1;
        $move=($page-1)*$pagesize;
         // order by user_id asc "."
        $sql="select * from ".self::$tablename." limit ".$move.",".$pagesize;
  
        $arr=self::$db->query($sql,PDO::FETCH_ASSOC);
        $data=[];
        foreach ($arr as $key => $value) {
            $data[]=$value;
        }
        $arr=[
            'up'=>$up,
            'down'=>$down,
            'total'=>$total,
            'data'=>$data
            ];
        return $arr;

    }


}


 ?>