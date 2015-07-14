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
        <div class="well">
            
            <p>Write a program which, given a dictionary, generates two output files, 'sequences' and 'words'. 'sequences' 
                should contain every sequence of four letters (case insensitive) that appears in exactly one word of the 
                dictionary, one sequence per line. 'words' should contain the corresponding words that contain the sequences, 
                in the same order, again one per line.</p>

            <p>For example, given the trivial dictionary containing only</p>

            <? echo HTML::ul(['arrows', 'carrots', 'give', 'me'], ['class' => 'no-deco']); ?>


            <p>The outputs should be:</p>

            <? echo HTML::ul(["'sequences'", 'carr', 'give', 'rots', 'rows', 'rrot', 'rrow'], ['class' => 'side-by-side']); ?>
            <? echo HTML::ul(["'words'", 'carrots', 'give', 'carrots', 'arrows', 'carrots', 'arrows'], ['class' => 'side-by-side']); ?>


            <p>Of course, 'arro' does not appear in the output, since it is found in more than one word.</p>
            
            <p>For the final solution, read in the following dictionary file: <?= Html::a('http://bit.ly/1jveLkY', 'http://bit.ly/1jveLkY') ?> </p>


        </div>
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
