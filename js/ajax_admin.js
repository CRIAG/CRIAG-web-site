var count =0;
var show_ser=false;
var show_param=false;
$(document).ready(function(){
	
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
	 
	 //update Admin
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



	
	
});

function loadData(count)
{
	var sData={
				"load":count
			}
		   $.ajax({
			url: "includes/load_admin.php",
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

function addCmt(id)
{
	var dom_cmt="#commentaire_"+id;
	console.log(dom_cmt);
	var commentaire= $(dom_cmt).val();
	var sData={
			"commentaire":commentaire,
			"re_id":id	
			}
		   $.ajax({
			url: "includes/commentaire.php",
			type: "POST",
			data: sData,
			statutsCode: {
				404 : function() {
						$('.msg').text('not found page')
						
					  }
				},	
			success: function(data, statutsText,xhr) {	
					var dom="#cmt_"+id;
					console.log(dom);
					console.log(data);
					$(data).insertBefore(dom);
					
						
					 },
			error : function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
					}
			});
			return false;
	
}