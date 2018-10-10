<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<style type="text/css" media="screen">
  button{
    outline: none !important;
    border: none;
    background: transparent;
  }
  button:hover {
    cursor: pointer;
  }
  .container-login{
    background: url('/images/bg.jpg');
    width: 100%;
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  }
  .card{
    text-align: center;
    min-width: 500px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    padding: 55px;
  }
  .container-login .submit-btn{
    font-size: 16px;
    color: #fff;
    line-height: 1.2;
    text-transform: uppercase;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    width: 100%;
    height: 50px;
  }
  .form-button-container{
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .button-wrapper{
    width: 100%;
    display: block;
    position: relative;
    z-index: 1;
    border-radius: 25px;
    overflow: hidden;
    margin: 0 auto;
    box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -moz-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -webkit-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -o-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -ms-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
  }
  .login-btn{
    position: absolute;
    z-index: -1;
    width: 300%;
    height: 100%;
    background: #a64bf4;
    background: -webkit-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: -o-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: -moz-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    top: 0;
    left: -100%;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }
  .button-wrapper:hover .login-btn{
    left: 0;
  }
  input{
    border: none;
    outline: none;
  }
  input:hover{
    border-color: transparent !important;
  }
  .input{
    font-size: 16px;
    color: #43383e;
    line-height: 1.2;
    position: relative;
    display: block;
    width: 100%;
    height: 62px;
    background: #fff;
    border-radius: 31px;
    padding: 0 35px 0 35px;
  }
</style>
<div class="site-login">
  <div class="container-login">
    <div class='card'>
      <div>
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to login:</p>

        <?php $form = ActiveForm::begin([
          'id' => 'login-form',
        ]); ?>

        <?= $form->field($model, 'username')->textInput([
          'autofocus' => true,
          'class' => 'input',
          'placeholder' => 'Username'
        ])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput([
          'class' => 'input',
          'placeholder' => 'Password'
        ])->label(false) ?>

        <div class="form-button-container">
          <div class="button-wrapper">
            <div class="login-btn"></div>
            <?= Html::submitButton('Login', ['class' => 'submit-btn', 'name' => 'login-button']) ?>
          </div>
        </div>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <?= Html::a('Sign Up', ['site/signup']) ?>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>