

/*=========================================================================

					Common function section

==========================================================================*/


$.ajaxSetup ({
    // Disable caching of AJAX responses
    cache: false
});





/*

	Delete folder function

*/

$(document).on('click','.deleteBtn',function(){
	var path = $(this).attr('value');
	swal({
	  title: 'Confirm delete?',
	  type: 'warning',
	  showCancelButton: true,
	  allowOutsideClick: false
	}).then((result) => {
	  if (result.value) {
		$.ajax({
			type: "post",
			data: {
				"deleteFolder": "1",
				"path": path,
			},
			success: function(data){
				window.location.reload(true);

			}
		});
	  }
	});
});



/*

	Delete file function

*/

$(document).on('click','.deleteFileBtn',function(){

	var path = $(this).attr('value');
	swal({
	  title: 'Confirm delete?',
	  type: 'warning',
	  showCancelButton: true,
	  allowOutsideClick: false
	}).then((result) => {
	  if (result.value) {
		var path = $(this).attr('value');
		$.ajax({
			type: "post",
			data: {
				"deleteFile": "1",
				"path": path,
			},
			success: function(data){
				window.location.reload(true);

			}
		});
	  }
	});
});


/*=========================================================================

					Homepage function section

==========================================================================*/


/*

	Create new todo button function

*/

$('.addTodo').click(function(){
	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<form id="myForm" action="#" method="post" ><br><label class="swal-label">Name  </label><input id="swal-input-name" name="createTodo" class="swal2-input"  value=""></form>',
	  focusConfirm: false,
	  preConfirm: function () {
		return new Promise(function (resolve,reject) {
			if(!$('#swal-input-name').val())
			{
				reject('Please fill in all the info');
			}
			else {
				resolve([
				  $('#swal-input-name').val(),
				])
			}
		})
	  }
	}).then(function (result) {
		  if (result.value) {
			 jQuery.ajax({
                type: "POST",
                data:  $("form").serialize(),
                success: function(data){
					window.location.reload(true);

                }
			});
		  }
	}).catch(swal.noop)
});


/*=========================================================================

					Documentation function section

==========================================================================*/


/*

	Hover show create documentation function

*/


$(function(){

	$('li').mouseover(function(){
		$(this).find('.createBtn').show();
	});
	$('li').mouseout(function(){
		$(this).find('.createBtn').hide();
	});
	$('li').mouseover(function(){
		$(this).find('.menuBtn').show();
	});
	$('li').mouseout(function(){
		$(this).find('.menuBtn').hide();
	});


});



/*

	Save note content button function

*/

$(document).on('click','.saveBtn',function(){

	var content =$("#txtEditor").Editor("getText");
	var path = $('.pathName').attr('value');

	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			swal('Content saved',response,'success');
			window.location.reload(true);
		}
	});


});





/*

	Edit note content button function

*/


$(document).on('click','.editBtn',function(){

	$('.editBtn').html('Save');
	$('.editBtn').attr('class','btn btn-default saveBtn');
	$('.contentSection').html('<input type="hidden" class="loadContent"/> <textarea id="txtEditor"></textarea>');
	$("#txtEditor").Editor();

	var path = $('.pathName').attr('value');
	$('.loadContent').load(path);
	$.get(path, function (data){
		$("#txtEditor").Editor("setText",data );

	});

	$(document).delegate('.Editor-editor', 'keydown', function(e) {
	  var keyCode = e.keyCode || e.which;

	  if (keyCode == 9) {
		e.preventDefault();
		$( "a[title='Increase Indent']" ).trigger('click' , function(){});
	  }

	});
});

/*

	Create new documentation child button function

*/

