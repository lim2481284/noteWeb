/*		

This script is mainly use to handle the API call and request 
It is the main core of the AJAX handle 
It will call the API then handle the response and error 	
				
*/	


function Api() {

	/*=============================================		
	
				Declaration section 			
		
	==============================================*/		
	
	    //Declaration 
 	    this.url = "http://url_address/ ";

	    //If you have cookie 
	    this.token = $.cookie.get("token");
	    this.userId = $.cookie.get("tf_id");	


	/*=============================================		
	
				Error handling section 			
		
	==============================================*/	

	//Handle response error for common error 
         this.error = (xhr, status, err) =>{
		console.log(xhr.responseText);
		var error = jQuery.parseJSON(xhr.responseText);							
		console.log(error);
	`	console.log(err);
		console.log(status);
	}

	//Second error handler 
         this.second_error = (xhr, status, err) =>{
		console.log(status);
	}


	/*=============================================		
	
				MAIN API request section 			
		
	==============================================*/

	//POST request 

   	 this.add_user_account= (name,role) => {		
    		 var data = {
			"name":name,
			"role":role
		};
		
      		$.postAjax(this.url + "user/" +  this.userId, data, (data, status, xhr) => {			
            		$(document).trigger("add_user_response", [data, status]);
        	}, this.error);
      }	


	//GET request

	this.get_all_user= (role) => {
      		  $.getAjax(this.url + "api/user", (data, status, xhr) => {					
     	    		  $(document).trigger("get_user_response", [data, status,role]);
     	 	  }, this.error);
  	}


	//PUT request 

   	 this.update_user_account= (pass,email) => {
     		   var data = {
				"password":{"password":pass},
				"email":email
		   }		
     		   $.putAjax(this.url + "api/user/"+ this.userId, data, (data, status, xhr) => {			
           		 $(document).trigger("update_user_response", [data, status]);
    		    }, this.second_error);
    	}


	//DELETE request 

  	  this.delete_user_account= () => {					
     		 $.deleteAjax(this.url + "api/user/"+ this.userId,(data, status, xhr) => {			
        	 	    $(document).trigger("delete_user_account_response", [data, status]);
    	 	 }, this.error);
	  }	

}

/*=============================================		

				API Declaration
		
==============================================*/
var myAPI= new Api();    




