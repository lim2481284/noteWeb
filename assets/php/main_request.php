

<?php



/*=========================================================================

					Common function section

==========================================================================*/


	 /*
		Handle delete folder request
	*/
	 if( isset($_POST["deleteFolder"])) {
		$path = $_POST["path"];
		deleteFolder($path);
		exit();
     }


	 /*
		Handle delete file  request
	*/
	 if( isset($_POST["deleteFile"])) {
		$path = $_POST["path"];
		deleteFile($path);
		exit();
     }




/*=========================================================================

					Homepage function section

==========================================================================*/


	 /*
		Handle homepage display request
	*/
	 if (empty($_GET) || ( isset($_GET["home"]))) {
		echo "
			<script>
				$(document).ready(function(){
					$('.homepageContentSection').show();
					";
					todoList();

					echo"
				});
			</script>
		";
	 }


	/*
		Handle create todo request
	*/
	 if( isset($_POST["createTodo"])) {
		$project = $_POST["createTodo"];
		createTodo($project);
     }


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

		/*
			Handle edit/delete design content request
		*/
	 if( isset($_POST["editDesignContent"])) {
		$path = $_POST['path'];
		$content = $_POST['content'];
		editDesignContent($path, $content);
		exit();
		 }


	 /*
		Handle design request
	*/
	 if( isset($_GET["designTab"])) {
		$designTab = $_GET["designTab"];
		displayDesignContent($designTab);
   }


	 /*
 		Handle add design request
 	*/
 	 if( isset($_POST["addDesignContent"])) {
 		$content = $_POST['content'];
 		$path = $_POST['path'];
 		addDesignContent($path, $content);
 		exit();
      }



/*=========================================================================

					Work function section

==========================================================================*/


	 /*
		Handle delete folder request -- work
	*/
	 if( isset($_POST["deleteFolder_work"])) {
		$path = $_POST["path"];
		deleteFile("$path/index.html");
		deleteFolder($path);
		exit();
     }


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
		Handle search request
	*/
 if( isset($_POST["search"])) {
		$keyword  = $_POST["keyword"];
		echo "<!----- Data here ---->";
		displaySearchResultDevelopment($keyword);
		exit();
	}

	/*
	 Handle  directory btn request
	*/
	if( isset($_POST["Dir"])) {
			$currentDir = $_POST["currentDir"];

			// To specify string split
			print "<!----- Data here ---->";

			// Get directory
			$Dir = $currentDir;

			if($Dir != 'development/Development/'){
				// Display button
				echo"
						<div class='input-group'>
							<button class='btn btn-default previousDir ' value ='$Dir'> <</button>
						</div>
						<div class='tabList'>
				";

			}

			// Default configuration
			$project = $Dir;
			$projectName = explode("/", $project);
			$key=  end(array_keys($projectName));
			$name =  $projectName[$key];
			$folder = $projectName[$key-1];
			$name = explode(".", $name);


			// Display menu item
			displaySideMenuItem("$Dir","$folder"," $name[0]",'folder');

			echo"
				</div>
			";

			exit();
	};



	/*
	 Handle previous directory btn request
	*/
	if( isset($_POST["prevDir"])) {
			$currentDir = $_POST["currentDir"];

			// To specify string split
			print "<!----- Data here ---->";

			// Get previous directory
			$Dir = $currentDir;
			while(1){
				if(substr("$Dir", -1)=='/')
				{
					$Dir = substr("$Dir", 0, -1);
				}
				else
						break;
			}
			while(1){
				if(substr("$Dir", -1)!='/')
				{
					$Dir = substr("$Dir", 0, -1);
				}
				else
						break;
			}
			while(1){
				if(substr("$Dir", -1)=='/')
				{
					$Dir = substr("$Dir", 0, -1);
				}
				else
						break;
			}

			// Remove duplicate slash
			$Dir =preg_replace('/[\\/]+/', '/', $Dir);
			$dirSize = explode("/", $Dir);
			$dirSize = sizeof($dirSize);
			if($dirSize>2){
				// Display button
				echo"
						<div class='input-group'>
							<button class='btn btn-default previousDir ' value ='$Dir'> <</button>
						</div>
						<div class='tabList'>
				";
			}

			// Default configuration
			$project = $Dir;
			$projectName = explode("/", $project);
			$key=  end(array_keys($projectName));
			$name =  $projectName[$key];
			$folder = $projectName[$key-1];
			$name = explode(".", $name);

			// Display menu item
			displaySideMenuItem("$Dir","$folder"," $name[0]","file");

			echo"
				</div>
			";

			exit();
	};



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
