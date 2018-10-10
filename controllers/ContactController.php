<?php

namespace app\controllers;

use Yii;
use app\models\Contact;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Curl;

/**
* ContactController implements the CRUD actions for Contact model.
*/
class ContactController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['index', 'view', 'import'],
        'rules' => [
          [
            'actions' => ['index', 'view', 'import'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'import' => ['post'],
        ],
      ],
    ];
  }

  public function actionIndex()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Contact::find(),
      'pagination' => [ 'pageSize' => 3 ],
    ]);

    return $this->render('index', [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionImport(){
    $user = yii::$app->user;
    $curl = new Curl();
    $response = $curl->get('http://www.mocky.io/v2/581335f71000004204abaf83');

    $contactsData = json_decode($response);

    foreach ($contactsData->contacts as $contact) {
      $contactName = $contact->name;
      $contactPhoneNumber = $contact->phone_number;
      $contactAddress = $contact->address;

      $oldContact = Contact::find()->where(['name' => $contactName]);

      if ($oldContact->exists()) {
        $oldContactDetail = $oldContact->one();
        $oldContactDetail->phone_number = $contactPhoneNumber;
        $oldContactDetail->address = $contactAddress;
        $oldContactDetail->user_id = $user->id;
        $oldContactDetail->save();
      }else{
        $newContact = new Contact();
        $newContact->name = $contactName;
        $newContact->phone_number = $contactPhoneNumber;
        $newContact->address = $contactAddress;
        $newContact->user_id = $user->id;
        $newContact->save();
      }
    }
    Yii::$app->session->setFlash('success', 'All your contact has been imported.');
    return $this->redirect(['index']);
  }

  /**
   * Displays a single Contact model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  
  /**
   * Updates an existing Contact model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Contact model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the Contact model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Contact the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Contact::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
