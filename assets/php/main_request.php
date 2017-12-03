

<?php




/*=========================================================================

					Documentation function section

==========================================================================*/

	 /*
		Handle Save note request  
	*/	
	 if( isset($_POST["saveNote"])) {
		$content = $_POST['content'];
		$path = $_POST['path'];		
		saveNote($path, $content);
		exit();		
     }

	
	/*
		Handle create documentation request 
	*/	
	 if( isset($_POST["createDocumentation"])) {
		$project = $_POST["createDocumentation"];
		createDocumentation($project);		
     }
	 
	 
	  
	/*
		Handle display note request 
	*/	
	 if( isset($_GET["documentation"])) {
		$project = $_GET["documentation"];
		displayNote($project);
     }
	 

	 /*
		Handle DOM call function request  
	*/	
	 if( isset($_POST["callFunction"])) {
		listMenu();
		exit();		
     }
	 
	 
	 /*
		Handle create child request 
	*/	
	 if( isset($_POST["createChild"])) {
		$name = $_POST["createChild"];
		$type = $_POST["createDocumentationType"];
		$path = $_POST["path"];		
		createChild($path, $name, $type);		
     }



/*=========================================================================

					Timeline function section

==========================================================================*/





/*=========================================================================

					Design function section

==========================================================================*/





/*=========================================================================

					Work function section

==========================================================================*/




	/*
		Handle file upload request  
	*/	
	 if(isset($_POST["submit"])) {
		$target_dir = $_POST['path'];
		$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
		if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
			echo "
			<script>
				console.log('upload success');
			</script>";
		} else {
			echo "
			<script>
				alert('failed');
			</script>";
		}
	}

	
	
	/*
		Handle create work tab request 
	*/	
	 if( isset($_POST["createWorkTab"])) {
		$tab = $_POST['workTab'];
		$path = $_POST['path'];
		createWorkTab($tab,$path);
		exit();
     }
	 	

	 
	 /*
		Get work file 
	*/	
	 if( isset($_GET["work"])) {
		$file = $_GET["work"];
		if(!(isset($_GET["current"])))
			$current = 0;
		else 
			$current = $_GET["current"];		
			
		displayWorkContent($file,$current);
     }
	 	 	 
	 /*
		Handle Save work request  
	*/	
	 if( isset($_POST["saveWork"])) {
		$content = $_POST['content'];
		$path = $_POST['path'];		
		saveNote($path, $content);
		exit();		
     }	 
	 
		 
	/*
		Handle create work request 
	*/	
	 if( isset($_POST["createWork"])) {
		$project = $_POST["createWork"];
		createWork($project);		
     }
	 	 
	 /*
		Handle DOM call function request  
	*/	
	 if( isset($_POST["callFunction_work"])) {
		listMenu_work();
		exit();		
     }
	 	 
		
		

/*=========================================================================

					Idea function section

==========================================================================*/





	/*
		Handle edit/delete idea content request 
	*/	
	 if( isset($_POST["editIdeaContent"])) {		
		$path = $_POST['path'];
		$content = $_POST['content'];
		editIdeaContent($path, $content);
		exit();
     }

	/*
		Handle refresh idea content request 
	*/	
	 if( isset($_POST["refreshIdeaContent"])) {		
		$path = $_POST['path'];
		displayIdeaContent($path);
		exit();
     }
	

	/*
		Handle add idea request 
	*/	
	 if( isset($_POST["addIdeaContent"])) {
		$content = $_POST['content'];
		$path = $_POST['path'];
		addIdeaContent($path, $content);
		exit();
     }

	
	/*
		Handle create idea tab request 
	*/	
	 if( isset($_POST["createIdeaTab"])) {
		$tab = $_POST['ideaTab'];
		createIdeaTab($tab);
		exit();
     }
	  
	  
	 /*
		Handle idea request  
	*/	
	 if( isset($_GET["ideatab"])) {
		$ideatab = $_GET["ideatab"];
		displayIdeaContent($ideatab);
     }
	 

	 
	 
/*=========================================================================

					Project function section

==========================================================================*/



/*=========================================================================

					Development function section

==========================================================================*/

	 /*
		Handle create development child request 
	*/	
	 if( isset($_POST["createDevelopmentChild"])) {
		$name = $_POST["createDevelopmentChild"];
		$type = $_POST["createDocumentationType"];
		$path = $_POST["path"];		
		createChild($path, $name, $type);		
     }


	 /*
		Handle DOM call function request  
	*/	
	 if( isset($_POST["callFunction_development"])) {
		listMenu_development();
		exit();		
     }
	 

	/*
		Handle create documentation request 
	*/	
	 if( isset($_POST["createDevelopment"])) {
		$project = $_POST["createDevelopment"];
		createDevelopment($project);		
     }


	  
	/*
		Handle display development request 
	*/	
	 if( isset($_GET["development"])) {
		$project = $_GET["development"];
		displayDevelopment($project);
     }
	 	 
	 
/*=========================================================================

					Competition function section

==========================================================================*/

	
	/*
		Handle add competition request 
	*/	
	 if( isset($_POST["addCom"])) {
		$addCom = $_POST['addCom'];
		addCom($addCom);
		exit();
     }	 
	 
			 
	 

?>