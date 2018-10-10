<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Task';
?>
<div class="site-index">
	<h1>Instruction</h1>
	<ol>
		<li>1st login with user credential</li>
		<li>if you don't have login credential you can sign up from <?= Html::a('here', ['/site/signup'] ) ?></li>
	</ol>
</div>
