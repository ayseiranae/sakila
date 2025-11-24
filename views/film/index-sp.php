<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $films */

$this->title = 'Films (Stored Procedure)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Film', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Release Year</th>
                    <th>Rating</th>
                    <th>Length</th>
                    <th>Rental Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($films as $film): ?>
                <tr>
                    <td><?= Html::encode($film['film_id']) ?></td>
                    <td><?= Html::encode($film['title']) ?></td>
                    <td><?= Html::encode($film['release_year']) ?></td>
                    <td><?= Html::encode($film['rating']) ?></td>
                    <td><?= Html::encode($film['length']) ?> min</td>
                    <td>$<?= Html::encode($film['rental_rate']) ?></td>
                    <td>
                        <?= Html::a('View', ['view', 'film_id' => $film['film_id']], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= Html::a('Update', ['update', 'film_id' => $film['film_id']], ['class' => 'btn btn-warning btn-sm']) ?>
                        <?= Html::a('Delete', ['delete', 'film_id' => $film['film_id']], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>