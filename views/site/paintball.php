<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Triple 3 Studios';


// var_dump($events);
?>


<script src="http://video.limelight.com/player/embed.js"></script>

<div class="site-index">
    <div class="row">        
        <div class="col-md-4" id="Events">
            
            <h3>Impact Matches</h3>
            <ul>
            <?php foreach ($data as $group): ?>
                <?php foreach ($group->episodes as $ep): ?>
                    <?php if( stripos($ep->title, 'impact') !== false && stripos($group->title, '2016') !== false): ?>
                        <li>
                        <a class="episode_link" href="#" media_id="<?php echo $ep->media_id; ?>" media_title="<?php echo $ep->title; ?>">
                            <?php echo $group->title . " - " .  $ep->title; ?>
                        </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </ul>
            
            <?php foreach ($data as $group): ?>
                <h3><?php echo $group->title; ?></h3>
                
                <?php foreach ($group->episodes as $ep): ?>
                    <a class="episode_link" href="#" media_id="<?php echo $ep->media_id; ?>" media_title="<?php echo $ep->title; ?>"><?php echo $ep->title; ?></a><br>
                <?php endforeach; ?>
                
            <?php endforeach; ?>
            
        </div>
        <div class="col-md-8">
            <div class="affix" id="Video">
                <iframe 
                id="ls_embed_1474044710" 
                name ="foo_player"
                src="//livestream.com/accounts/1614555/events/5077429/videos/135888936/player?width=960&height=540&autoPlay=true&mute=false" 
                width="960" 
                height="540" 
                frameborder="0" 
                scrolling="no">
                </iframe>
            </div>    
            
        </div>
    </div>
    
</div>