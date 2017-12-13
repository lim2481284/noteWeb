$(document).ready(function () {


	// Add user response 

	$(document).off('add_user_response').on('add_user_response', function (e, data, status) {		   
		swal('Add user success', "" ,"success").then(() => {
			location.reload();	
		});			  	          
   	 });


	// Delete user response 

	$(document).off('delete_user_response').on('delete_user_response', function (e, data, status) {		   
		swal('Delete user success', "" ,"success").then(() => {
			location.reload();	
		});			  	          
   	 });


	// Edit user response 

	$(document).off('edit_user_response').on('edit_user_response', function (e, data, status) {		   
		swal('Edit user success', "" ,"success").then(() => {
			location.reload();	
		});			  	          
   	 });


	// Get user response 
	// Demo how to get the parameter from API-call
 	// Response data is based on API design

	$(document).off('get_user_response').on('get_user_response', function (e, data, status, role) {		   
		if(role == 'student' ) 
		{
			$('.body').append(data);

		}			  	          
   	 });

});