<?php

/* @var $this yii\web\View */

$this->title = 'Чат';

use yii\helpers\Html;; ?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>
    </div>

    <div style="text-align: center">
                <h2>Информация для пользователей</h2>

                <p>Писать сообщения в чат могут ТОЛЬКО авторизованные пользователи</p>
                <p>Сообщения от Администратора выделяются в общем списке</p>

                <p>
                    <?= Html::a('Перейти в чат', ['/chat/index'], ['class' => 'btn btn-primary']) ?>
                </p>
    </div>
</div>