$(document).on('click','.createBtn',function(){


	var path = $(this).attr('value');
	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<form id="myForm2" action="#" method="post" ><br><label class="swal-label"> File type  </label><select id="swal-input-type" name="createDocumentationType" class="swal2-input"  value=""><option value="note">Note</option><option value="menu">Menu</option> </select><label class="swal-label"> Name  </label><input id="swal-input-name" name="createChild" class="swal2-input"  value=""><input type="hidden" name="path" class="swal2-input-path"  value=""></form>',
	  focusConfirm: false,
	  preConfirm: function () {
		return new Promise(function (resolve,reject) {
			if(!$('#swal-input-name').val())
			{
				reject('Please fill in all the info');
			}
			else {
				resolve([
				  $('#swal-input-name').val(),
				])
			}
		})
	  }
	}).then(function (result) {
		  if (result.value) {
			//document.getElementById("myForm").submit();
			$('.swal2-input-path').attr('value',path);
			 jQuery.ajax({
                type: "POST",
                data: $("form").serialize(),
                success: function(data){
					 $.ajax({
						type: 'post',
						data: { "callFunction": "1"},
						dataType: "text",
						success: function(response) {
							$('.menuList').html(
								response
							);
						}
					});
                }
			});
		  }
	}).catch(swal.noop)
});



/*

	Create new documentation button function

*/

$('.createNewDocument').click(function(){
	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<form id="myForm" action="#" method="post" ><br><label class="swal-label">Name  </label><input id="swal-input-name" name="createDocumentation" class="swal2-input"  value=""><input type="hidden" name="createCourse"/></form>',
	  focusConfirm: false,
	  preConfirm: function () {
		return new Promise(function (resolve,reject) {
			if(!$('#swal-input-name').val())
			{
				reject('Please fill in all the info');
			}
			else {
				resolve([
				  $('#swal-input-name').val(),
				])
			}
		})
	  }
	}).then(function (result) {
		  if (result.value) {
			//document.getElementById("myForm").submit();
			 jQuery.ajax({
                type: "POST",
                data:  $("form").serialize(),
                success: function(data){
					 $.ajax({
						type: 'post',
						data: { "callFunction": "1"},
						dataType: "text",
						success: function(response) {
							$('.menuList').html(
								response
							);
						}
					});


                }
			});
		  }
	}).catch(swal.noop)
});


/*=========================================================================

					Timeline function section

==========================================================================*/

/*

	Timeline function

*/

$(function() {
	$('#timeline').timeliny();
});



/*=========================================================================

					Design function section

==========================================================================*/

/*

  Setup editor

*/

$(document).ready(function(){

  $(document).on('mouseover','.ideaTable',function(){
		$(this).find('.deleteDesign').show();
		$(this).find('.editDesignBtn').show();
	});
	$(document).on('mouseout','.ideaTable',function(){
		$(this).find('.deleteDesign').hide();
		$(this).find('.editDesignBtn').hide();
	});

  $("#txtEditor_design").Editor();


  //Toggle content
  $(document).on('click','.designRow',function(){
      $(this).parent().find('.ideaRowDescription').toggle('fast');
  });

});



/*

	Edit design  button

*/
$(document).on('click','.editDesignBtn',function(){

	// Get content
	var title = $(this).parent().parent().find('.ideaTitleLabel').html();
	var content = $(this).parent().parent().find('.ideaRowDescription').html();
	var path = $('.addIdeaBtn').attr('value');
	var parentDiv = $(this).parent().parent();
	var titleDiv = $(this).parent().parent().find('.ideaTitleLabel');
	var contentDiv =  $(this).parent().parent().find('.ideaRowDescription');
	var tagDiv = $(this).parent().parent().find('.ideaRowTag');

	//Open editor
	window.location.href = "#addDesign";

	//Put content to editor
	$('.ideaPopoutTitle').html('Edit idea');
	$('.designTitle').val(title);
	$("#txtEditor_design").Editor("setText",content);

	//Change editor button function
	$('.addNewDesign').html('Edit');
	$('.addNewDesign').attr('class','btn btn-primary editDesign');
	$('.editDesign').attr('value',path);
	$('.editDesign').attr('parent',parentDiv);


	//Edit request function
	$(document).on('click','.editDesign',function(){
		titleDiv.html($('.designTitle').val());
		contentDiv.html($("#txtEditor_design").Editor("getText"));
		var ideaContent = $('.contentSection').html();
		$.ajax({
			type: 'post',
			data: {
				"editDesignContent": "1",
				"content":ideaContent,
				"path" :path
			},
			dataType: "text",
			success: function(response) {
				swal('Design edited',response,'success');
				window.location.href = "#";
				window.location.reload(true);
			}
		});
	});
});





