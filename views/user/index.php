<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


use app\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Список работников';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Зарегистрировать нового пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
    [
        'class' => SerialColumn::class,
        'header' => 'Порядковый номер',
    ],
//    'id',
    'last_name',
    'first_name',
    'third_name',
    'date_birth:date',
    'status:datetime',
    [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'contentOptions' => ['style' => 'text-align:center'],
        'headerOptions'=>['style' => 'text-align:center'],
    ],
    ],
])?>
</div>