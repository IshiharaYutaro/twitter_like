<?php
App::uses('AppController', 'Controller');
$uses = array('User','Tweet','Follow');

class UsersController extends AppController {
  var $json_user_data=null;  
  //読み込むコンポーネントの指定
  public $components = array('Session', 'Auth','Paginator');
  //どのアクションが呼ばれてもはじめに実行される関数
  public function beforeFilter()
  {
    parent::beforeFilter();
    //未ログインでアクセスできるアクションを指定
    //これ以外のアクションへのアクセスはloginにリダイレクトされる規約になっている
    $this->Auth->deny('index', 'logout');
  }

  public function register(){
    //$this->requestにPOSTされたデータが入っている
    //POSTメソッドかつユーザ追加が成功したら
    if($this->request->is('post')&&$this->User->save($this->request->data['User'])){
      if(!empty($this->data)){
     $username = $this->request->data['User']['username'];
      $this->redirect(array('action'=>'join', $username));
    }}
  }

public function index($data_name=NULL){
  
  $autoRender = false;
  $mypage=FALSE;
  $json_user_data=$data_name;
  $this->Session->write('json_user_data', $json_user_data);
if($data_name=='mypage'){
$data_name=$this->Auth->user('username');
  $mypage=TRUE;
}
       
       $this->set('mypage',$mypage);
     //ロードモデル指定
       $this->loadModel('Tweet');
       $this->loadModel('Follow');
      //ログインユーザーset
       $this->set('user', $this->Auth->user());
       //現在postしているデータをset
       $this->set('data_name',$data_name);
       //usernameを指定
       $id = $this->Auth->user('username');
       //エラー文のフラグ変数
       $set_msg=0;
      //data_nameのユーザー情報取得
       $this->set('user_first_tweet',$this->Tweet->user_first_tweet($json_user_data));
      //data_name投稿件数
$this->set('user_sentdata',$this->Tweet->count_tweet($json_user_data));
       $this->set('user_follow_data',$this->Follow->count_follow($data_name));
      //data_nameのfollower件数取得
       $this->set('user_follower_data',$this->Follow->count_follower($data_name));
       if($data_name==$id&&$mypage==FALSE){
       //$idのfollowデータを取得
       $this->set('follow_data',$this->Follow->all_follow($id));
       //フォロワーをfind指定
       $all_follow=$this->Follow->list_all_follow($id);

       }
       else{

}}

public function json_data(){
  //$this->autoRender = FALSE;

  $this->loadModel('Tweet');
  $this->loadModel('Follow');
//if($this->request->is('ajax')){
   $json_user_data=$this->Session->read('json_user_data');
   $error_msg=NULL;
    if(isset($this->request->data['page'])){
   $page=$this->request->data['page'];
//debug($page);
}
else{
  $page=1;
}
  if(isset($this->data['tweet_id'])){
     $this->Tweet->set($this->request->data);
    if($this->Tweet->validates(array('fieldList'=>array('tweet')))){
      $this->Tweet->save($this->request->data);
      //$error_msg=$this->validateErrors($this->Tweet);
        }
   else{
    // バリデーションNGの場合の処理
    $error_msg=$this->validateErrors($this->Tweet);

  }
       
}
if(isset($this->request->data['id'])){
$this->Tweet->delete($this->request->data);
}

      //data_nameのfollow件数
  $id=$this->Auth->user('username');
  $user_id=$this->Auth->user('id');
       //フォロワーをfind指定
  
if($id==$json_user_data){
  $all_follow=$this->Follow->list_all_follow($id);
  $json_data=$this->Tweet->json_alluser_tweet_all($all_follow,$id,$page);
}
  else{
    if($json_user_data=='mypage'){
    $json_data=$this->Tweet->user_tweet_all($id,$page);
    $json_user_data=$id;
  }
  else{
    $json_data=$this->Tweet->user_tweet_all($json_user_data,$page);
  }
  }
  $this->set('user_first_tweet',$this->Tweet->user_first_tweet($json_user_data));
      //data_name投稿件数
$this->set('user_sentdata',$this->Tweet->count_tweet($json_user_data));
  $this->viewClass = 'Json';
  $this->set('page',$page);
  $this->set('my_id',$id);
  $this->set('error_msg',$error_msg);
  $this->set('user_id',$user_id);
  $this->set('json_data',$json_data);
  $this->set('json_user_data',$json_user_data);
  $this->set('_serialize',['page','user_id','my_id','json_user_data','user_first_tweet','user_sentdata','error_msg','json_data','error_msg']);
/*}

else {
  throw new BadRequestException();
}*/
}


public function follow($no,$uname) {
  $this->loadModel('Tweet');
  $this->loadModel('Follow');
  $this->set('no', $no);
  $this->set('uname', $uname);
  $this->set('user', $this->Auth->user());
  $id = $this->Auth->user('username');

  //最初のツイート取得
  $this->set('first_tweet',$this->Tweet->user_first_tweet($uname));
  //$unameのツイート数をfind
  $this->set('sentdata',$this->Tweet->count_tweet($uname));
  //$unameのfollow人数をfind
  $this->set('followcount',$this->Follow->count_follow($uname));

  if($this->Auth->user('username')==$uname){
  //ログインユーザーでfollowしている人を取得
  $this->set('user_follow',$this->Follow->all_follow($uname));
}
  //$unameのフォローワー人数を取得
  $this->set('followercount',$this->Follow->count_follower($uname));
//$unameのuserのフォローデータを取得
  if($no=='follow'){
 $this->set('followdata',$this->Follow->all_follow($uname));
    //$unameのフォローデータを取得
  $f_data=$this->Follow->list_all_follow($uname);
  $this->paginate = $this->User->follow_list_data($f_data);
  $this->set('user_data',$this->Paginator->paginate('User'));
}
  else if($no=='follower'){
    $this->set('followerdata',$this->Follow->all_follower($uname));
    //unameのフォロワーデータ取得
    $f_data=$this->Follow->list_all_follower($uname);
  $this->paginate = $this->User->follow_list_data($f_data);
  $this->set('user_data',$this->Paginator->paginate('User'));
}
  
    if($this->request->is('post')|| $this->request->is('put')) {
       if(!empty($this->data)){
      if($this->request->data['follow']) {
      $this->Follow->save($this->request->data['Follow']);
      $this->redirect(array('action'=>'follow',$no,$uname));
              }
            else if($this->request->data['unfollow']){
              $this->Follow->delete($this->data['Follow']['id']);
              $this->redirect(array('action'=>'follow',$no,$uname));
              }
}
}
}
public function search(){
if($this->request->is('post')){
      $searchname = $this->request->data['Search']['title'];
      $this->redirect(array('action'=>'find', $searchname));

}
}

public function find($searchname = NULL){
  $this->loadModel('Tweet');
  $this->loadModel('Follow');
  $this->set('searchname', $searchname);
  $this->set('username',$this->Auth->user());
  $this->set('follows',$this->Follow->all_follow($this->Auth->user('username')));
  //searchnameの検索結果をpaginateで並び替え
  $this->paginate = $this->User->user_search($searchname);
  $this->set('userdata',$this->Paginator->paginate('User'));

if($this->request->is('post')){
  //検索にpostされた場合
    if(isset($this->data['Search']['title'])){
      $search = $this->request->data['Search']['title'];
      $this->redirect(array('action'=>'find', $search));}
//followにポストされた場合
    else if($this->Follow->save($this->request->data['Follow'])){
      $this->redirect(array('action'=>'find', $searchname));}
}
}


  public function login(){
  $this->User->validate = $this->User->validate_login;
    if($this->request->is('post')) {
      $this->User->set($this->request->data);
      if($this->User->validates()){
      if($this->Auth->login()){
      $this->redirect(array('action'=>'index',$this->Auth->user('username')));}
      else
        $this->Session->setFlash('ユーザー名、パスワードの組み合わせが違うようです。');
    }

}
 } 

  public function join($twitter){
  $this->set('name', $twitter);
  }

  public function logout(){
    $this->Auth->logout();
    $this->redirect('login');
  }
}
?>
