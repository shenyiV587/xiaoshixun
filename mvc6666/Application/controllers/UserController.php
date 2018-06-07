<?php
namespace Application\controllers;	
use  \Core\core;
use \Application\models\UserModel;
class UserController extends core
{
    //查
    public  function get()
    {
       // $arr['user_id'] = 1;
       $obj = M('user');
       $arr = $obj->select();
       print_r($arr);die;
        //  //$page  = !empty(I('get.page')I('get.page')?'1');
        //  $page = I('get.page');

        // //  print_r($page);die;
        // $obj = M('user'); 
        // //$page = 1;
        // $pagesize = 3;
        // $arr = $obj->page($page,$pagesize);
        //  print_r($arr);
    }
    //增   
    public  function post()
    {
         //$name  = I('post.name');
       $obj = M('user');
       $user_name = I('post.user_name');
       $user_pwd  = I('post.user_pwd');
       $arr = [
          'user_name'=>$user_name,
          'user_pwd'=>$user_pwd
        ];
        $res = $obj->add($arr);
        print_r($res); 
    }
    //删
    public  function delete()
    {
        $obj = M('user');
        $user_id = I('delete.user_id');
        //print_r($user_id);die;
        $ddd = $obj->del($user_id);
        echo json_encode($ddd);
    }
    //改
    public  function put()
    {
       $obj = M('user');
       //$arr = $obj->select();
       $user_name = I('put.user_name');
       $user_pwd  = I("put.user_pwd");
       $user_id =   I('put.user_id');
       $arr = [
          'user_name'=>$user_name,
          'user_pwd'=>$user_pwd
        ];
       $where['user_id'] = $user_id;
        $acc = $obj->update($arr,$where);
       //update `user` set user_name='董松亚',user_pwd='6666666' where user_id = '8';
       print_r($acc);
       echo json_encode(['code'=>200,'mag'=>'成功']);
    }
}

