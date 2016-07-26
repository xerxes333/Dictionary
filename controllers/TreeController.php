<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
// use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Tree;

class TreeController extends Controller
{
    const MAX_RAND = 1000;
    const MIN_RAND = 1;
      
    public $modelClass = 'app\models\Tree';
    
    public function actionIndex()
    {
        $bar = Tree::find()->asArray()->all();   
        return json_encode($bar);   
    }
    
    public function actionCount(){
        $count = Tree::find()->count();
        return json_encode(["count" => $count]);
    }
    
    public function actionReset(){
        $res = Tree::deleteAll("id>2");
        return json_encode([
            "msg" => "msg"
        ]);
    }
    
    public function actionChanges(){
        
        $request= Yii::$app->request;
        
        return json_encode([
            "changes" => $this->checkDb($request->post())
        ]);
    }
    
    private function checkDb($post){
        $str = "";
        $trees  = Tree::find()->orderBy('id')->all();
        foreach ($trees as $key => $value) {
            $str .= $value->text;
        }
        
        return (md5($post['str']) == md5($str) && 
                $post['count'] == count($trees) )? FALSE : TRUE ;
    }
    
    public function actionFactory(){
        $request = Yii::$app->request;
        $post = $request->post();
        
        $count = Tree::find()->where(['parent'=>1])->count() + 1;
        $range = $this->setFactoryRange();
        $name = "Factory {$count}: ({$range[0]}-{$range[1]})";
        
        $new = new Tree();
        $new->text = $name;
        $new->parent = 1;
        
        if($new->save()){
            $ret = ["name" => $new->text, "id" => $new->id];
        } else {
            $ret = ["error" => " something went wrong"];
        }
        
        return json_encode($ret);
    }
    
    public function actionWorkers(){
        
        $request = Yii::$app->request;
        $post    = $request->post();
        $range   = $this->parseFactoryRange($post['factoryName']);
        
        Tree::deleteAll(['parent' => $post['factoryId']]);
        
        for ($i=0; $i < $post['count']; $i++) { 
            $new = new Tree();
            $new->text = rand($range[0], $range[1]);
            $new->parent = $post['factoryId'];
            $new->save();
            $list[] = $new->text;
        }
        
        return json_encode($list);
    }
    
    public function actionPoll(){
        return json_encode(["response"=>"this is the response"]);
    }
    
    private function setFactoryRange(){
        $a = rand(self::MIN_RAND, self::MAX_RAND);
        $b = rand(self::MIN_RAND, self::MAX_RAND);
        return ($a<$b)? [$a,$b] : [$b,$a];
    }
    private function parseFactoryRange($name = "(1-9)"){
        preg_match('/\([1-9].*-[0-9].*\)/', $name, $matches);
        $range = explode("-", str_replace(["(", ")"], "", $matches[0]));
        return $range;
    }
    
}
