<?php
	$this->assign('title','TASKTRACKER | Tasks');
	$this->assign('nav','tasks');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/tasks.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Tasks
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="taskCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Project">Project<% if (page.orderBy == 'Project') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Task">Task<% if (page.orderBy == 'Task') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Hours">Hours<% if (page.orderBy == 'Hours') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Startdate">Startdate<% if (page.orderBy == 'Startdate') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Enddate">Enddate<% if (page.orderBy == 'Enddate') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PkColumn">Pk Column<% if (page.orderBy == 'PkColumn') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('pkColumn')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('project') || '') %></td>
				<td><%= _.escape(item.get('task') || '') %></td>
				<td><%= _.escape(item.get('hours') || '') %></td>
				<td><%if (item.get('startdate')) { %><%= _date(app.parseDate(item.get('startdate'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%if (item.get('enddate')) { %><%= _date(app.parseDate(item.get('enddate'))).format('MMM D, YYYY') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('pkColumn') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="taskModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="id" placeholder="Id" value="<%= _.escape(item.get('id') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="projectInputContainer" class="control-group">
					<label class="control-label" for="project">Project</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="project" placeholder="Project" value="<%= _.escape(item.get('project') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="taskInputContainer" class="control-group">
					<label class="control-label" for="task">Task</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="task" placeholder="Task" value="<%= _.escape(item.get('task') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="hoursInputContainer" class="control-group">
					<label class="control-label" for="hours">Hours</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="hours" placeholder="Hours" value="<%= _.escape(item.get('hours') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="startdateInputContainer" class="control-group">
					<label class="control-label" for="startdate">Startdate</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="startdate" type="text" value="<%= _date(app.parseDate(item.get('startdate'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="enddateInputContainer" class="control-group">
					<label class="control-label" for="enddate">Enddate</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="enddate" type="text" value="<%= _date(app.parseDate(item.get('enddate'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="pkColumnInputContainer" class="control-group">
					<label class="control-label" for="pkColumn">Pk Column</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="pkColumn"><%= _.escape(item.get('pkColumn') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTaskButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTaskButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Task</button>
						<span id="confirmDeleteTaskContainer" class="hide">
							<button id="cancelDeleteTaskButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTaskButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="taskDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Task
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="taskModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTaskButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="taskCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTaskButton" class="btn btn-primary">Add Task</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
