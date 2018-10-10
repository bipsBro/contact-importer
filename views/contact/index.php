<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Import Contact', ['import'], ['class' => 'btn btn-success', 'data' => ['method' => 'post'] ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'phone_number',
            'address:ntext',
            'user' => 'user.username',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view},{delete}',
            ],
        ],
    ]); ?>
</div>
