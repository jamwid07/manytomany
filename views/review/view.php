<?php

use app\models\Relation;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Review */

$this->title = $model->FIO;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'FIO',
            'email:email',
            'text:ntext',
			[
				'attribute' => 'categories',
				'value' => function ($data) {
					$string = '';
					$cat = Relation::find()->where(['review_id' => $data->id])->all();
					foreach ($cat as $item) {
						$string .= $item->category->name . ", ";
					}
					return $string;
				}
			],
        ],
    ]) ?>

</div>