/*

	Delete design  button

*/
$(document).on('click','.deleteDesign',function(){

	swal({
	  title: 'Confirm delete?',
	  type: 'warning',
	  showCancelButton: true,
	  allowOutsideClick: false
	}).then((result) => {
	  if (result.value) {
		$(this).parent().parent().remove();
		var path = $('.addIdeaBtn').attr('value');
		var content = $('.contentSection').html();
		$.ajax({
			type: 'post',
			data: {
				"editDesignContent": "1",
				"content":content,
				"path" :path
			},
			dataType: "text"
		});
	  }
	})

});



/*

	Add new design  button

*/


$(document).on('click','.addNewDesign',function(){
	var path = $('.addIdeaBtn').attr('value');
	var description =$("#txtEditor_design").Editor("getText");
	var title = $('.designTitle').val();
	var content = `
		<div class='ideaTable'>
			<div class='ideaRow designRow ideaRowTitle'><label class='ideaTitleLabel'>`+
				 title

			+`</label>
			<button type='button' class='deleteDesign'> x</button>
			<button type='button' class='editDesignBtn'> edit </button>
			</div>
			<div class='ideaRow ideaRowDescription'>`+
				description
			+`</div>
			</div>
		</div>
	`;
	$.ajax({
		type: 'post',
		data: {
			"addDesignContent": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			swal('Design added',response,'success');
			window.location.href = "#";
			window.location.reload(true);

		}
	});

});







/*=========================================================================

					Work function section

==========================================================================*/

/*

	Delete folder function  -- work

*/

$(document).on('click','.deleteBtn_work',function(){
	var path = $(this).attr('value');

	swal({
	  title: 'Confirm delete?',
	  type: 'warning',
	  showCancelButton: true,
	  allowOutsideClick: false
	}).then((result) => {
	  if (result.value) {
		$.ajax({
			type: "post",
			data: {
				"deleteFolder_work": "1",
				"path": path,
			},
			success: function(data){
				window.location.reload(true);
			}
		});
	  }
	});

});



/*

	Upload file function

*/

function readURL(input,path,formName) {

	$('.'+formName).click();
}



/*

	Save work content button function

*/

$(document).on('click','.saveBtn_work',function(){

	var content =$("#txtEditor").Editor("getText");
	var path = $('.saveBtn_work').attr('value');

	$.ajax({
		type: 'post',
		data: {
			"saveWork": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			swal('Content saved',response,'success');
			window.location.reload(true);
		}
	});


});



/*

	Create new work button function

*/

$('.createNewWork').click(function(){
	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<form id="myForm" action="#" method="post" ><br><label class="swal-label">Name  </label><input id="swal-input-name" name="createWork" class="swal2-input"  value=""><input type="hidden" name="createCourse"/></form>',
	  focusConfirm: false,
	  preConfirm: function () {
		return new Promise(function (resolve,reject) {
			if(!$('#swal-input-name').val())
			{
				reject('Please fill in all the info');
			}
			else {
				resolve([
				  $('#swal-input-name').val(),
				])
			}
		})
	  }
	}).then(function (result) {
		  if (result.value) {
			 jQuery.ajax({
                type: "POST",
                data:  $("form").serialize(),
                success: function(data){
					 $.ajax({
						type: 'post',
						data: { "callFunction_work": "1"},
						dataType: "text",
						success: function(response) {
							$('.menuList').html(
								response
							);
						}
					});


                }
			});
		  }
	}).catch(swal.noop)
});




