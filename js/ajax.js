// JavaScript Document
var count =0;
var show_ser=false;
var show_param=false;


$(document).ready(function() {
	
	loadData(count);
	
	//show hide service
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
	 //show hide client params
	  $("#show_param").click(function(){
		 if(!show_param) 
		 {
			 show_param=true;
		    $("#parametre").show();
		 }
		 else
		 {
			 show_param=false;
		    $("#parametre").hide();
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
						$('.msg').text('not found page');
					  }
				},	
			success: function(data, statutsText,xhr) {
				      $("#tab").append(data);
					  var string ='<option value="'+service+'" id="op_'+service+'">'+nom+'</option>';
					// console.log(string);
					 $("#select").append(string);
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
					}
			});
			return false;
			
			});
			
//update client
$("#enregistrer").click(function ()
       {
		 var nom=$("#nom").val();
		 var prenom=$("#prenom").val();
		 var email=$("#email").val();
		 var password=$("#password").val();
		 var password2=$("#password2").val();
		 var adresse=$("#adresse").val();
		 var tel=$("#tel").val();
		 
		//console.log(nom);
		  
	  var sData={
		  "nom":nom,
		  "prenom":prenom,
		  "email":email,
		  "password":password,
		  "password2":password2,
		  "adresse":adresse,
		  "tel":tel
			}
		   $.ajax({
			url: "includes/update.php",
			type: "POST",
			data: sData,
			statutsCode: {
				404 : function() {
						$('#msg').text('not found page')
					  }
				},	
			success: function(data, statutsText,xhr) {
				     $('#msg').empty();
					  $('#msg').append(data);
					  
					
					 },
			error : function (xhr, ajaxOptions, thrownError){
				      $('#msg').empty();
					  $('#msg').append(thrownError);
					}
			});
			return false;
			
			});
			
			///load more data
			$("#load_more").click(function(){
				count++;
				loadData(count);
				return false;
				
				});


});

function loadData(count)
{
	$("#loader").show();
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
					$("#loader").hide();
					if(data.trim()=="") 
					{
						data='<div>Il ne reste plus des données</div>';
						$("#load_more").hide();
						
					}
					$(".col-md-8").append(data);
						
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
				$("#loader").hide();
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
	function confirmation()
	{
	  var r=confirm('vous êtes sure?');
	  if(r==false) return false;	
	}