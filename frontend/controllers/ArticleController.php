<?php

namespace frontend\controllers;

use Yii;
use common\models\Article;
use common\models\Category;
use common\models\CategoryQuery;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * AticleController implements the CRUD actions for Aticle model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Aticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Article::find(),
        // ]);
        $pageSize = 10;
        $query = Article::find();//->where(['status' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => $pageSize]);
        $models = $query->offset($pages->offset)
                ->orderBy('a_date desc')
                ->joinWith("user")
                ->asArray()
                ->limit($pages->limit)
                ->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            //'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aticle model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $arr =  Article::find()->where("a_id=$id")->joinWith('user')->one();
        if(!$arr){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        //var_dump($arr);die;
        return $this->render('view', [
            //'model' => $this->findModel($id),
            'model'=>$arr
        ]);
    }

    /**
     * Creates a new Aticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        if ($model->load(Yii::$app->request->post())) {
            $model->a_author = Yii::$app->user->identity->id;
            $model->a_date = time();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->a_id]);
            }
        }
        
        $category = new Category();
        $category_query = new CategoryQuery($category);
        $cate_arr = yii\helpers\ArrayHelper::map($category_query->all(),'c_id','c_name');
        return $this->render('create', [
            'model' => $model,
            'cate_arr'=>$cate_arr
        ]);
    }

    /**
     * Updates an existing Aticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $category = new Category();
        $category_query = new CategoryQuery($category);
        $cate_arr = yii\helpers\ArrayHelper::map($category_query->all(),'c_id','c_name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->a_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cate_arr'=>$cate_arr
        ]);
    }

    /**
     * Deletes an existing Aticle model.
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
     * Finds the Aticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
