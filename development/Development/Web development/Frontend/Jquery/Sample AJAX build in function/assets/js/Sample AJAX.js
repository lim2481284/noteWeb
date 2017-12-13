// POST request 

$.post("url",
    {
        name: "Donald Duck",
        city: "Duckburg"
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
});


// GET request 

$.get("url", function(data, status){
       	 alert("Data: " + data + "\nStatus: " + status);
 });

