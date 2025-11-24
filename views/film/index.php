<?php

use app\models\Film;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FilmSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Films';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Film', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'film_id',
            'title',
            'description:ntext',
            'release_year',
            'language_id',
            //'original_language_id',
            //'rental_duration',
            //'rental_rate',
            //'length',
            //'replacement_cost',
            //'rating',
            //'special_features',
            //'last_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    $filmId = is_array($model) ? $model['film_id'] : $model->film_id;
                    return Url::toRoute([$action, 'film_id' => $filmId]);
                 }
            ],
        ],
    ]); ?>


</div>
