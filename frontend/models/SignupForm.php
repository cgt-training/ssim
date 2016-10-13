<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;   
    public $auth_role;
  

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['auth_role','required'],
            ['auth_role','safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auth_role' => 'Permission To',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($auth_roles)
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $saved = $user->save();

        //initialize auth manager
        $auth  = Yii::$app->authManager;

        //check if all permission assigned then assign admin role
        if(count($this->auth_role) == count($auth_roles)){
            $adminRole = $auth->getRole('admin');
            $auth->assign($adminRole,$user->getId());
        }
        else{
            foreach($this->auth_role as $each){
                if($each == 'author'){
                    $role = $auth->getRole('author');
                }
                elseif($each == 'updator'){
                    $role = $auth->getRole('updator');
                }
                elseif($each == 'deleter'){
                    $role = $auth->getRole('deleter');
                }
                 $auth->assign($role,$user->getId());
            }
        }
        
        return $saved ? $user : null;
    }
}
