<?php  use yii\helpers\Html; ?>

<p>

    <p>
        Create a simple goal tracking application using PHP. There is not a right or wrong way to solve
        this. The purpose of the test is to gain some insight into how you think and program. Please
        spend no more than 3 hours. You can use any existing frameworks or libraries.
    </p>
    
    <p>
        A database schema should be created demonstrating how you would model the data. Sample
        controllers and models should be written. You may use additional design patterns (e.g services,
        repositories, interfaces, adapters, factories) where appropriate. Not every controller/model
        needs to be complete, but can contain well commented pseudocode. We do not expect you to
        complete this test in the allotted time, but try to demonstrate as much as possible of how you
        would solve the problem. You can provide whiteboarding sketches or ERDs if you want.
    </p>
    
    <h2>Goal tracking system requirements</h2>
    <hr>
    
    The application should be able to do the following:

    <ul>
        <li>create a basic account (email/password only)</li>
        <li>create, read, update, delete goals</li>
        <li>
            set milestones for those goals
            <ul>
                <li>For example, milestones for "Be able to run a 10K" might be "Run 10 miles a week", or "Run a 5K"</li>
            </ul>
        </li>
        <li>
            track/log progress toward those goals
            <ul>
                <li>For example, log "I ran 3 miles today."</li>
            </ul>
        </li>
        <li>Goals can be of many different and varied data types (nominal, ordinal, interval).</li>
        <li>
            Examples of goals could be:
            <ul>
                <li>Raise my grade in English from a B to an A</li>
                <li>Lose 10 lbs</li>
                <li>Learn Mandarin</li>
                <li>Eat less sugar</li>
                <li>Be able to run a 10K</li>
            </ul>
        </li>
    </ul>
    
    The system should be flexible enough so that new goal types can be easily implemented. 
    Hint: google “database design schema for tracking progress over time”.

</p>
