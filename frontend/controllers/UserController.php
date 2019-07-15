<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\behaviors\TimestampBehavior;
use \yii\db\Expression;
use frontend\widgets\avatar\ClipUploadAvatar;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // [
            //     'class' => TimestampBehavior::className(),
            //     'createdAtAttribute' => 'created_at',
            //     'updatedAtAttribute' => 'updated_at',
            //     'value' => new Expression('NOW()'),
            // ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='personal';
        $this->view->params['select'] = 'index';
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        if(Yii::$app->request->post()){
            $artributes = Yii::$app->request->post();
            $model->email = $artributes['User']['email'];
            $model->gender = $artributes['User']['gender'];
            $model->created_address = $artributes['User']['created_address'];
            $model->birthday = $artributes['User']['birthday'];
            if($model->save()){
                return $this->redirect(['index', 'model' => $model]);
            }
        }
        // if ($model->load(Yii::$app->request->post(),'User') && $model->save()) {
        //     return $this->redirect(['index', 'model' => $model]);
        // }
        return $this->render('index',[
            'model'=>$model,
        ]);
    }
    public function actionAvatar()
    {
        $this->layout='personal';
        $this->view->params['select'] = 'avatar';
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        if(Yii::$app->request->post()){
            //创建dir
         // 注意按需分配图片上传地址。
            $clip = new ClipUploadAvatar(
                isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
                isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
                isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null,
                \Yii::getAlias('@webroot').'/uploads/avatar/'.$id
            );
            
            $response = array(
                'state'  => 200,
                'message' => $clip->getMsg(),
                'result' => \Yii::getAlias('@web').'/uploads/avatar/'.$id.'/'.$clip->getResult()
            );
            $model->head_pic = \Yii::getAlias('@web').'/uploads/avatar/'.$id.'/'.$clip->getResult();
            $model->save();
            // ...存储数据库等

            echo json_encode($response);
        }else{
        
            // if ($model->load(Yii::$app->request->post(),'User') && $model->save()) {
            //     return $this->redirect(['index', 'model' => $model]);
            // }
            return $this->render('avatar',[
                'model'=>$model,
                'newfile'=>''
            ]);
        }
    }
    public function actionChangeavatar(){
        if(Yii::$app->request->isAjax){
            $id = Yii::$app->user->identity->id;
            $model = $this->findModel($id);
            $avatar = $_POST['avatar'];
            $default_img = \Yii::getAlias('@webroot').'/uploads/avatar/default/'.$avatar;
            $new_img = \Yii::getAlias('@webroot').'/uploads/avatar/'.$id.'/avatar.png';
            if(copy($default_img,$new_img)){
                $model->head_pic = \Yii::getAlias('@web').'/uploads/avatar/'.$id.'/avatar.png';
                $model->save();
                $arr=array();
                $arr['sucess'] = 'ok';
                $arr['result'] = $model->head_pic;
                echo json_encode($arr);
            }else{
                echo json_encode(['sucess'=>'no','result'=>'']);
            }
            
        }
    }
    public function actionUpload(){
        if ($_POST['form_submit']!='ok'){
            $this->redirect(array('/user/avatar')); 
        }
        $id = Yii::$app->user->identity->id;

        //上传图片
        //实例化上传model类
        $model = new UploadForm();
        
        if(Yii::$app->request->isPost){
            //取出model中的图片信息
            $model->imageFile = UploadedFile::getInstance($model,'imageFile');

            if($model->upload()){
                //上传成功添加入库
                $img = $model->imageFile->name;

                //添加入库
                //$res = Yii::$app->db->createCommand()->insert('photo',['img'=>$img])->execute();
                
                //判断是否上传成功
                // if($res){
                //     return $this->redirect(['list']);
                // }
                // return $this->goBack();
            }
        }

        return $this->render('avatar', ['model' => $model]);
    }
    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
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
     * 修改密码
     */
    public function actionPassword(){
        $this->layout='personal';
        $this->view->params['select'] = 'password';
        $id = Yii::$app->user->identity->id;
        $user = $this->findModel($id);
        if(Yii::$app->request->post() && $user && $user->validatePassword($_POST['User']['password'])) {
            $new_password = $_POST['new_password'];
            $user->setPassword($new_password);
            //$user->generateAuthKey();
            
            //$user->generateEmailVerificationToken();
            return $user->save();
        }else{
            return $this->render('password',[
                'model'=>$user
            ]);
        }
        
    }
    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
