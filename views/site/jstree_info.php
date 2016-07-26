<?php  use yii\helpers\Html; ?>

<p>


<b>Create a web UI with a treeview control (such as jstree) that allows multiple users to connect and see the same structure from different locations</b>

<ul>
    <li>Allow each user to create/delete nodes in the tree</li>
    <li>Live update all connected users with any changes to the tree</li>
    <li>The treeview should allow for 2 levels – Parent and Child</li>
    <li>
        The parent nodes function as random number factories. Each parent factory will have the following properties when created:
        <ul>
            <li>The name of the factory</li>
            <li>The random number pool (the pool of numbers from which to choose, e.g. 30 to 200)</li>
        </ul>
    </li>
        
    <li>The child nodes for each factory represent the factory output -> the numbers generated</li>
    <li>When the parent factory is right clicked, allow an option for the generator to run. The input should be the number of numbers to create (only allow 1 to 15 in the number set).</li>
    <li>When the numbers are created, have them created as nodes below the factory (and also delete any previous nodes from previous generator runs)</li>
    <li>Utilize a database so that the information is saved (persistent)</li>
    <li>We should be able to close your web UI and reconnect with it in the same state</li>
    <li>Host the finished product on your own system to demonstrate your knowledge of networking and server setup</li>
</ul>

</p>

<b>Example Test</b>
<p>
John connects to the supplied URL and creates the first factory. Then Chris connects. Chris should see John's factory. 
Chris then right clicks the factory and chooses to generate 5 random numbers from the pool. 
The child nodes are generated with both Chris and John seeing the result.
</p>