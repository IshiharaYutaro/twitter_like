<?php
App::uses('AppModel', 'Model');

class Follow extends AppModel {
	 public $name = 'Follow';

//ログインしているユーザーのフォローを検索
  public function list_all_follow($id){
  $all_follower_data=$this->find('list',array('fields' => array('Follow.follower'),'conditions'=>array('Follow.follow'=>$id)));
  return $all_follower_data;
  }
  public function list_all_follower($id){
   $all_follow_data=$this->find('list',array('fields' => array('Follow.follow'),'conditions'=>array('Follow.follower' => $id)));
   return $all_follow_data;
}
  
public function all_follow($id){
    $follow_data= $this->find('all',array('conditions'=>array('Follow.follow'=>$id)));
    return $follow_data;
  }


  public function all_follower($id){
    $follower_data= $this->find('all',array('conditions'=>array('Follow.follower'=>$id)));
    return $follower_data;
  }

  public function count_follow($data_name){
  $count_follow=$this->find('count',array('conditions'=>array('Follow.follow' => $data_name)));
  return $count_follow;
}

public function count_follower($data_name){
  $count_follower=$this->find('count',array('conditions'=>array('Follow.follower' => $data_name)));
  return $count_follower;
}


}

