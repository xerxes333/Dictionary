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

    <div class="row">
        <div class="col-lg-12">
            <h2>My Thoughts</h2>
            <p>
                Initially I started to use the Yii2 framework to create models to utilize the
                database to do the computations but after running some tests with larger sample sizes it started
                using too much RAM because it was loading entire model objects into memory.  I could have just switched to writing
                a PHP CLI script to complete the task but I decided to start cataloging my projects and challenges in one place, so I 
                just let the <code>DisctionaryForm->process()</code> method handle the calculations.
            </p>
            <p>
                I added some functionality to the challenge by allowing the user
                to choose the sequence length and the possible number of occurrences.  The original request
                asked that I showcase some of my various skills and pro-actively thinking about the overall
                functionality of an interface is one of those skills.
            </p>
            <p>
                After submitting this challenge to the company they responded back saying they recieved numerous qualified applicants and decided to move forward with another candidate.  
                I do not believe they had another candidate because the job listing is still posted a month later. 
                I requested feedback from them regarding my resume, cover letter, challenge submission, etc. but they never responded back.  
                Which leads me to believe they did not like something in my code or my solutions/results are wrong.  
                Unfortunatly with no feedback from them its impossible to say specifically.
            </p>
            <p>
                TODO:
                <? echo HTML::ul([
                    'Separate out various parts of the <code>process()</code> method into other methods to follow "Open/Close Principals"', 
                    "Use model constants for sequence length and occurrences options when the model is initialized.", 
                    "Reduce computations? I have no doubt there is a better way to process the data to reduce the bigO, I'm just not sure how to accomplish that right now.",
                    "I need to do a complete test to confirm my results are accurate.",
                 ],['encode'=>0]); ?>
            </p>
            
        </div>
    </div>

</div>
