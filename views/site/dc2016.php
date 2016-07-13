<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Dragon Con 2015';
// $this->params['breadcrumbs'][] = $this->title;

$year = 2016;

?>
<div class="site-about">




    <div class="row">
        <div class="col-lg-12">
            <?php echo HTML::img("@web/images/300px-Dragonconlogo1.png"); ?>
    
            <span style="font-size: 72px; vertical-align: middle;">
                 <?php echo $year; ?> in 
                <?php echo (date("z",mktime(0,0,0,9,1,$year)) - date("z")) . " Days"; ?>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p>
                <h2>Rooming</h2>
                <ul>
                    <!-- <li>We have one room in the Hyatt and one room in the Marriott again this year</li> -->
                    <!-- <li>We can re-arrange rooming arrangements as necessary once we all arrive</li> -->
                    <!-- <li>Based on last years room prices I anticipate the cost for each person will be approximately $290. (based on 4 person occupancy)</li> -->
                    <li>Please have the cash on hand when you arrive in ATL for rooms, this will make things easier for everyone. </li>
        
                </ul>
            </p>
            
            <div class="col-lg-3">
                <div class="panel panel-dc">
                    <div class="panel-heading">Marriott</div>
                    <div class="panel-body">
                        <ol>
                            <li>Jeremy</li>
                            <li>Mike</li>
                            <li>Dan</li>
                            <li></li>
                        </ol>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="panel panel-dc">
                    <div class="panel-heading">Hyatt 1 ???</div>
                    <div class="panel-body">
                        <ol>
                            <li></li>
                        </ol>
                    </div>
                </div>
            </div>
            
             <div class="col-lg-3">
                <div class="panel panel-dc">
                    <div class="panel-heading">Hyatt 2 ???</div>
                    <div class="panel-body">
                        <ol>
                            <li></li>
                        </ol>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
  
    <div class="row">
        <div class="col-lg-12">
            <p>
                <h2>Transportation</h2>
                Please let me know your plans and available seats so I can share it and we can carpool
            </p>
            
            <div class="col-lg-4">
                <div class="panel panel-dc">
                    <div class="panel-heading">Jeremy</div>
                    <div class="panel-body">
                        <ul>
                            <li>Leaving: Wednesday Aug 31st AM</li>
                            <li class="text-danger">Returning: Tuesday Sep 6th whenever</li>
                            <li>Seats:</li>
                            <ol>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ol>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 hidden">
                <div class="panel panel-dc">
                    <div class="panel-heading">Liz</div>
                    <div class="panel-body">
                        <ul>
                            <li>Leaving: Thursday Sep 3rd AM</li>
                            <li>Returning: Monday Sep 7th whenever</li>
                            <li>Seats:</li>
                            <ol>
                                <li>Amanda</li>
                                <li>Mike (arriving)</li>
                                <li></li>
                            </ol>
                        </ul>
                    </div>
                </div>
            </div>
  
        </div>  
    </div> 
    
    <div class="row">
        <div class="col-lg-12">
            
            <p>
                <h2>Loot</h2>
                Please list any items you are bringing and <b>willing to share</b> with others. *(Keep your receipts if you want to split the cost with others sharing
            </p>
             <div class="col-lg-3">
                <div class="panel panel-dc">
                    <div class="panel-heading">Jeremy</div>
                    <div class="panel-body">
                        <ul>
                            <li>Random Snacks</li>
                            <li>Baileys</li>
                            <li>Capt. Morgan</li>
                            <li>Coke Zero 6pk</li>
                            
                            <li>Electrical Power strip</li>
                            <li>Cooler</li>
                            <li>Laptop</li>
                        </ul>
                    </div>
                </div>
            </div>
            
             <div class="col-lg-3 hidden">
                <div class="panel panel-dc">
                    <div class="panel-heading">Dan</div>
                    <div class="panel-body">
                        <ul>
                            <li>Random Snacks</li>
                            <li>Beer</li>
                            
                            <li>Cooler</li>
                            <li>Binoculars</li>
                            <li>Air Mattress</li>
                        </ul>
                    </div>
                </div>
            </div>
            
             <div class="col-lg-3 hidden">
                <div class="panel panel-dc">
                    <div class="panel-heading">Liz</div>
                    <div class="panel-body">
                        <ul>
                            <li>Cooler</li>
                        </ul>
                    </div>
                </div>
            </div>
            
             <div class="col-lg-3 hidden">
                <div class="panel panel-dc">
                    <div class="panel-heading">Blake</div>
                    <div class="panel-body">
                        <ul>
                            <li>Random Snacks</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>  
    </div>  


</div>