/*

	Edit work content button function

*/


$(document).on('click','.editBtn_work',function(){

	var path = $('.editBtn_work').attr('value');
	$('.editBtn_work').html('Save');
	$('.editBtn_work').attr('class','btn btn-default saveBtn_work');
	$('.contentSection').html('<input type="hidden" class="loadContent"/> <textarea id="txtEditor"></textarea>');
	$("#txtEditor").Editor();



	$.get(path, function (data){
		$("#txtEditor").Editor("setText",data );
	});

});




/*=========================================================================

					Idea function section

==========================================================================*/


/*

	Hover show create idea function

*/

$(document).ready(function(){

	$(document).on('mouseover','.ideaTable',function(){
		$(this).find('.deleteIdea').show();
		$(this).find('.editIdeaBtn').show();
	});
	$(document).on('mouseout','.ideaTable',function(){
		$(this).find('.deleteIdea').hide();
		$(this).find('.editIdeaBtn').hide();
	});
	$("#txtEditor_idea").Editor();
	$(".createBtn").hide();
	$(".menuBtn").hide();


});



/*

	Tag filter function

*/

$(document).on('change','.checkbox',function(){

   /*
		0 - check if all checked
		1 - get all the checked checkbox value
		2 - get all the idea box
		3 - check if taglist inside the idea box matched with the checkbox
		4 - if one of the tag is match, then display and check the second idea box
		5 - if none of the tag is match, then hide the box
   */

   if( $('.checkbox_all').prop("checked") == false){
	   var checktag = $('.tag-body').find('.checkbox');
	   var ideabox  = $('.ideaTable');
	   var total =0;
		for(var j=0;j<ideabox.length;j++)
		{

			var tagList = $(ideabox[j]).find('.tagListItem');
			var check =0;
			for(var z =0; z < tagList.length;z++)
			{
				var tagItem = $(tagList[z]).html();
				for(var i =0; i < checktag.length; i++)
				{
					if($(checktag[i]).prop("checked") == true){
						var checkItem = $(checktag[i]).val();
						tagItem = $.trim(tagItem);
						checkItem= $.trim(checkItem);
						if(tagItem == checkItem){
							check++;
							i = checktag.length;
						}
					}
				}
				if(check !=0)
				{
					z = tagList.length;
				}

			}
			if(check==0){
				$(ideabox[j]).hide();
			}
			else
			{
				$(ideabox[j]).show();
				total++;
			}

			$('.totalIdea').html('Total idea : '+total );

		}
   }
   else
   {
	   $('.ideaTable').show();
	   var totalIdea = $('.ideaTable');
		$('.totalIdea').html('Total idea : '+totalIdea.length );

   }
});



/*

	Create idea tab button function

*/

$(document).on('click','.createTabBtn_work',function(){
	var currentPath = $('.createTabBtn_work').attr('value');
	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<br><label class="swal-label">Tab name  </label><input id="swal-input-name" name="createDocumentation" class="swal2-input ideaTabInput"  value="">',
	  focusConfirm: false
	}).then(function (result) {
		  if (result.value) {
			 var workTab=   $('.ideaTabInput').val();
			 $.ajax({
				type: 'post',
				data: {
					"createWorkTab": "1",
					"path":currentPath,
					"workTab" :	workTab
				},
				dataType: "text",
				success: function(response) {
					swal('Create tab success',response,'success');
					window.location.reload(true);
				}
			});

		  }
	}).catch(swal.noop)

});



/*

	Create idea tab button function

*/

$(document).on('click','.createTabBtn',function(){

	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<br><label class="swal-label">Tab name  </label><input id="swal-input-name" name="createDocumentation" class="swal2-input ideaTabInput"  value="">',
	  focusConfirm: false
	}).then(function (result) {
		  if (result.value) {
			 var ideatab=   $('.ideaTabInput').val();
			 $.ajax({
				type: 'post',
				data: {
					"createIdeaTab": "1",
					"ideaTab" :	ideatab
				},
				dataType: "text",
				success: function(response) {
					swal('Create tab success',response,'success');
					window.location.reload(true);
				}
			});

		  }
	}).catch(swal.noop)

});



