<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;


class SignupForm extends Model
{
    /**
     * @var int Идентификатор работника в БД
     */
    public $id;
    /**
     * @var string Логин для создания пользователя
     */
    public $username;
    /**
     * @var string Новый пароль пользователя
     */
    public $password;
    /**
     * @var string Имя работника
     */
    public $first_name;
    /**
     * @var string Фамилия работника
     */
    public $last_name;
    /**
     * @var string Отчество работника
     */
    public $third_name;
    /**
     * @var int Дата рождения работника
     */
    public $date_birth;
    /**
     * @var string Электронная почта
     */
    public $email;

    /**
     * Названия атрибутов формы
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'third_name' => 'Отчество',
            'date_birth' => 'Дата рождения',
            'email' => 'Электронная почта',
        ];
    }

    /**
     * Правила валидации полей формы
     * @return array
     */
    public function rules()
    {
        return [
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['username', 'password', 'first_name', 'last_name', 'third_name', 'date_birth'], 'required'],
            [['username', 'password', 'first_name', 'last_name', 'third_name', 'email'], 'string'],
            [['username'], 'string', 'min' => 3],
            [['password'], 'string', 'min' => 3, 'max' => 20],
        ];
    }

    /**
     * Попытка регистрации пользователя
     * @return User|null
     * @throws \Exception
     */
    public function register()
    {
        // если валидация прошла успешно
        if ($this->validate()) {
            $user = new User([
                'username' => $this->username,
                'access_token' => "{$this->username}-token",
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'third_name' => $this->third_name,
                'date_birth' => $this->date_birth,
                'email' => $this->email,
            ]);

            $user->generateAuthKey();
            $user->password = $this->password;

            if ($user->save()) {
                // назначение пользователю базовой роли User
                $auth = Yii::$app->authManager;

                $role = $auth->getRole('user');

                $auth->assign($role, $user->id);

                return $user;
            }
        }

        // вернем false, если не прошла валидация
        return null;
    }

}