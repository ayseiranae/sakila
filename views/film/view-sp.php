<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var array $film */

$this->title = $film['title'];
$this->params['breadcrumbs'][] = ['label' => 'Films', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'film_id' => $film['film_id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'film_id' => $film['film_id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th>Film ID</th>
                    <td><?= Html::encode($film['film_id']) ?></td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td><?= Html::encode($film['title']) ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?= Html::encode($film['description']) ?></td>
                </tr>
                <tr>
                    <th>Release Year</th>
                    <td><?= Html::encode($film['release_year']) ?></td>
                </tr>
                <tr>
                    <th>Language ID</th>
                    <td><?= Html::encode($film['language_id']) ?></td>
                </tr>
                <tr>
                    <th>Rental Duration</th>
                    <td><?= Html::encode($film['rental_duration']) ?> days</td>
                </tr>
                <tr>
                    <th>Rental Rate</th>
                    <td>$<?= Html::encode($film['rental_rate']) ?></td>
                </tr>
                <tr>
                    <th>Length</th>
                    <td><?= Html::encode($film['length']) ?> minutes</td>
                </tr>
                <tr>
                    <th>Replacement Cost</th>
                    <td>$<?= Html::encode($film['replacement_cost']) ?></td>
                </tr>
                <tr>
                    <th>Rating</th>
                    <td><?= Html::encode($film['rating']) ?></td>
                </tr>
                <tr>
                    <th>Last Update</th>
                    <td><?= Html::encode($film['last_update']) ?></td>
                </tr>
            </table>
        </div>
    </div>

</div>