/*

	Edit idea  button

*/
$(document).on('click','.editIdeaBtn',function(){

	// Get content
	var title = $(this).parent().parent().find('.ideaTitleLabel').html();
	var content = $(this).parent().parent().find('.ideaRowDescription').html();
	var tag = $(this).parent().parent().find('.tagListItem');
	var path = $('.addIdeaBtn').attr('value');
	var parentDiv = $(this).parent().parent();
	var titleDiv = $(this).parent().parent().find('.ideaTitleLabel');
	var contentDiv =  $(this).parent().parent().find('.ideaRowDescription');
	var tagDiv = $(this).parent().parent().find('.ideaRowTag');

	//Open editor
	window.location.href = "#addIdea";

	//Put content to editor
	$('.ideaPopoutTitle').html('Edit idea');
	$('.ideaTitle').val(title);
	$("#txtEditor_idea").Editor("setText",content);
	$('.tagArea').html(`
		<button class='btn btn-default addTagBtn'> Add tag </button>
	`);
	for(var i = 0; i < tag.length; i++){
		$('.tagArea').prepend(`
			<div class='col-sm-12 noPadding tagItem'>
				<input list="tagDataList" class='tagItemInput form-control' value='`+$(tag[i]).html()+`'/>
			</div>
		`);
	}

	//Change editor button function
	$('.addNewIdea').html('Edit');
	$('.addNewIdea').attr('class','btn btn-primary editIdea');
	$('.editIdea').attr('value',path);
	$('.editIdea').attr('parent',parentDiv);


	//Edit request function
	$(document).on('click','.editIdea',function(){
		titleDiv.html($('.ideaTitle').val());
		contentDiv.html($("#txtEditor_idea").Editor("getText"));
		var tag = $('.tagItemInput');
		var content='';
		for(var i = 0; i < tag.length; i++){
			content+=`
				<span class='tagListItem \'>`+$(tag[i]).val()+` </span>
			`;
		}
		tagDiv.html(content);
		var ideaContent = $('.contentSection').html();
		$.ajax({
			type: 'post',
			data: {
				"editIdeaContent": "1",
				"content":ideaContent,
				"path" :path
			},
			dataType: "text",
			success: function(response) {
				swal('Idea edited',response,'success');
				window.location.href = "#";
				window.location.reload(true);
			}
		});
	});
});





/*

	Delete idea  button

*/
$(document).on('click','.deleteIdea',function(){

	swal({
	  title: 'Confirm delete?',
	  type: 'warning',
	  showCancelButton: true,
	  allowOutsideClick: false
	}).then((result) => {
	  if (result.value) {
		$(this).parent().parent().remove();
		var path = $('.addIdeaBtn').attr('value');
		var content = $('.contentSection').html();
		$.ajax({
			type: 'post',
			data: {
				"editIdeaContent": "1",
				"content":content,
				"path" :path
			},
			dataType: "text"
		});
	  }
	})

});




/*

	Add new idea  button

*/


$(document).on('click','.addNewIdea',function(){
	var path = $('.addIdeaBtn').attr('value');
	var tag = $('.tagItemInput');
	var description =$("#txtEditor_idea").Editor("getText");
	var title = $('.ideaTitle').val();
	var content = `
		<div class='ideaTable'>
			<div class='ideaRow ideaRowTitle'><label class='ideaTitleLabel'>`+
				 title

			+`</label>
			<button type='button' class='deleteIdea'> x</button>
			<button type='button' class='editIdeaBtn'> edit </button>
			</div>
			<div class='ideaRow ideaRowDescription'>`+
				description
			+`</div>
			<div class='ideaRow ideaRowTag'>`;

	for(var i = 0; i < tag.length; i++){
		content+=`
			<span class='tagListItem \'>`+$(tag[i]).val()+` </span>
		`;
	}

	content+=`
			</div>
		</div>
	`;
	$.ajax({
		type: 'post',
		data: {
			"addIdeaContent": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			swal('Idea added',response,'success');
			window.location.href = "#";
			window.location.reload(true);

		}
	});

});




