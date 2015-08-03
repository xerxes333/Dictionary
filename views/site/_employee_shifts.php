<?
/**
 * 
 * Quick and dirty patial render to prety-print the resulting json response
 * 
 */
 
?>
<table class="table table-bordered">
	<tr>
		<th>ID</th>
		<th>Start</th>
		<th>End</th>
		<th>Manager</th>
	</tr>
	
<? foreach($shifts as $shift): 
	$manager = $shift->manager; 
?>
	<tr>
		<td><? echo $shift->id ?></td>
		<td><? echo $shift->start_time ?></td>
		<td><? echo $shift->end_time ?></td>
		<td>
			<strong><? echo $manager->name ?></strong><br>
			<small>Email: <? echo $manager->email ?></small><br>
			<small>Phone: <? echo $manager->phone ?></small><br>
		</td>
	</tr>
	
<? endforeach; ?>
</table>     

