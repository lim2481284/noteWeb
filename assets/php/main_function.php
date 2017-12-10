

<?php




/*=========================================================================

						Share function section 
						
==========================================================================*/


	/*
		Delete folder function 
	*/
	
	function deleteFolder($path)
	{					
		rmdir("$path");
						
	}

	/*
		Delete file function 
	*/
	
	function deleteFile($path)
	{					
		unlink("$path");
						
	}


/*=========================================================================

						Share function section 
						
==========================================================================*/

	/*
		Call todo menu list 
	*/
	
	function todoList()
	{	
		 $directories = glob('homepage/todo/*' , GLOB_ONLYDIR);		
		 $count =0;
		 foreach ($directories as &$projectName) {
			$projectName = explode("/", $projectName);
			$projectList = "
				<li value='homepage/todo/$projectName[2]'>
					$projectName[2]
					<button type='button' value='homepage/todo/$projectName[2]' class='btn btn-default  deleteBtn_work menuBtn'>
						x 
					</button> 
				</li>
			";		
			echo "
				$('.todoSideMenu').append(`$projectList`);
			";
			$count++;
		 }
	
	}	
	

	/*
		Create todo function
	*/
	
	function createTodo($name)
	{					
		mkdir("homepage/todo/$name", 0700);
		$file = fopen("homepage/todo/$name/index.html", "w");
		fwrite($file, $content);
		fclose($file);		
	}


