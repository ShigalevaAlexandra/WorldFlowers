<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Users
{
    public $confirm_password;
    public $agree;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'password', 'confirm_password'], 'required'],
            [['is_admin'], 'integer'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[А-Яёа-яё\- ]{1,}$/u', 'message' => 'Допустимые символы: кириллица, пробел и тире'],
            [['login'], 'match', 'pattern' => '/^[A-Za-z0-9\-]{1,}$/u', 'message' => 'Допустимые символы: латиница, цифры и тире'],
            [['password'], 'match', 'pattern' => '/^[A-Za-z0-9]{6,}$/u', 'message' => 'Пароль небезопасный (используйте как минимум 6 символов)'],
            [['login'], 'unique'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['confirm_password'], 'compare', 'compareAttribute' => 'password'],
            [['agree'], 'compare', 'compareValue' => true, 'message' => 'Необходимо согласие на обработку персональных данных'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'email',
            'password' => 'Пароль',
            'is_admin' => 'Права администратора',
            'confirm_password' => 'Повторите пароль',
            'agree' => 'Подтвердите согласие на обработку персональных данных',
        ];
    }
}