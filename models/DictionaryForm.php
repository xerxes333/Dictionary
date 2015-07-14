<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Dictionary;
use yii\helpers\Html;

class DictionaryForm extends Model
{
    public $seqLength;
    public $appearance;
    public $dictionaryFile;
    
    private $dicFileName    = '../uploads/dictionary_medium.txt';
    private $seqFileName    = '../uploads/sequences.txt';
    private $wordFileName   = '../uploads/words.txt';
    private $tried          = [];
    private $results        = [];
    private $processSuccess	= false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['seqLength', 'appearance'], 'required'],
            [['seqLength', 'appearance'], 'number'],
            [['seqLength'], 'compare', 'compareValue' => 2, 'operator' => '>='],
            [['appearance'], 'compare', 'compareValue' => 1, 'operator' => '>='],
            [['dictionaryFile'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'seqLength'     => 'Sequence Length',
            'appearance'    => 'Appearances',
            'dictionaryFile'=> 'File',
        ];
    }
    
	/**
	 * This method processes the dictionary with the supplied params.
	 * 
	 * @return	bool
	 */
    public function process()
    {
        
        
        if ($this->validate()) {
            
            // if the user supplied a dictionary file use it instead of the default one
            if(isset($this->dictionaryFile)){
                $this->dicFileName = '../uploads/' . $this->dictionaryFile->baseName . '.' . $this->dictionaryFile->extension;
                $this->dictionaryFile->saveAs($this->dicFileName);
            }
            
            $handle     = fopen($this->dicFileName, "r");
            $allWords   = file_get_contents($this->dicFileName);
            $tried      = [];
            $results    = [];
            $x          = 0;
            
            while (($buffer = fgets($handle, 4096)) !== false) {
                
                $word = trim($buffer);
                
                // some simple checks to make sure our word meets our requirements
                if($this->checkWordLength($word) && $this->checkSeqPossible($word)){
                         
                   // now we chop up the word into segments 
                   for ($i=0; $i+$this->seqLength-1 < strlen($word) ; $i++) {
                       
                       $str = strtolower(substr($word, $i, $this->seqLength));
                       
                       // additional check to make sure we are only allowing alpha chars in the sequence
                       if(preg_match('/[a-zA-Z]{'. $this->seqLength .'}/', $str) !== 0){
                           
                           // if we have NOT already tried the sequence 
                           if(!isset($tried[$str])){
                               
                               // count how many times we preg match the sequence
                               $count = preg_match_all("/$str/i", $allWords);
                               
                               // if our count of matches is less then our threshold log the sequence and corresponding word 
                               if($count <= $this->appearance){
                                   $seq[] = "$str\r\n";
                                   $wrd[] = "$word\r\n";
                               }
                               
                           }
                           
                       }
                       
                   } 
                   
                }
            }
            
            // write sequence to file
            file_put_contents($this->seqFileName, $seq);
            // write word to file
            file_put_contents($this->wordFileName, $wrd);
   			
			$this->processSuccess = true;
            return true;
        } else {
            return false;
        }
    }

	/**
	 * Return links for the output files.
	 * 
	 * @return	string
	 */
	public function getOutputLinks(){
		
		if($this->processSuccess && file_exists($this->seqFileName) && file_exists($this->wordFileName)){
			$x = Html::tag('h3', 'Results:');
			$x .= HTML::ul([Html::a('sequences', ['site/download', 'name' => 'sequences.txt']), Html::a('words', ['site/download', 'name' => 'words.txt'])], ['encode' => false]);
			
			$return = Html::tag('div', $x, ['class' => 'bg-success results-success']);
            
			return $return;
		}
	}
    
    /**
     * Simple check to make sure our word is long enough to meet our threshold
	 * 
     * The requirements state that only letters (case insensitive) are allowed for our sequence
	 * 
	 * @param	string $word
	 * @return	bool
     */
    private function checkWordLength($word){
        
        if(strlen($word) < $this->seqLength)
            return FALSE;
        
        // If we remove and numbers in the string is it still long enough to meet our threshold?
        $noNumbers = preg_replace('/[0-9]/', '', $word);
        if(strlen($noNumbers) < $this->seqLength)
            return FALSE;
        
        return TRUE;
    }
    
    /**
     * Checks for special case when a word contains an apostrophe
	 * If the word contains an apostrope we check either side of the apostrophe meets our threshold?
	 * This assumes that the word only has one apostrophe.
	 * 
	 * @param	string $word
	 * @return	bool
     */
    private function checkSeqPossible($word){
         
        $pos = strpos($word, "'");        
        if($pos !== FALSE){
            $parts = explode("'", $word);
            if(strlen($parts[0]) < $this->seqLength && strlen($parts[1]) < $this->seqLength)
                return FALSE;    // since neither side of the ' reaches our threshold of SeqLength
        }
        
        return TRUE;
    }


}
