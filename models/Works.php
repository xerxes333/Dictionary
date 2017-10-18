<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Dumb model to manage my various works
 */
class Works extends Model
{
    
    private $works = [
        [
            'name' => 'Ridenhour Website',
            'img' => 'ridenhour_screenshot2.jpg',
            'link' => 'http://voteridenhour.com',
            'desc' => "Election website for Mecklenburg County Commissioner Matthew Ridenhour using WordPress with a custom
                        theme and a custom plugin I created.",
        ],
        [
            'name' => 'AQ Node API',
            'img' => 'AQNode_screenshot.jpg',
            'link' => 'http://aqcampaignmanager.com',
            'desc' => 'Guild Manager app for the Arcadia Quest boardgame. 
                The game normally uses pen &amp; paper to track your guild through numerous play sessions so I decided it would be better to have a companion app. 
                The backend API is written with Node.js, MongoDB, and Express.  The frontend is React and Redux.',
        ],
        [
            'name' => 'Payment Portal',
            'img' => 'payment_screenshot.jpg',
            'link' => 'https://initvpayments.com',
            'desc' => 'Portal for clients to make secure payments.  I created this app with the Yii2 framework along with a 
                    custom extension that interacts directly with the Chase Paymentech API rather than using a third-party payment gateway.',
        ],
        [
            'name' => 'Genesis',
            'img' => 'genesis_screenshot.jpg',
            'link' => 'https://donations.inspiration.org/Donations',
            'desc' => 'Donation &amp; Ecommerce platform I created using the Yii1 framework.   
                    Uses the same extension as above for payment resolution.  
                    This also has an API that our custom WordPress plugin connects to for the ecommerce portion.',
        ],
    ];

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [];
    }

    public function getWorks(){
        return $this->works;
    }
    
}
