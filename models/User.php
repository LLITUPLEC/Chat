<?php


namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property int $created_at
 * @property int updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $third_name
 * @property int $date_birth
 * @property string $status
 *
 * @property-write $password -> setPassword()
 */
class User extends ActiveRecord implements IdentityInterface
{

    public function behaviors()
    {
        return [TimestampBehavior::class,];
    }

    public function attributeLabels()
    {
        return [
            'id' => '#',
            'username' => 'Логин',
            'password_hash' => 'Пароль',
            'auth_key' => 'Ключ авторизации',
            'access_token' => 'Токен доступа',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего изменения',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'third_name' => 'Отчество',
            'date_birth' => 'Дата рождения',
            'email' => 'Электронная почта',
            'status' => 'активность',
        ];
    }

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['username', 'first_name', 'last_name', 'third_name', 'date_birth',], 'required'],
            [['username', 'first_name', 'last_name', 'third_name',], 'string'],
            [['username'], 'string', 'min' => 3],
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key == $authKey;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function getFullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function getRole($getId)
    {
        $roles = Yii::$app->authManager->getRolesByUser($getId);
        $result = ArrayHelper::getColumn($roles,'name', false);
        return $result[0];
    }
}