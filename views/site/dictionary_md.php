<?

use yii\helpers\Html;

?>
<h1>words_test.md</h1>
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
