<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Triple 3 Studios';

?>



<div class="site-index">
    <div class="row">        
        <div class="col-md-4" id="Events">
            <?php foreach ($data as $group): ?>
                <h3><?php echo $group->title; ?></h3>
                
                <?php foreach ($group->episodes as $ep): ?>
                    <a class="episode_link" href="#" media_id="<?php echo $ep->media_id; ?>" media_title="<?php echo $ep->title; ?>"><?php echo $ep->title; ?></a><br>
                <?php endforeach; ?>
                
            <?php endforeach; ?>
            
        </div>
        <div class="col-md-8" id="Video">

            <!-- ngIf: freebeeLoaded -->
            <limelightplayer style="" class="" media="ce6bbc4a435a42a9938c549bc9021230" ng-if="freebeeLoaded">
                <a style="border:0;clip:rect(0 0 0 0);display:block;height:1px;margin:-1px;outline:none;overflow:hidden;padding:0;position:absolute;width:1px;" title="Flash start" tabindex="-1" href="#limelight_player_45041" id="beforeswfanchor0"></a>
                <object tabindex="0" 
                type="application/x-shockwave-flash" autoplay="true" id="limelight_player_45041" name="limelight_player_45041" 
                class="LimelightEmbeddedPlayerFlash swfPrev-beforeswfanchor0 swfNext-afterswfanchor0" 
                data="//video.limelight.com/player/loader.swf" height="537px" width="100%"> 
                    <param name="movie" value="https://video.limelight.com/player/loader.swf"> 
                    <param name="wmode" value="window"> 
                    <param name="allowScriptAccess" value="always">
                    <param name="allowFullScreen" value="true">
                    <param name="flashVars" value="playerForm=fc40dbd8074e41dcb70d5f47bbf85da1&amp;autoplay=false&amp;autoplayNextClip=true&amp;mediaId=ce6bbc4a435a42a9938c549bc9021230"> 
                </object>
                <a style="border:0;clip:rect(0 0 0 0);display:block;height:1px;margin:-1px;outline:none;overflow:hidden;padding:0;position:absolute;width:1px;" title="Flash end" tabindex="-1" href="#limelight_player_45041" id="afterswfanchor0"></a>
            </limelightplayer>
            <!-- end ngIf: freebeeLoaded --> 

        </div>
    </div>
    
</div>