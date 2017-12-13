

// Get cookie 

this.token = $.cookie.get("token");




// Set cookie 

Cookies.set('token', token, { expires: 999 });



// Unset cookie or clear cookie 

if(Cookies.get('tf_token'))
			Cookies.remove('tf_token')

