<!DOCTYPE html>

<html>
<head>

	<!-- Meta list  --> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<!-- Stylesheet for this page --> 
	<link rel="stylesheet" href="assets/css/bootstrap.css"> 		
	<link rel="stylesheet" href="assets/css/sweetalert.css">
	<link  rel="stylesheet" href="assets/css/jquery-te-1.4.0.css" charset="utf-8" />
	<link rel="stylesheet" href="assets/css/main.css"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/editor.css"> 
	<link rel="stylesheet" href="assets/css/jquery.timeliny.css" />
	
	<!-- pre load jquery  --> 
	<script src="assets/js/jquery-3.2.1.min.js"></script>
	
	<!-- Call php function --> 
	<?php include 'assets/php/main_function.php'; ?>
	<?php include 'assets/php/main_request.php'; ?>
	
	
</head>

<body>	


	<!-- Menu bar section   --> 
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">NoteWeb</a>
		</div>
		<ul class="nav navbar-nav">
		 <li><a href="#development">Development</a></li>
		  <li><a href="#documentation">Documentation</a></li>
		  <li><a href="#design">Design</a></li>
		  <li><a href="#project">Project</a></li>
		  <li><a href="?ideatab=Idea list" class='ideaTab' >Idea</a></li>
		  <li><a href="#work">Work</a></li>		  		  	 
		  
		  <li> 			
			<div class="dropdown">
			  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Other
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu">
				<li><a href="#competition" class='findCom'>Find competition</a></li>	
				<li><a href="#" class='timeline'>Timeline</a></li>	
				<li><a href="#" class='setting'>Setting</a></li>
				
			  </ul>
			</div>			
		  </li>
		</ul>
		<form class="navbar-form navbar-right">
		  <div class="input-group">
			<input type="text" class="form-control" placeholder="Search">
			<div class="input-group-btn">
			  <button class="btn btn-default" type="submit">
				<i class="glyphicon glyphicon-search"></i>
			  </button>
			</div>
		  </div>
		</form>
	  </div>
	</nav>


	<!--Main content section  --> 
	<div class='documentationContentSection' >	
		<div class='col-sm-12'>
			<div class='col-sm-2 headlineSection'>
				<div class='headline'>					
				</div>
			</div>
			<div class='col-sm-10 contentMainSection'>
				<div class='topic col-sm-12'></div>
				<div class='tagSection col-sm-12'>

				</div>
				<div class='contentSection col-sm-12'></div>
				<div class=' col-sm-12'>
					<br><br><br><br><br><br><br><br>
				</div>	 
			</div>
		</div>				
	</div>

	

	<!-- Popout for search competition --> 
   <div id="competition" class="overlay">
		<div class="popout">
			<a class="closeBtn" href="#">&times;</a>
			<div class="box">
				<div class='col-sm-12'>
					<h2> Find competition  </h2><button type='button' class='btn btn-default addComBtn'> Add competition  </button>
					
				</div>				
				<div class='col-sm-12 compeititonList'>	
					<script>$(document).ready(function(){ loadCompetition(); });</script>
				</div>
			</div>
		</div>
	</div>			
	
	
	
	<!-- Popout for work section  --> 
   <div id="work" class="overlay">
		<div class="popout">
			<a class="closeBtn" href="#">&times;</a>
			<div class="box">
				<div class='col-sm-12'>
					<h2> Work  </h2>
					<button type='button' class='btn btn-default createNewWork'> New work  </button>		
				</div>				
				<div class='col-sm-12 menuList'>
					<?php listMenu_work(); ?>									
				</div>

			</div>
		</div>
	</div>		
	
	<!-- Popout for documentation section  --> 
   <div id="documentation" class="overlay">
		<div class="popout">
			<a class="closeBtn" href="#">&times;</a>
			<div class="box">
				<div class='col-sm-12'>
					<h2> Documentation </h2>
					<button type='button' class='btn btn-default createNewDocument'> New documentation </button>		
				</div>				
				<div class='col-sm-12 menuList'>
					<?php listMenu(); ?>									
				</div>

			</div>
		</div>
	</div>	


	<!-- Popout for development section  --> 
   <div id="development" class="overlay">
		<div class="popout">
			<a class="closeBtn" href="#">&times;</a>
			<div class="box">
				<div class='col-sm-12'>
					<h2> Development </h2>
					<button type='button' class='btn btn-default createNewDevelopment'> New Development </button>		
				</div>				
				<div class='col-sm-12 menuList'>
					<?php listMenu_development(); ?>									
				</div>

			</div>
		</div>
	</div>			

	<!-- Popout for add idea   --> 
   <div id="addIdea" class="overlay">
		<div class="popout">
			<a class="closeBtn" href="#">&times;</a>
			<div class="box">
				<div class='col-sm-12'>
					<h2 class='ideaPopoutTitle'> Add idea </h2>					
				</div>			
			    <br><br><br><br>
				<div class='col-sm-11 inputArea'>	
					<div class='col-sm-1 noPadding'>
						<label class='inputAreaLabel '> Title </label>
					</div>
					<div class='col-sm-6'>
						<input class=' form-control ideaTitle'/>
					</div>
				</div>
				<div class='col-sm-11 inputArea'>
					<div class='col-sm-1 noPadding'>
						<label class='inputAreaLabel'> Tag </label>
					</div> 
					<div class='col-sm-6 tagArea'>						
						<button class='btn btn-default addTagBtn'> Add tag </button>
						<datalist class='tagDataList' id="tagDataList">							
						</datalist>						
					</div>					
				</div>
				<div class='col-sm-12 inputArea'>
					<div class='col-sm-1 noPadding'>
						<label class='inputAreaLabel'> Description </label>
					</div>				
				</div>
				<div class='col-sm-11 '>
					
					<textarea id='txtEditor_idea'> </textarea>					
				</div>
				<div class='col-sm-12 '>
					
					<button class='addNewIdea btn btn-primary'>Add</button>	
				</div>

				
			</div>
		</div>
	</div>

	<!-- timeline here 
	<div class='container'>
		<div id="timeline">
			<div data-year="2016" class="active">Short text here</div>
			<div data-year="2011">Short text here</div>
			<div data-year="2010">Short text here</div>
		</div>	
	</div>
	-->
	
	
</body>


<!-- Script for this page  --> 
<script src="assets/js/sweetalert.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="assets/js/editor.js"></script>
<script src="assets/js/jquery.timeliny.js"></script>
</html>
