<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
  public $name = 'User';
  //public $primaryKey = 'username';

  public $hasMany = array(
    'joinTweet' =>array(
      'className'=>'Tweet',
      'foreignKey'=>'tweet_id',
      'order'=>array('joinTweet.tweettime DESC'),
      'limit'=>'1',
      ));

   public $validate = array(
    'name' => array(
       'rule1'=>array(
          'rule' => 'notBlank',
          'message' => '名前を入力してください。',
            ),
      'rule2'=>array(
        'rule' => 'usernamerule',
        'message' => '名前は全角、半角英数字または「_」「-」で入力して下さい。',
        ),
      'rule3'=>array(
        'rule' => array('between',4,20), //4～20文字
        'message' => '名前は4文字以上20文字以内にしてください。',
      )
      ),
    'username' => array(
       'rule4'=>array(
        'rule' => 'notBlank',
        'message' => 'ユーザー名を入力してください。',
            ),
       'rule5'=>array(
        'rule' => array('isUnique'), //重複禁止
        'message' => '既に使用されているユーザー名です。',
      ),
      'rule6'=>array(
        'rule' => 'alphaNumericDashUnderscore', //半角英数字ハイフンアンダーバーのみ
        'message' => 'ユーザー名は半角英数字(-_を含む)にしてください。',
      ),
      'rule7'=>array(
        'rule' => array('between', 4, 20), //4～20文字
        'message' => 'ユーザー名は4文字以上20文字以内にしてください。',
      )),
    'password' => array(
       'rule8'=>array(
                    'rule' => 'notBlank',
                    'message' => 'パスワードを入力してください。'
            ),
      'rule9'=>array(
        'rule' => 'alphaNumeric',
        'message' => 'パスワードは半角英数字にしてください。',
      ),
      'rule10'=>array(
        'rule' => array('between', 4, 8),
        'message' => 'パスワードは4文字以上8文字以内にしてください。',
        )),
    'password_2' => array(
       'rule11'=>array(
                    'rule' => 'notBlank',
                    'message' => 'もう一度パスワードを記入してください。'
            ),
      'rule12'=>array(
    'rule' => 'passwordConfirm',
    'message' => 'パスワードが一致していません',
        )),

    'mailadress' => array(
      'rule13'=>array(
                    'rule' => 'notBlank',
                    'message' => 'メールアドレスを記入してください。'
            ),
      'rule14'=>array(
        'rule' => 'email',
      'message' => '正しいメールアドレス形式を入力して下さい。',
      )),
    );

public $validate_login = array(
    'username' => array(
       'rule15'=>array(
        'rule' => 'notBlank',
        'message' => 'ユーザー名を入力してください。',
            ),
      'rule16'=>array(
        'rule' => 'alphaNumericDashUnderscore', //半角英数字ハイフンアンダーバーのみ
        'message' => 'ユーザー名は半角英数字(-_を含む)にしてください。',
      ),
      'rule17'=>array(
        'rule' => array('between', 4, 20), //4～20文字
        'message' => 'ユーザー名は4文字以上20文字以内にしてください。',
      )),
    'password' => array(
       'rule18'=>array(
                    'rule' => 'notBlank',
                    'message' => 'パスワードを入力してください。'
            ),
      'rule19'=>array(
        'rule' => 'alphaNumeric',
        'message' => 'パスワードは半角英数字にしてください。',
      ),
      'rule20'=>array(
        'rule' => array('between', 4, 8),
        'message' => 'パスワードは4文字以上8文字以内にしてください。',
        )),

    );

    public function beforeSave($options = array()) {
    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    return true;
  }

public function passwordConfirm($check){

        //２つのパスワードフィールドが一致する事を確認する
        if($this->data['User']['password'] === $this->data['User']['password_2']){
            return true;
        }else{
            return false;
        }

    }

  public function alphaNumericDashUnderscore($check) {
        // $data 配列はフォームの項目名をキーとして渡される。
        // この関数が汎用的に使えるように、値を展開する必要がある。
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[0-9a-zA-Z_-]*$|', $value);
    }

    public function usernamerule($check) {
        // $data 配列はフォームの項目名をキーとして渡される。
        // この関数が汎用的に使えるように、値を展開する必要がある。
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[ぁ-んァ-ヶー一-龠0-9a-zA-Z_-]*$|', $value);
    }

    public function follow_list_data($data){
    $option = array(
      'order' => array('User.time' => 'desc'),
      'limit' => 10,
      'conditions'=>array(array('User.username'=>$data)));
    return $option;
    }
 
 public function user_search($searchname){
  $option = array(
      'order' => array('User.time' => 'desc'),
      'limit' => 10,
      'conditions' => array('or' => array( array("User.name like '%$searchname%'"),array("User.username like '%$searchname%'"))));
  return $option;
 }

}