/*=========================================================================

					Documentation function section

==========================================================================*/

	

	/*
		Save Note function
	*/
	
	function saveNote($path, $content)
	{					
		$file = fopen("$path", "w");
		fwrite($file, $content);
		fclose($file);
						
	}



	/*
		Display Note function
	*/
	function displayNote($project)
	{
		$projectName = explode("/", $project);
		$key=  end(array_keys($projectName));
		$name =  $projectName[$key];
		$name = explode(".", $name);
		echo"
			<script>				
				$(document).ready(function(){
					$('.documentationContentSection').show();
					$('.topic').html('$name[0]<button class=\'btn btn-default editBtn\'> Edit </button><input type=\"hidden\" value=\"$project\" class=\"pathName\"/>');
					$('.contentSection').load(encodeURI(\"$project\"));					
				});			 			
			</script>		
		";		
	}

	
	/*
		Create documentation function
	*/
	function createDocumentation($name)
	{
		mkdir("documentation/$name", 0700);
	}
	
	
	function createChild($path , $name, $type)
	{
		if($type=='note')
		{
			$css = fopen("$path/$name.html", "a+");
			fclose($css);
		}	
		else if ($type=='code')
		{
			$css = fopen("$path/$name.html", "a+");
			fclose($css);			
			if (!file_exists("$path/assets")) {
				mkdir("$path/assets", 0777, true);
				mkdir("$path/assets/css", 0777, true);
				mkdir("$path/assets/responsive", 0777, true);
				mkdir("$path/assets/js", 0777, true);
				mkdir("$path/assets/plugin", 0777, true);
				mkdir("$path/assets/image", 0777, true);
				mkdir("$path/assets/sql", 0777, true);
				mkdir("$path/assets/php", 0777, true);
				mkdir("$path/assets/other", 0777, true);
			}
			$css = fopen("$path/assets/responsive/$name.css", "a+");
			fclose($css);		
			$css = fopen("$path/assets/responsive/$name.txt", "a+");
			fclose($css);	
			$css = fopen("$path/assets/css/$name.css", "a+");
			fclose($css);		
			$css = fopen("$path/assets/css/$name.txt", "a+");
			fclose($css);		
			$css = fopen("$path/assets/js/$name.js", "a+");
			fclose($css);	
			$css = fopen("$path/assets/js/$name.txt", "a+");
			fclose($css);		
			$css = fopen("$path/assets/php/$name.php", "a+");
			fclose($css);	
			$css = fopen("$path/assets/php/$name.txt", "a+");
			fclose($css);
			$css = fopen("$path/assets/sql/$name.txt", "a+");
			fclose($css);			
		}
		else 
			mkdir("$path/$name", 0700);
	}
	
	
	/*
		Get file function 
	 */		 
	 function checkFile($currentDir)
	 {		 
		 $file = glob("$currentDir/*.html" );			 
		 if($file)
			echo "<ul>";
		 foreach ($file as &$projectName) {
			$projectName = explode("/", $projectName);
			$key=  end(array_keys($projectName));
			$name =  $projectName[$key];
			$name = explode(".", $name);			
			$projectList =  " <li class='fileItem'><a href='?documentation=$currentDir/$projectName[$key]'> $name[0] </a><button type='button' value='$currentDir/$projectName[$key]' class='btn btn-default  deleteFileBtn menuBtn'> x </button></li>";
			echo $projectList;						
		 }	
		 if($file)
			echo "</ul>";	
	 }
	
	
	/*
		Get folder function 
	 */		 
	 function checkList($currentDir)
	 {
		 $directories = glob("$currentDir/*" , GLOB_ONLYDIR);			 
		 if($directories)
			echo "<ul>";
		 foreach ($directories as &$projectName) {
			$projectName = explode("/", $projectName);
			$key=  end(array_keys($projectName));
			$projectList =  " <li> $projectName[$key] <button type='button' value='$currentDir/$projectName[$key]' class='btn btn-default createBtn'> + </button><button type='button' value='$currentDir/$projectName[$key]' class='btn btn-default  deleteBtn menuBtn'> x </button> </li>";
			echo $projectList;			
			checkList("$currentDir/$projectName[$key]");
			checkFile("$currentDir/$projectName[$key]");
		 }	
		 if($directories)
			echo "</ul>";	
	 }
	 
	 /*
		List parent project function -- for documentation
	 */		 
	 function listMenu()
	 {
		 $directories = glob('documentation/*' , GLOB_ONLYDIR);		
		 //$files = glob('documentation/*.html');
		 $count =0;
		 foreach ($directories as &$projectName) {
			$projectList = "<div class='menuItem'> <ul class='itemList'> ";
			echo $projectList;
			$projectName = explode("/", $projectName);
			$projectList =  "<li class='test' href='#$count' data-toggle='collapse'>$projectName[1] <button type='button' value='documentation/$projectName[1]' class='btn btn-default createBtn'> + </button><button type='button' value='documentation/$projectName[1]' class='btn btn-default  deleteBtn menuBtn'> x </button> </li>
			<div id='$count' class='collapse'>";
			echo $projectList;			
			checkList("documentation/$projectName[1]");
			checkFile("documentation/$projectName[1]");
			$projectList = "</div></ul></div>";
			echo $projectList;
			$count++;
		 }
		 
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
		Create work tab function
	*/
	function createWorkTab($tab,$path)
	{
		mkdir("work/$path/$tab", 0700);		
		$file = fopen("work/$path/$tab/index.html", "a+");
		fclose($file);
	}	
	
	 /*
		Display work menu at side menu tab function
	 */		 
	 function listWorkTab($currentWork,$currentTab)
	 {
		 $directories = glob("work/$currentWork/*" , GLOB_ONLYDIR);				 		 
		 $projectList="<div class='ideaTabListMenu'> <ul class='ideaList'> ";
		 echo $projectList;		
		 $c = $currentTab;
		 foreach ($directories as $projectName) {					
			$projectName = explode("/", $projectName);	
				
			if($currentTab=='0')
			{	
				
				$projectList="<a href='?work=$currentWork&current=$projectName[2]'><li  class='ideaListItem active' value='$projectName[2]' >$projectName[2] </li></a>";		
				$currentTab=1;
				$c =$projectName[2];
			}
			else 
			{				
				if($currentTab == $projectName[2])
					$projectList="<a href='?work=$currentWork&current=$projectName[2]'><li  class='ideaListItem active' value='$projectName[2]' >$projectName[2]<button type='button' value='work/$currentWork/$projectName[2]' class='btn btn-default  deleteBtn_work menuBtn sideMenuBtn'> x </button> </li></a>";		
				else 
					$projectList="<a href='?work=$currentWork&current=$projectName[2]'><li class='ideaListItem' value='$projectName[2]' >$projectName[2]  <button type='button' value='work/$currentWork/$projectName[2]' class='btn btn-default  deleteBtn_work menuBtn sideMenuBtn'> x </button></li></a>";	
			}				
			echo $projectList;			
		 }
		 $projectList="</ul></div> ";
		 echo $projectList;	
		 
		 return $c;
				 
	 }
	 
	
	/*
		Create documentation function-- work
	*/
	function createWork($name)
	{
		mkdir("work/$name", 0700);
	}		

	
	 /*
		List parent project function  -- for work 
	 */		 
	 function listMenu_work()
	 {
		 $directories = glob('work/*' , GLOB_ONLYDIR);				 
		 $count =0;
		 foreach ($directories as &$projectName) {
			$projectList = "<div class='menuItem'> <ul class='itemList'> ";
			echo $projectList;
			$projectName = explode("/", $projectName);
			$projectList =  "<li class='test' href='#$count'><a href='?work=$projectName[1]'> $projectName[1]</a>  </button><button type='button' value='work/$projectName[1]' class='btn btn-default  deleteBtn menuBtn'> x </button></li>";
			echo $projectList;						
			$projectList = "</div></ul>";
			echo $projectList;
			$count++;
		 }
		 
	 }	 	



/*=========================================================================

					Idea function section

==========================================================================*/







	/*
		Edit or delete idea function 
	*/
	
	function editIdeaContent($path, $content)
	{			
	
		$file = fopen("idea/$path/index.html", "w");
		fwrite($file, $content);
		fclose($file);				
	}
	
	
	/*
		Add new idea function 
	*/
	
	function addIdeaContent($path, $content)
	{			
	
		//prepend
		$cache_new = "$content"; // this gets prepended
		$file = "idea/$path/index.html"; // the file to which $cache_new gets prepended

		$handle = fopen($file, "r+");
		$len = strlen($cache_new);
		$final_len = filesize($file) + $len;
		$cache_old = fread($handle, $len);
		rewind($handle);
		$i = 1;
		while (ftell($handle) < $final_len) {
		  fwrite($handle, $cache_new);
		  $cache_new = $cache_old;
		  $cache_old = fread($handle, $len);
		  fseek($handle, $i * $len);
		  $i++;
		}
		
		//append 
		/*
		$file = fopen("idea/$path/index.html", "a");
		fwrite($file, $content);
		fclose($file);		
		*/
	}
	
	
	/*
		Create idea tab function
	*/
	function createIdeaTab($tab)
	{
		mkdir("idea/$tab", 0700);		
		$file = fopen("idea/$tab/index.html", "a+");
		fclose($file);
	}
	

	/*
		Display idea content function 
	*/
	
	function displayWorkContent($file,$current)
	{	
	
		//Display idea content 
		echo"
			<script>
				$(document).ready(function(){					
					$('.headline').attr('class','sidemenu');
					$('.sidemenu').html(`
						<div class='input-group'>
							<input type='text' class='form-control' placeholder='Search'>
							<div class='input-group-btn'>
							  <button class='btn btn-default' type='submit'>
								<i class='glyphicon glyphicon-search'></i>
							  </button>
							</div>
						</div>
						<div class='tabList'>
						";
						
						$currentTab = listWorkTab("$file","$current");		// display idea side menu tab 
						$path = "work/$file/currentTab";
		echo "
						</div>
						<center><button class='btn btn-default createTabBtn_work' value='$file'>Create Tab</button></center>
					`);
					$('.topic').html(`					
						$currentTab
						<button  class=\'btn btn-default editBtn_work\' type=\'button\' value=\'work/$file/$currentTab/index.html\'>
							Edit	
						</button>
						<form action='' class='uploadForm' id='uploadForm' method='post' enctype='multipart/form-data'>
							<div class='file-input-wrapper'>
								<button class='btn btn-default uploadFileBtn' value=\'work/$file/$currentTab/\'>Upload File</button>
								<input type='file' name='fileUpload'  class='profileFileUpload' onchange='readURL(this, \"$path\",\"hideSubmitBtn\");'/>
								<input type='hidden' value=\'work/$file/$currentTab/\'/ name='path'>
								<button type='submit' name='submit' class='hideSubmitBtn'>Submit</button>
							</div>
						</form>
					`);
					
					$('.tagSection').html(`
						 <div class='panel-group' id='accordion'>
							<div class='panel panel-default'>
							  <div class='panel-heading'>
								<h4 class='panel-title'>
								  <a data-toggle='collapse' data-parent='#accordion' href='#collapse1'>File</a>
								</h4>
							  </div>							  
							  <div id='collapse1' class='panel-collapse collapse'>
								<div class='tag-body'>																	
								</div>
							  </div>
							</div>  
						</div> 					
						<label class='totalIdea'> </label>
					`);
					
					$('.documentationContentSection').show();
					
					//Display idea content by load the html document 
					$('.contentSection').load(encodeURI('work/$file/$currentTab/index.html'),function(){
						";
						
						 $files = glob("work/$file/$currentTab/*");	
					     echo " $('.tag-body').append('<ul class=\'fileLink\'>');";	
						 foreach ($files as $projectName) {		
								$projectName = explode("/", $projectName);	
								if($projectName[3]!='index.html')
								{
									echo " $('.tag-body').append('<li><a href=\"work/$file/$currentTab/$projectName[3]\" download=\"$projectName[3]\"> $projectName[3]</a></li>');";
								}
						 }
						 echo " $('.tag-body').append('</ul>');";	
				echo "});
									
										
					
				});
				
			</script>
		";
		
		
		
						
	}
	

	/*
		Display idea content function 
	*/
	
	function displayIdeaContent($ideatab)
	{	
	
		//Display idea content 
		echo"
			<script>
				$(document).ready(function(){					
					$('.headline').attr('class','sidemenu');
					$('.sidemenu').html(`
						<div class='input-group'>
							<input type='text' class='form-control' placeholder='Search'>
							<div class='input-group-btn'>
							  <button class='btn btn-default' type='submit'>
								<i class='glyphicon glyphicon-search'></i>
							  </button>
							</div>
						</div>
						<div class='tabList'>
						";
						
						listIdeaTab("$ideatab");		// display idea side menu tab 
						
		echo "
						</div>
						<center><button class='btn btn-default createTabBtn'>Create Tab</button></center>
					`);
					$('.topic').html('$ideatab<a href=\'#addIdea\'><button  class=\'btn btn-default addIdeaBtn\' type=\'button\' value=\'$ideatab\'>Add Idea	</button></a> ');
					$('.tagSection').html(`
						 <div class='panel-group' id='accordion'>
							<div class='panel panel-default'>
							  <div class='panel-heading'>
								<h4 class='panel-title'>
								  <a data-toggle='collapse' data-parent='#accordion' href='#collapse1'>Filter by tag</a>
								</h4>
							  </div>							  
							  <div id='collapse1' class='panel-collapse collapse'>
								<div class='tag-body'>								
									
								</div>
							  </div>
							</div>  
						</div> 					
						<label class='totalIdea'> </label>
					`);
					
					$('.documentationContentSection').show();
					
					//Display idea content by load the html document 
					$('.contentSection').load(encodeURI('idea/$ideatab/index.html'),function(){
						
						//Get list of tag option 
						var tagList =  $('.tagListItem');	
						var arr =[];
						for(var i = 0; i < tagList.length; i++){
							var tagName = $(tagList[i]).html();
							tagName = $.trim(tagName);
							arr.push(tagName);
						}
						$.unique(arr.sort());
						$('.tag-body').prepend(`
							<label class='checkbox-inline'><input type='checkbox' class='checkbox_all checkbox' value='all'>All</label>
						`);						
						for(var i = 0; i < arr.length; i++){							
							$('.tag-body').append(`
								<label class='checkbox-inline'><input type='checkbox' class='checkbox' value='`+arr[i]+`'>`+arr[i]+`</label>
							`);
							$('.tagDataList').append(`
								<option value='`+arr[i]+`'></option>
							`);
						}
						$('.ideaTable').show();
						var totalIdea = $('.ideaTable');
						$('.totalIdea').html('Total idea : '+totalIdea.length );
							
					});		
					
									
										
					
				});
				
			</script>
		";
		
		
		
						
	}
	
	
	 /*
		Display idea side menu tab function
	 */		 
	 function listIdeaTab($currentTab)
	 {
		 $directories = glob('idea/*' , GLOB_ONLYDIR);				 		 
		 $projectList="<div class='ideaTabListMenu'> <ul class='ideaList'> ";
		 echo $projectList;		
		 foreach ($directories as &$projectName) {					
			$projectName = explode("/", $projectName);
			if($currentTab == $projectName[1])
				$projectList="<a href='?ideatab=$projectName[1]'><li  class='ideaListItem active' value='$projectName[1]' >$projectName[1] </li></a>";		
			else 
				$projectList="<a href='?ideatab=$projectName[1]'><li class='ideaListItem' value='$projectName[1]' >$projectName[1] </li></a>";		
			echo $projectList;			
		 }
		 $projectList="</ul></div> ";
		 echo $projectList;	
				 
	 }
	 
	


/*=========================================================================

					Project function section

==========================================================================*/



/*=========================================================================

					Development function section

==========================================================================*/


	
	/*
		Display development function
	*/
	function displayDevelopment($project)
	{
		$projectName = explode("/", $project);
		$key=  end(array_keys($projectName));
		$name =  $projectName[$key];
		$folder = $projectName[$key-1];		
		$name = explode(".", $name);
		$currentDir='';
		for($i=0;$i<sizeof($projectName)-1;$i++)
		{
			$currentDir.= $projectName[$i].'/';
		}
		
		echo"
			<script>				
				$(document).ready(function(){
					$('.documentationContentSection').show();
					$('.headline').attr('class','sidemenu');
					$('.sidemenu').html(`
						<div class='input-group'>
							<input type='text' class='form-control' placeholder='Search'>
							<div class='input-group-btn'>
							  <button class='btn btn-default' type='submit'>
								<i class='glyphicon glyphicon-search'></i>
							  </button>
							</div>
						</div>
						<div class='tabList'>
							<div class='parentList'> $folder</div>
						";
						
						// List side menu 
						$file = glob("$currentDir/*.html" );		
						foreach ($file as &$projectName) {
							 $projectName = explode("/", $projectName);
							$key=  end(array_keys($projectName));
							$name2 =  $projectName[$key];
							$name2 = explode(".", $name2);			
							
							if($name[0] == $name2[0])
								$projectList =  " <div class='childList'><a class='active' href='?development=$currentDir$projectName[$key]'> $name2[0] </a></div>";
							else 
								$projectList =  " <div class='childList'><a href='?development=$currentDir$projectName[$key]'> $name2[0] </a></div>";
							echo $projectList;						
						}
						
						$checkFile = $currentDir."assets/css/$name[0].css";
						$current = $currentDir."assets";
						
						//Check if file is note 
						if (!file_exists("$checkFile"))
						{
		echo "
		
							</div>						
						`);
						$('.topic').html('$name[0]<button class=\'btn btn-default editBtn\'> Edit </button><input type=\"hidden\" value=\"$project\" class=\"pathName\"/>');
						$('.contentSection').load(encodeURI(\"$project\"));		
					});
				</script>
		";
							
						}
						else  // Or it is code 
						{
							
							
							
						
		echo "
						</div>						
					`);
					$('.topic').hide();
						
					$('.contentSection').html(`					  
					  <ul class='nav nav-tabs'>
						<li class='active'><a data-toggle='tab' href='#preview'>Preview</a></li>
						<li><a data-toggle='tab' href='#html' class='htmlTab'>HTML</a></li>
						<li><a data-toggle='tab' href='#css' class='cssTab'>CSS</a></li>
						<li><a data-toggle='tab' href='#responsive' class='responsiveTab'>Responsive</a></li>		
						<li><a data-toggle='tab' href='#js' class='jsTab'>Javascript</a></li>
						<li><a data-toggle='tab' href='#php' class='phpTab'>PHP</a></li>
						<li><a data-toggle='tab' href='#sql'>SQL</a></li>
						<li><a data-toggle='tab' href='#img'>Image</a></li>
						<li><a data-toggle='tab' href='#plugin'>Plugin</a></li>						
						<li><a data-toggle='tab' href='#other'>Other</a></li>
					  </ul>
					  <input type='hidden' class='developmentPath' value='$currentDir'/>
					  <input type='hidden' class='developmentName' value='$name[0]'/>
					  <div class='tab-content'>
						<div id='preview' class='tab-pane fade in active'>	
							<button type='button' class='fullscreenBtn btn btn-default btn-sm'>
							  <span class='glyphicon glyphicon-fullscreen'></span>  
							</button>
							<iframe  class='previewFrame' src='$project'></iframe>												
						</div>
						<div id='html' class='tab-pane fade'>						  
						  <textarea class='htmlTextarea htmlArea' id='htmlArea' onkeyup='auto_grow(this);'></textarea>
						  <button class='btn btn-default saveHtml'>Save</button>
						  <a href='$currentDir/$name[0].html' download> <button class='btn btn-default downloadFileBtn'>Download</button> </a>
						</div>
						<div id='css' class='tab-pane fade'>
						  <textarea class='htmlTextarea cssArea' id='cssArea' onkeyup='auto_grow(this);'></textarea>
						   <button class='btn btn-default saveCss'>Save</button>
						   <a href='$currentDir/assets/css/$name[0].css' download> <button class='btn btn-default downloadFileBtn'>Download</button> </a>
						   <br><br>
						  <label class='reminder'> To include CSS : <pre>&lt;link  rel='stylesheet' href='assets/css/$name[0].css'/&gt;</pre> </label>
						</div>
						<div id='responsive' class='tab-pane fade'>
						  <textarea class='htmlTextarea responsiveArea' id='responsiveArea' onkeyup='auto_grow(this);'></textarea>
						   <button class='btn btn-default saveResponsive'>Save</button>
						   <a href='$currentDir/assets/responsive/$name[0].css' download> <button class='btn btn-default downloadFileBtn'>Download</button> </a>
						   <br><br>
						  <label class='reminder'> To include Responsive : <pre>&lt; link  rel='stylesheet'  media='screen and (max-width : 768px)' href='assets/responsive/$name[0].css'/&gt;</pre> </label>
						</div>
						<div id='js' class='tab-pane fade'>						
						  <textarea class='htmlTextarea jsArea' id='jsArea' onkeyup='auto_grow(this);'></textarea>
						  <button class='btn btn-default saveJs'>Save</button>
						  <a href='$currentDir/assets/js/$name[0].js' download> <button class='btn btn-default downloadFileBtn'>Download</button> </a>
						   <br><br>
						  <label class='reminder'> To include JS : <pre>&lt;script src='assets/js/$name[0].js'/&gt;&lt;script&gt;</pre> </label>
						</div>
						<div id='php' class='tab-pane fade'>
						  <textarea class='htmlTextarea phpArea' id='phpArea' onkeyup='auto_grow(this);'></textarea>
						  <button class='btn btn-default savePhp'>Save</button>						  
						  <a href='$currentDir/assets/php/$name[0].php' download> <button class='btn btn-default downloadFileBtn'>Download</button> </a>
						   <br><br>
						  <label class='reminder'> To include PHP : <pre>&lt;?php include('assets/php/$name[0].php') ?&gt;</pre> </label>
						</div>
						<div id='img' class='tab-pane fade'>
							<br><br>						
							<div class='panel-group' id='accordion'>
								<div class='panel panel-default'>
								  <div class='panel-heading'>
									<h4 class='panel-title'>
									  <a data-toggle='collapse' data-parent='#accordion' href='#collapse_img'>Image</a>
									</h4>
								  </div>							  
								  <div id='collapse_img' class='panel-collapse collapse'>
									<div class='tag-body imageFile'>	
									
									</div>
								  </div>
								</div>  
							</div>
							<br><br>
							<form action='' class='uploadForm' id='uploadForm_img' method='post' enctype='multipart/form-data'>
								<div class='file-input-wrapper'>
									<button class='btn btn-default uploadImgBtn' value=\'$currentDir/assets/image/\'>Upload Image</button>
									<input type='file' name='fileUpload'  class='profileFileUpload' onchange='readURL(this, \"$currentDir\",\"hideSubmitBtn_img\");'/>
									<input type='hidden' value=\'$currentDir/assets/image/\' name='path'>
									<button type='submit' name='submit' class='hideSubmitBtn hideSubmitBtn_img'>Submit</button>
								</div>
							</form>							
							<br><br>							
							<label class='reminder'> To include image : <pre>&lt;img src='assets/image/[fileName]'&gt;</pre> </label>
						</div>
						<div id='sql' class='tab-pane fade'>						  		 
							<textarea class='htmlTextarea sqlArea' id='sqlArea' onkeyup='auto_grow(this);'></textarea>							
							<button class='btn btn-default saveSql'>Save</button>
							<a href='$currentDir/assets/sql/$name[0].txt' download> <button class='btn btn-default downloadFileBtn'>Download</button> </a>
							<br><br>
						</div>						
						<div id='plugin' class='tab-pane fade'>						  		 
							<br><br>
							<div class='panel-group' id='accordion'>
								<div class='panel panel-default'>
								  <div class='panel-heading'>
									<h4 class='panel-title'>
									  <a data-toggle='collapse' data-parent='#accordion' href='#collapse_plugin'>Plugin file</a>
									</h4>
								  </div>							  
								  <div id='collapse_plugin' class='panel-collapse collapse'>
									<div class='tag-body pluginFile'>																	
									</div>
								  </div>
								</div>  
							</div>
							<br><br>	
							<form action='' class='uploadForm' id='uploadForm_plugin' method='post' enctype='multipart/form-data'>
								<div class='file-input-wrapper'>
									<button class='btn btn-default uploadImgBtn' value=\'$currentDir/assets/plugin/\'>Upload Plugin</button>
									<input type='file' name='fileUpload'  class='profileFileUpload' onchange='readURL(this, \"$currentDir\",\"hideSubmitBtn_plugin\");'/>
									<input type='hidden' value=\'$currentDir/assets/plugin/\' name='path'>
									<button type='submit' name='submit' class='hideSubmitBtn hideSubmitBtn_plugin'>Submit</button>
								</div>
							</form>		
							<br><br>							
							<label class='reminder'> To include plugin : <pre>&lt; ... src='assets/plugin/[fileName]'&gt;</pre> 
						</div>
						<div id='other' class='tab-pane fade'>						  		 
							<br><br>	
							<div class='panel-group' id='accordion'>
								<div class='panel panel-default'>
								  <div class='panel-heading'>
									<h4 class='panel-title'>
									  <a data-toggle='collapse' data-parent='#accordion' href='#collapse_other'>Other file </a>
									</h4>
								  </div>							  
								  <div id='collapse_other' class='panel-collapse collapse'>
									<div class='tag-body otherFile'>																	
									</div>
								  </div>
								</div>  
							</div>
							<br><br>
							<form action='' class='uploadForm' id='uploadForm_other' method='post' enctype='multipart/form-data'>				
								<div class='file-input-wrapper'>
									<button class='btn btn-default uploadOtherBtn' value=\'$currentDir/assets/other/\'>Upload</button>
									<input type='file' name='fileUpload'  class='profileFileUpload' onchange='readURL(this, \"$currentDir\",\"hideSubmitBtn_other\");'/>
									<input type='hidden' value=\'$currentDir/assets/other/\' name='path'>
									<button type='submit' name='submit' class='hideSubmitBtn hideSubmitBtn_other'>Submit</button>
								</div>
							</form>
							<br><br>							
							<label class='reminder'> To include other file  : <pre>&lt; ... src='assets/other/[fileName]'&gt;</pre> 
						</div>
					  </div>
						
					`);";
					
					 // Load Image file 
					 $files = glob("$currentDir/assets/image/*");	
					 echo " $('.imageFile').append('<ul class=\'fileLink\'>');";	
					 foreach ($files as $projectName) {		
							$projectName = explode("/", $projectName);	
							if($projectName[5]!='index.html')
								echo " $('.imageFile').append('<li><a href=\"$currentDir/assets/image/$projectName[5]\" download=\"$projectName[5]\"> $projectName[5]</a></li>');";
								
					 }
					 echo " $('.imageFile').append('</ul>');";	

					 // Load Plugin file 
					 $files = glob("$currentDir/assets/plugin/*");	
					 echo " $('.pluginFile').append('<ul class=\'fileLink\'>');";	
					 foreach ($files as $projectName) {		
							$projectName = explode("/", $projectName);	
							if($projectName[5]!='index.html')
								echo " $('.pluginFile').append('<li><a href=\"$currentDir/assets/plugin/$projectName[5]\" download=\"$projectName[5]\"> $projectName[5]</a></li>');";
								
					 }
					 echo " $('.pluginFile').append('</ul>');";	


					 // Load Other file 
					 $files = glob("$currentDir/assets/other/*");	
					 echo " $('.otherFile').append('<ul class=\'fileLink\'>');";	
					 foreach ($files as $projectName) {		
							$projectName = explode("/", $projectName);	
							if($projectName[5]!='index.html')
								echo " $('.otherFile').append('<li><a href=\"$currentDir/assets/other/$projectName[5]\" download=\"$projectName[5]\"> $projectName[5]</a></li>');";
								
					 }
					 echo " $('.otherFile').append('</ul>');";	
					 
						 
					echo"
					
					//Load all the script
					

					//Load HTML 
					var htmlPath = '$project';						
					$.get(htmlPath, function (data){
						$('.htmlArea').val(data);											
						
					});
					
					//Load responsive 
					var responsivePath = '$current/responsive/$name[0].txt';						
					$.get(responsivePath, function (data){
						$('.responsiveArea').val(data);
					});					
					
					//Load css 
					var cssPath = '$current/css/$name[0].txt';						
					$.get(cssPath, function (data){
						$('.cssArea').val(data);
					});
					
					//Load js 
					var jsPath = '$current/js/$name[0].txt';					
					$.get(jsPath, function (data){
						$('.jsArea').val(data);
					});
					
					//Load sql 
					var sqlPath = '$current/sql/$name[0].txt';					
					$.get(sqlPath, function (data){
						$('.sqlArea').val(data);
					});
					
					//Load php 
					var phpPath = '$current/php/$name[0].txt';					
					$.get(phpPath, function (data){
						$('.phpArea').val(data);
					});			
					
				});			 			
			</script>		
		";

						}		
	}

	
	/*
		Create development function
	*/
	function createDevelopment($name)
	{
		mkdir("development/$name", 0700);
	}
	
	
	/*
		Get file function -- development
	 */		 
	 function checkFile_development($currentDir)
	 {		 
		 $file = glob("$currentDir/*.html" );			 
		 if($file)
			echo "<ul>";
		 foreach ($file as &$projectName) {
			$projectName = explode("/", $projectName);
			$key=  end(array_keys($projectName));
			$name =  $projectName[$key];
			$name = explode(".", $name);			
			$projectList =  " <li class='fileItem'><a href='?development=$currentDir/$projectName[$key]'> $name[0] </a> <button type='button' value='$currentDir/$projectName[$key]' class='btn btn-default  deleteFileBtn menuBtn'> x </button></li>";
			echo $projectList;						
		 }	
		 if($file)
			echo "</ul>";	
	 }
	
	
	/*
		Get folder function  -- development
	 */		 
	 function checkList_development($currentDir)
	 {
		 $directories = glob("$currentDir/*" , GLOB_ONLYDIR);			 
		 if($directories)
			echo "<ul>";
		 foreach ($directories as &$projectName) {
			
			 $projectName = explode("/", $projectName);
			 $key=  end(array_keys($projectName));
			 if($projectName[$key] !="assets")
			 {
				$projectList =  " <li> $projectName[$key] <button type='button' value='$currentDir/$projectName[$key]' class='btn btn-default createBtn_development'> + </button> <button type='button' value='$currentDir/$projectName[$key]' class='btn btn-default  deleteBtn menuBtn'> x </button></li>";
				echo $projectList;			
				checkList_development("$currentDir/$projectName[$key]");
				checkFile_development("$currentDir/$projectName[$key]");
			 }
		 }	
		 if($directories)
			echo "</ul>";	
	 }
	 
	 
	 /*
		List parent project function -- for development
	 */		 
	 function listMenu_development()
	 {
		 $directories = glob('development/*' , GLOB_ONLYDIR);				 
		 $count =0;
		 foreach ($directories as &$projectName) {
			$projectList = "<div class='menuItem'> <ul class='itemList'> ";
			echo $projectList;
			$projectName = explode("/", $projectName);
			$projectList =  "<li class='test' href='#development_$count' data-toggle='collapse'>$projectName[1] <button type='button' value='development/$projectName[1]' class='btn btn-default menuBtn createBtn_development'> + </button> <button type='button' value='development/$projectName[1]' class='btn btn-default  deleteBtn menuBtn'> x </button></li>
			<div id='development_$count' class='collapse'>";
			echo $projectList;			
			checkList_development("development/$projectName[1]");
			checkFile_development("development/$projectName[1]");
			$projectList = "</div></ul></div>";
			echo $projectList;
			$count++;
		 }
		 
	 }



/*=========================================================================

					Competition function section

==========================================================================*/
	

	/*
		Save Note function -- competition
	*/
	
	function addCom($content)
	{					
		$file = fopen("competition/index.html", "a");
		fwrite($file, $content);
		fclose($file);
					
	}



	 
	
?>