/*

	Delete tag button

*/


$(document).on('click','.deleteTag',function(){
	$(this).parent().remove();
});



/*

	Add tag button

*/


$(document).on('click','.addTagBtn',function(){
	$('.tagArea').prepend(`
		<div class='col-sm-12 noPadding tagItem'>
			<input list="tagDataList" class='tagItemInput form-control'/>
			<button class='deleteTag'>x</button>
		</div>
	`);

	$('.tagItemInput')[0].focus();
});



/*=========================================================================

					Project function section

==========================================================================*/





/*=========================================================================

					Development function section

==========================================================================*/


/*

	 Search button

*/
$(document).on('click','.searchInputBtn',function(){

  //Get search input
  var searchInput = $('.searchInputField').val();
  $("#closeBtn_development")[0].click();
  $('.documentationContentSection').empty();
  $('.documentationContentSection').html("<div class='searchResultBox'><h1 class='searchResultLabel'>Search Result</h1></div>")

  //Send ajax request
  $.ajax({
    type: 'post',
    data: {
      "search": "1",
			"keyword" :searchInput
    },
    dataType: "text",
    success: function(response) {
      var response = response.split("<!----- Data here ---->").pop();
      $('.searchResultBox').append(response);
    }
  });
});



/*

	 Directory button

*/
$(document).on('click','.sideMenuFolderBtn',function(){
	var currentDir= $(this).attr('value');
  $('.sidemenu').empty();

  $.ajax({
    type: 'post',
    data: {
      "Dir": "1",
			"currentDir" :currentDir
    },
    dataType: "text",
    success: function(response) {
      var response = response.split("<!----- Data here ---->").pop();
      $('.sidemenu').html(response);
    }
  });

});



/*

	Previous directory button

*/
$(document).on('click','.previousDir',function(){
	var currentDir= $(this).attr('value');
  $('.sidemenu').empty();

  $.ajax({
    type: 'post',
    data: {
      "prevDir": "1",
			"currentDir" :currentDir
    },
    dataType: "text",
    success: function(response) {
      var response = response.split("<!----- Data here ---->").pop();
      $('.sidemenu').html(response);
    }
  });

});



/*

	full screen function

*/

$(document).on('click','.fullscreenBtn',function(){
	$(this).parent().parent().parent().parent().toggleClass('fullscreen');
	$('.headlineSection').toggleClass('displayToggle');
});


/*

	Save js function

*/

$(document).on('click','.saveJs',function(){
	var content = $('.jsArea').val();
	var oriPath = $('.developmentPath').attr('value');
	var name = $('.developmentName').attr('value');
	path = oriPath+'assets/js/'+name+'.js';

	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			path = oriPath+'assets/js/'+name+'.txt';
			$.ajax({
				type: 'post',
				data: {
					"saveNote": "1",
					"content":content,
					"path" :path
				},
				dataType: "text",
				success: function(response) {
					swal('Saved',response,'success');
					window.location.reload(true);
				}
			});
		}
	});

});


/*

	Download File function --script

*/

$(document).on('click','.downloadFileBtn',function(){
	var path = $(this).parent().find('.downloadValue').attr('value');

});

/*

	Save sql function

*/

$(document).on('click','.saveSql',function(){
	var content = $('.sqlArea').val();
	var oriPath = $('.developmentPath').attr('value');
	var name = $('.developmentName').attr('value');

	path = oriPath+'assets/sql/'+name+'.txt';
	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			swal('Saved',response,'success');
			window.location.reload(true);
		}
	});

});


/*

	Save sql function

*/

