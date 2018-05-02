<?php
	$this->assign('title','TASKTRACKER | Projects');
	$this->assign('nav','projects');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/projects.js").wait(function(){
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
	<i class="icon-th-list"></i> Projects
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="projectCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Project">Project<% if (page.orderBy == 'Project') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_PkColumn">Pk Column<% if (page.orderBy == 'PkColumn') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('pkColumn')) %>">
				<td><%= _.escape(item.get('project') || '') %></td>
				<td><%= _.escape(item.get('pkColumn') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="projectModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="projectInputContainer" class="control-group">
					<label class="control-label" for="project">Project</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="project" placeholder="Project" value="<%= _.escape(item.get('project') || '') %>">
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
		<form id="deleteProjectButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteProjectButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Project</button>
						<span id="confirmDeleteProjectContainer" class="hide">
							<button id="cancelDeleteProjectButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteProjectButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="projectDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Project
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="projectModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveProjectButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="projectCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newProjectButton" class="btn btn-primary">Add Project</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
