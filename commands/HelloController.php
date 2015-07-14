<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Dictionary;
use app\models\Sequence;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
	
    public $seqLength;
    public $appearance;
	
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }
	
    
    
    
    
    
    
    public function actionTest()
    {
        $startTime = microtime(true);        
        
        $this->seqLength = 4;
        $this->appearance = 1;
        
        $fileName   = 'commands/dictionary.txt';
        // $fileName   = 'commands/dictionary_short.txt';
        $seqFile    = 'commands/sequences.txt';
        $wordFile   = 'commands/words.txt';
        
        $handle     = fopen($fileName, "r");
        $allWords   = file_get_contents($fileName);
        $tried      = array();
        $results    = array();
        $x          = 0;
        
        while (($buffer = fgets($handle, 4096)) !== false) {
           
           if($x % 1000 == 0) echo "$x\n";
            $x++;
           
           $buffer = trim($buffer);
            
           if($this->checkWordLength($buffer) && $this->checkSeqPossible($buffer)){
               
               // echo "$buffer: ";
               
               for ($i=0; $i+$this->seqLength-1 < strlen($buffer) ; $i++) {
                   
                   $str = strtolower(substr($buffer, $i, $this->seqLength));
                   
                   if(preg_match('/\'|[0-9]/', $str) === 0){
                       
                       if(!$tried[$str]){
                           $count = preg_match_all("/$str/i", $allWords);
                           
                           
                           if($count <= $this->appearance){
                               
                               $results[$str] = [
                                    "count" => $count,
                                    "word" => $buffer,
                               ]; 
                               
                               $seq[] = "$str\n";
                               $wrd[] = "$buffer\n";
                               
                           }
                       }
                       
                   }
                   
               }
           }
           
           // echo "\n";
        }
        
        // write sequence to file
       file_put_contents($seqFile, $seq);
       // write word to file
       file_put_contents($wordFile, $wrd);
       
        // foreach ($results as $key => $value) {
            // echo "$key: ". $value['count'] ."  ". $value['word'] ."\n";
        // }
        
        echo count($results) . "\n";
        
        echo "Elapsed time is: ". (microtime(true) - $startTime) ." seconds \n";
        echo memory_get_usage()/1000000 . "\n";
        echo "Peak:" . memory_get_peak_usage()/1000000 . "\n";
        fclose($handle);
    }
    
    
    
    
    
    
    
    
    
    
    
	public function actionDictionary($seqLength = 4, $appearance = 1){
		
		$this->seqLength = $seqLength;
		$this->appearance = $appearance;
		
		$startTime = microtime(true);
		$x = 0;
		
		    $dictionary = Dictionary::find()
		    	->where(['>', 'LENGTH(word)', $seqLength])
		    	
		    	->all();
            Sequence::deleteAll();
            
            foreach ($dictionary as $entry) {
            	
				if($x % 1000 == 0) echo "$x\n";
				$x++;
				
                // Some simple checks on our word
                if($this->checkWordLength($entry->word) && $this->checkSeqPossible($entry->word)){
                	
                    // everything OK so lets continue
                    for ($i=0; $i+$this->seqLength-1 < strlen($entry->word) ; $i++) {
                    	
                        $str = strtolower(substr($entry->word, $i, $this->seqLength));
						
						if(preg_match('/\'|[0-9]/', $str) === 0){
							
							
							
	                        $exists = Sequence::find()
	                            ->where(['like', 'letters', $str])
	                            ->exists();
								
	                        if(!$exists){
	                            
	                            $count = Dictionary::find()
	                                ->where(['like', 'word', $str])
	                                ->count();
	                                
	                            $seq = new Sequence();
	                            $seq->letters   = $str;
	                            $seq->count     = $count;
	                            $seq->word      = $entry->word;
	                            $seq->save(); 
	                            
	                        }
	                        
	                        unset($exists);
						}
                        
                    }
                    
                }
				
            }

		echo "Elapsed time is: ". (microtime(true) - $startTime) ." seconds \n";
			
			// var_dump($dictionary);

	}



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
     * If the word contains an ' does either side meet our threshold?
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
