<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'T3S - Dictionary Challenge';
?>
<div class="site-dictionary">
    
    <h2>Dictionary Challenge</h2>
    <div class="row">
            <? 
            $link = "https://gist.github.com/seanthehead/11180933";
	        $md = $this->context->renderPartial('dictionary_md');
	        
	        echo \yii\bootstrap\Collapse::widget([
	            'items' => [
	                [
	                    'label' => 'Challenge Info (click to expand)',
	                    'content' => 'Source: ' . Html::a($link, $link) . $md,
	                ]
	            ]
	        ]);
		?>
    </div>
    
    
    <h2>Dictionary Solution</h2>
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="col-lg-3">
                    
                    <?php $form = ActiveForm::begin(['id' => 'dictionary-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                        <?= $form->field($model, 'seqLength') ?>
                        <?= $form->field($model, 'appearance')->label('Max # of allowed appearances') ?>
                        <?= $form->field($model, 'dictionaryFile')->fileInput() ?>
                        
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'dictionary-button', 'id' => 'dictionary-button']) ?>
                            <span id="button-helpBlock" class="help-block hidden">Please wait...</span>
                        </div>
                    <?php ActiveForm::end(); ?>
                    
                </div>
                <div class="col-lg-9">
                	<h3 class="notes">Notes:</h3>
                	<? echo HTML::ul([
                		"Added the ability to search for varying sequence lengths and appearance threshold",
                		"In accordance with the Challenge, the input values default to 4 and 1 respectively but can be changed by the user.",
                		"If no dictionary file is provided by the user the default dictionary will be used (provided by challenge requirements)",
            		]); ?>
            		
            		
                    <?php echo $model->getOutputLinks(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
