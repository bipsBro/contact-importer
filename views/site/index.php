<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Task';
?>
<style type="text/css" media="screen">
	small{
		font-size: 10px !important;
	}
</style>
<div class="site-index">
	<h1>Instruction <small>At first follow instruction the README.md</small></h1>
	<ol>
		<li>then login with user credential *</li>
		<li>if you don't have login credential you can sign up from <?= Html::a('here', ['/site/signup'] ) ?></li>
	</ol>
</div>
