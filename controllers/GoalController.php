<?php

namespace app\controllers;

use Yii;
use app\models\Goal;
use app\models\GoalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;

/**
 * GoalController implements the CRUD actions for Goal model.
 */
class GoalController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoalSearch();
        $params = Yii::$app->request->queryParams;
        
        $params['GoalSearch']['parentId']   = null;
        $params['GoalSearch']['userId']     = Yii::$app->user->getId();
        
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $milestones = new ArrayDataProvider([
            'allModels' => $model->getMilestones()->all(),
            'pagination' => false,
        ]);
        
        $log = new ArrayDataProvider([
            'allModels' => $model->glogs,
            'pagination' => false,
        ]);

        return $this->render('view', [
            'model' => $model,
            'milestones' => $milestones,
            'log' => $log,
        ]);
    }

    /**
     * Creates a new Goal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($parentId = null)
    {
        $model = new Goal();
        $model->parentId = $parentId;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->parentId != null)
                return $this->redirect(['view', 'id' => $model->parentId]);
            else
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Goal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $milestones = new ActiveDataProvider([
            'query' => $model->getMilestones(),
            'pagination' => false,
        ]);
        
        // $dataProvider = new ActiveDataProvider([
            // 'query' => $query,
        // ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'milestones' => $milestones,
            ]);
        }
    }
    
    // public function actionCreateMilestone($id)
    // {
        // $model = $this->findModel($id);
//         
        // return $this->render('update', [
            // 'model' => $model,
        // ]);
    // }

    /**
     * Deletes an existing Goal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
