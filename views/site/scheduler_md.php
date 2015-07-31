<h1 id="rest-scheduler-api">REST Scheduler API</h1>

<p>
	While we will accept a framework of your choice, and a language of your choice, we <em>highly</em> encourage using <strong>PHP*</strong> and one of the following frameworks: <a href="https://github.com/sparkphp/Project">Spark</a>, <a href="https://github.com/radarphp/Radar.Project">Radar</a>, or <a href="https://github.com/alexbilbie/proton">Proton</a>.
</p>

<p>
	If you choose to use another language, please be prepared to show fluency in multiple languages (including at least one <a href="https://en.wikipedia.org/wiki/List_of_C-family_programming_languages">C-family language</a>), and knowledge of multiple design principles (<a href="https://en.wikipedia.org/wiki/Don%27t_repeat_yourself">DRY</a>, <a href="https://en.wikipedia.org/wiki/Open/closed_principle">Open/Closed</a>, etc) and patterns (<a href="https://en.wikipedia.org/wiki/Factory_method_pattern">Factory</a>, <a href="https://en.wikipedia.org/wiki/Data_mapper_pattern">DataMapper</a>, etc).
</p>

<p>
	<sub><sup>* Our core application is written almost entirely in PHP and JS.</sup></sub>
</p>

<h2 id="requirements">Requirements</h2>

<p>
	The API must follow REST specification:
</p>

<ul>
	<li>
		POST should be used to create
	</li>
	<li>
		GET should be used to read
	</li>
	<li>
		PUT should be used to update (and optionally to create)
	</li>
	<li>
		DELETE should be used to delete
	</li>
</ul>

<p>
	Additional methods can be used for expanded functionality.
</p>

<p>
	The API should include the following roles:
</p>

<ul>
	<li>
		employee (read)
	</li>
	<li>
		manager (write)
	</li>
</ul>

<p>
	The <code>
		employee</code>
	will have much more limited access than a <code>
		manager</code>
	. The specifics of what each role should be able to do is listed below in <a href="#user-stories">User Stories</a>.
</p>

<h2 id="data-types">Data Types</h2>

<p>
	All data structures use the following types:
</p>

<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered">
        <thead>
        <tr>
        	<th>type</th>
        	<th>description</th>
        </tr>
        </thead>
        <tbody>
        	<tr>
        		<td>int</td>
        		<td>a integer number</td>
        	</tr>
        	<tr>
        		<td>float</td>
        		<td>a floating point number</td>
        	</tr>
        	<tr>
        		<td>string</td>
        		<td>a string</td>
        	</tr>
        	<tr>
        		<td>bool</td>
        		<td>a boolean</td>
        	</tr>
        	<tr>
        		<td>id</td>
        		<td>a unique identifier</td>
        	</tr>
        	<tr>
        		<td>fk</td>
        		<td>a reference to another id</td>
        	</tr>
        	<tr>
        		<td>date</td>
        		<td>an RFC 2822 formatted date string</td>
        	</tr>
        </tbody></table>
    </div>
</div>

<h2 id="data-structures">Data Structures</h2>

<h3 id="user">User</h3>

<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered">
	<thead>
		<tr>
			<th>field</th>
			<th>type</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>id</td>
			<td>id</td>
		</tr>
		<tr>
			<td>name</td>
			<td>string</td>
		</tr>
		<tr>
			<td>role</td>
			<td>string</td>
		</tr>
		<tr>
			<td>email</td>
			<td>string</td>
		</tr>
		<tr>
			<td>phone</td>
			<td>string</td>
		</tr>
		<tr>
			<td>created_at</td>
			<td>date</td>
		</tr>
		<tr>
			<td>updated_at</td>
			<td>date</td>
		</tr>
	</tbody>
</table>
</div>
</div>

<p>
	The <code>role</code> must be either <code>employee</code> or <code>manager</code>. At least one of <code>phone</code> or <code>email</code> must be defined.
</p>

<h3 id="shift">Shift</h3>

<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered">
        	<thead>
        		<tr>
        			<th>field</th>
        			<th>type</th>
        		</tr>
        	</thead>
        	<tbody>
        		<tr>
        			<td>id</td>
        			<td>id</td>
        		</tr>
        		<tr>
        			<td>manager_id</td>
        			<td>fk</td>
        		</tr>
        		<tr>
        			<td>employee_id</td>
        			<td>fk</td>
        		</tr>
        		<tr>
        			<td>break</td>
        			<td>float</td>
        		</tr>
        		<tr>
        			<td>start_time</td>
        			<td>date</td>
        		</tr>
        		<tr>
        			<td>end_time</td>
        			<td>date</td>
        		</tr>
        		<tr>
        			<td>created_at</td>
        			<td>date</td>
        		</tr>
        		<tr>
        			<td>updated_at</td>
        			<td>date</td>
        		</tr>
        	</tbody>
    </table>
</div>
</div>

<p>
	Both <code>start_time</code> and <code>end_time</code> are required. Unless defined, the <code>manager_id</code>
	should always default to the manager that created the shift. Any shift without an <code>employee_id</code> will be visible to all employees.
</p>

<h2 id="user-stories">User stories</h2>

<p>
	<strong>Please note that this not intended to be a CRUD application.</strong> Only the functionality described by the user stories should be exposed via the API.
</p>

<ul>
	<li>
		[ ] As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me.
	</li>
	<li>
		[ ] As an employee, I want to know who I am working with, by being able see the employees that are working during the same time period as me.
	</li>
	<li>
		[ ] As an employee, I want to know how much I worked, by being able to get a summary of hours worked for each week.
	</li>
	<li>
		[ ] As an employee, I want to be able to contact my managers, by seeing manager contact information for my shifts.
	</li>
	<li>
		[ ] As a manager, I want to schedule my employees, by creating shifts for any employee.
	</li>
	<li>
		[ ] As a manager, I want to see the schedule, by listing shifts within a specific time period.
	</li>
	<li>
		[ ] As a manager, I want to be able to change a shift, by updating the time details.
	</li>
	<li>
		[ ] As a manager, I want to be able to assign a shift, by changing the employee that will work a shift.
	</li>
	<li>
		[ ] As a manager, I want to contact an employee, by seeing employee details.
	</li>
</ul>