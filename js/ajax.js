// JavaScript Document
var count =0;
$(document).ready(function() {
	
	loadData(count);
	
     $("#loginbt").click(function(){
		 popup();
	 });

    function popup() {
        $("#logindiv").css("display", "block");
    }

    $("#login #cancel").click(function() {
        $(this).parent().parent().hide();
    });

    $("#onclick").click(function() {
        $("#contactdiv").css("display", "block");
    });

    $("#contact #cancel").click(function() {
        $(this).parent().parent().hide();
    });

//login form popup login-button click event
    $("#loginbtn").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
		console.log(password);
        if (email == "" || password == "")
        {
            alert("email or Password was Wrong");
        }
        else
        {
			var sData={
				"email":email,
				"password":password
			}
			console.log(email);
			
			
           // $("#logindiv").css("display", "none");
		   $.ajax({
			url: "includes/login.php",
			type: "POST",
			data: sData,
			statutsCode: {
				404 : function() {
						$('.msg').text('not found page')
					  }
				},	
			success: function(data, statutsText,xhr) {
				if(data.toString()=="client"){
					window.location.replace("client.php");
				}else{
					window.location.replace("admin.php");
				}
						
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
					}
			});
			return false;
		
        }
    });
      ///load client data
	  




});

function loadData(count)
{
	var sData={
				"load":count
			}
		   $.ajax({
			url: "includes/load.php",
			type: "POST",
			data: sData,
			statutsCode: {
				404 : function() {
						$('.msg').text('not found page')
					  }
				},	
			success: function(data, statutsText,xhr) {
				    //alert(data)
					//$(data).insertAfter(".blog-item:last-of-type");
					$(".col-md-8").append(data);
						
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
					}
			});
			return false;

	
}

	