$(document).on('click','.saveSql',function(){
	var content = $('.sqlArea').val();
	var oriPath = $('.developmentPath').attr('value');
	var name = $('.developmentName').attr('value');

	path = oriPath+'assets/sql/'+name+'.txt';
	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			swal('Saved',response,'success');
			window.location.reload(true);
		}
	});

});


/*

	Save php function

*/

$(document).on('click','.savePhp',function(){
	var content = $('.phpArea').val();
	var oriPath = $('.developmentPath').attr('value');
	var name = $('.developmentName').attr('value');
	path = oriPath+'assets/php/'+name+'.php';

	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			path = oriPath+'assets/php/'+name+'.txt';
			$.ajax({
				type: 'post',
				data: {
					"saveNote": "1",
					"content":content,
					"path" :path
				},
				dataType: "text",
				success: function(response) {
					swal('Saved',response,'success');
					window.location.reload(true);
				}
			});
		}
	});

});


/*

	Save responsive function

*/

$(document).on('click','.saveResponsive',function(){
	var content = $('.responsiveArea').val();
	var oriPath = $('.developmentPath').attr('value');
	var name = $('.developmentName').attr('value');
	path = oriPath+'assets/responsive/'+name+'.css';

	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			path = oriPath+'assets/responsive/'+name+'.txt';
			$.ajax({
				type: 'post',
				data: {
					"saveNote": "1",
					"content":content,
					"path" :path
				},
				dataType: "text",
				success: function(response) {
					swal('Saved',response,'success');
					window.location.reload(true);
				}
			});
		}
	});

});


/*

	Save css function

*/

$(document).on('click','.saveCss',function(){
	var content = $('.cssArea').val();
	var oriPath = $('.developmentPath').attr('value');
	var name = $('.developmentName').attr('value');
	path = oriPath+'assets/css/'+name+'.css';

	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			path = oriPath+'assets/css/'+name+'.txt';
			$.ajax({
				type: 'post',
				data: {
					"saveNote": "1",
					"content":content,
					"path" :path
				},
				dataType: "text",
				success: function(response) {
					swal('Saved',response,'success');
					window.location.reload(true);
				}
			});
		}
	});

});


/*

	Save html function

*/
$(document).on('click','.saveHtml',function(){
	var content = $('.htmlArea').val();
	var path = $('.developmentPath').attr('value');
	var name = $('.developmentName').attr('value');
	path+=name+'.html';

	$.ajax({
		type: 'post',
		data: {
			"saveNote": "1",
			"content":content,
			"path" :path
		},
		dataType: "text",
		success: function(response) {
			swal('Saved',response,'success');
			window.location.reload(true);
		}
	});

});

/*

	Create new development child button function

*/

$(document).on('click','.createBtn_development',function(){


	var path = $(this).attr('value');
	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:`
		<form id="myForm2" action="#" method="post" >
			<br>
			<label class="swal-label"> File type  </label>
			<select id="swal-input-type" name="createDocumentationType" class="swal2-input"  value="">
				<option value="code">Code</option>
				<option value="note">Note</option>
				<option value="menu">Menu</option>
			</select>
			<label class="swal-label"> Name  </label>
			<input id="swal-input-name" name="createChild" class="swal2-input"  value="">
			<input type="hidden" name="path" class="swal2-input-path"  value="">
		</form>`,
	  focusConfirm: false
	}).then(function (result) {
		  if (result.value) {
			$('.swal2-input-path').attr('value',path);
			 jQuery.ajax({
                type: "POST",
                data: $("form").serialize(),
                success: function(data){
						window.location.reload(true);

                }
			});
		  }
	}).catch(swal.noop)
});


/*

	Create new development button function

*/

