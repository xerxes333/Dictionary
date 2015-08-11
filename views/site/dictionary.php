<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this -> title = 'T3S - Dictionary Challenge';
?>
<div class="site-dictionary">

    <h2>Dictionary Challenge</h2>
    <div class="row">
        <?
        $link = "https://gist.github.com/seanthehead/11180933";
        $md = $this -> context -> renderPartial('dictionary_md');

        echo \yii\bootstrap\Collapse::widget([
            'items' => [[
                'label' => 'Challenge Info (click to expand)', 
                'content' => 'Source: ' . Html::a($link, $link) . $md, 
            ]]
        ]);
        ?>
    </div>

    <h2>Dictionary Solution</h2>
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="col-lg-3">

                    <?php $form = ActiveForm::begin(['id' => 'dictionary-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                    <?= $form -> field($model, 'seqLength') ?>
                    <?= $form -> field($model, 'appearance') -> label('Max # of allowed appearances') ?>
                    <?= $form -> field($model, 'dictionaryFile') -> fileInput() ?>

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
                        "If no dictionary file is provided by the user the default dictionary will be used (provided by challenge requirements)"
                     ]); ?>

                    <?php echo $model -> getOutputLinks(); ?>
                </div>
            </div>
        </div>
    </div>

    <h2>My Thoughts</h2>
    <div class="row">
        <p>
            Initially I started to use the Yii2 framework to create models to utilize the
            database to do the searching but after run some tests with larger sample sizes it started
            using too much RAM by loading whole objects into memory.  I could have just switched to writing
            a PHP CLI script to complete the task but I decided to start cataloging my projects and challenges in one place.
        </p>
        <p>
            I added some functionality to the challenge by allowing the user
            to choose the sequence length and the possible number of occurrences.  he original request
            asked that I showcase some of my various skills and pro-actively thinking about the overall
            functionality of an interface is one of those soft-skills.
        </p>
        <p>
            The Dictionary model handles the majority of the heavy lifting in the <code>$model->process()</code> method.
            I need to separate out various parts of the process method into other methods to follow "Open/Close Principals".
            Also need to use model constants for sequence length and occurrences options when the model is constructed.
        </p>
        <p>
            I'm have no doubt there is a better way to process the data to reduce the bigO
        </p>
    </div>

</div>
