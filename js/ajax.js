// JavaScript Document
var count =0;
var show_ser=false;
$(document).ready(function() {
	
	loadData(count);
	
	
	 $("#show_services").click(function(){
		 if(!show_ser) 
		 {
			 show_ser=true;
		    $("#all_services").show();
		 }
		 else
		 {
			 show_ser=false;
		    $("#all_services").hide();
		 }
		 return false;
	 });

	
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
	  $("#envoyer").click(function ()
       {
		 var message =$("#message").val();
		 var service= $("#select").val();
		 
		// console.log(service);
		  
	  var sData={
				"message":message,
				"service":service
			}
		   $.ajax({
			url: "includes/envoyer.php",
			type: "POST",
			data: sData,
			statutsCode: {
				404 : function() {
						$('.msg').text('not found page')
					  }
				},	
			success: function(data, statutsText,xhr) {
				      $(data).insertAfter(".blog-item:first-of-type");
					  $("#message").val("");
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
					}
			});
			return false;
});

//choit de service par client
$("#ajouter").click(function ()
       {
		 var service= $("#select_all").val();
		 var nom= $("#select_all option:selected").text();
		 
		// console.log(service);
		  
	  var sData={
				"service":service
			}
		   $.ajax({
			url: "includes/client_service.php",
			type: "POST",
			data: sData,
			statutsCode: {
				404 : function() {
						$('.msg').text('not found page')
					  }
				},	
			success: function(data, statutsText,xhr) {
				      $("#tab").append(data);
					  var string ='<option value="'+service+'" id="op_'+service+'">'+nom+'</option>';
					 console.log(string);
					 $("#select").append(string);
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
					}
			});
			return false;
			
			});



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
function delete_service(rec_id)
{
	var service= $("#select_all").val();
		 
		// console.log(service);
		  
	  var sData={
				"rec_id":rec_id
			}
		   $.ajax({
			url: "includes/client_service.php",
			type: "POST",
			data: sData,
			statutsCode: {
				404 : function() {
						$('.msg').text('not found page')
					  }
				},	
			success: function(data, statutsText,xhr) {
				    // alert(data);
					var dom_elem="#re_"+rec_id;
					var dom_op  ="#op_"+rec_id;
					 $(dom_elem).remove();
					  $(dom_op).remove();
					 
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
					}
			});
			return false;
			
}
	