$('.createNewDevelopment').click(function(){
	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<form id="myForm" action="#" method="post" ><br><label class="swal-label">Name  </label><input id="swal-input-name" name="createDevelopment" class="swal2-input"  value=""></form>',
	  focusConfirm: false,
	  preConfirm: function () {
		return new Promise(function (resolve,reject) {
			if(!$('#swal-input-name').val())
			{
				reject('Please fill in all the info');
			}
			else {
				resolve([
				  $('#swal-input-name').val(),
				])
			}
		})
	  }
	}).then(function (result) {
		  if (result.value) {
			//document.getElementById("myForm").submit();
			 jQuery.ajax({
                type: "POST",
                data:  $("form").serialize(),
                success: function(data){
					 $.ajax({
						type: 'post',
						data: { "callFunction_development": "1"},
						dataType: "text",
						success: function(response) {
							$('.menuList').html(
								response
							);
							window.location.reload(true);
						}
					});


                }
			});
		  }
	}).catch(swal.noop)
});

$(function(){

	$('.createBtn_development').hide();
	$('li').mouseover(function(){
		$(this).find('.createBtn_development').show();
	});
	$('li').mouseout(function(){
		$(this).find('.createBtn_development').hide();
	});

});




//Auto resize textarea

$(document).ready(function(){
	$(document).on('click','.htmlTab',function(){
		var e = document.getElementById('htmlArea');
		setTimeout(function(){
		  auto_grow(e);
		}, 500);
	});
	$(document).on('click','.cssTab',function(){
		var e = document.getElementById('cssArea');
		setTimeout(function(){
		  auto_grow(e);
		}, 500);
	});
	$(document).on('click','.jsTab',function(){
		var e = document.getElementById('jsArea');
		setTimeout(function(){
		  auto_grow(e);
		}, 500);
	});
	$(document).on('click','.phpTab',function(){
		var e = document.getElementById('phpArea');
		setTimeout(function(){
		  auto_grow(e);
		}, 500);
	});
});

//textarea autoresize function
function auto_grow(element) {
	element.style.height = (element.scrollHeight)+"px";
}

$(document).delegate('.htmlTextarea', 'keydown', function(e) {
  var keyCode = e.keyCode || e.which;

  if (keyCode == 9) {
    e.preventDefault();
    var start = this.selectionStart;
    var end = this.selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    $(this).val($(this).val().substring(0, start)
                + "\t"
                + $(this).val().substring(end));

    // put caret at right position again
    this.selectionStart =
    this.selectionEnd = start + 1;
  }
});

/*=========================================================================

					Competition function section

==========================================================================*/


/*

	List competition

*/

function loadCompetition(){
	$('.compeititonList').load('competition/index.html'	);
};




/*

	Create competition search

*/

$(document).on('click','.addComBtn',function(){

	swal({
	  allowOutsideClick: false,
	  showCancelButton: true,
	  html:'<br><label class="swal-label">Competition type </label><input id="swal-input-name" name="createDocumentation" class="swal2-input addCom"  value="">',
	  focusConfirm: false
	}).then(function (result) {
		  if (result.value) {
			 var addCom=   $('.addCom').val();
			 var d = new Date(),
			 n = d.getMonth(),
			 y = d.getFullYear();
			 var months = [ "January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December" ];
			 n=months[n];

			 var search = "<a class='competitionLink' target='_blank' href='https://www.google.com/search?lr=&cr=countryMY&hl=en&tbs=qdr%3Am%2Cctr%3AcountryMY&ei=EPEgWtTdIsXavATn26-wCA&q="+addCom+"+"+y+"+"+n+"&oq="+addCom+"+"+y+"+"+n+"&gs_l=psy-ab.3...19473.170044.0.170392.14.14.0.0.0.0.148.1687.1j13.14.0....0...1c.1.64.psy-ab..0.12.1365...0j35i39k1j0i20i263k1j0i22i30k1j33i160k1j33i21k1.0.8a1Lr9w9D14'>"+addCom+" </a>";

			 $.ajax({
				type: 'post',
				data: {
					"addCom": search
				},
				dataType: "text",
				success: function(response) {
					window.location.reload(true);
				}
			});

		  }
	}).catch(swal.noop)

});
