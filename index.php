<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Accueil</title>
	
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link href="css/jquery_popup.css" rel="stylesheet">
</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number">
                          <p><i class="fa fa-phone-square"></i>  +212 5 39 93 38 39</p></div>
                      </div>
                      <div class="col-sm-6 col-xs-8">
                         <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>

                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/criag.gif" alt="logo" ></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="le_groupe.html">Le groupe</a></li>
                        <li class="dropdown"><a  href="#" class="dropdown-toggle" data-toggle="dropdown">Solutions de gestion<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">



                             <li><a href="ERP.html">ERP sage </a></li>
                             <li><a href="Logiciel_CRIAG.html">Logiciel Criag</a></li>
                             <li><a href="Gestimum.html">Gestimum</a></li>
                             <li><a href="methodologie_gestion.html">Méthodologie</a></li>
                         </ul>

                     </li> <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Solutions Réseaux<i class="fa fa-angle-down"></i></a>
                     <ul class="dropdown-menu">


                       <li><a href="installation_reseaux.html">Installation des réseaux</a></li>
                       <li><a href="Camera_surveillance.html">Caméra de surveillance </a></li>
                       <li><a href="Pointage_controle_d'acces.html">Pointage et contrôle d'accès</a></li>

                       <li><a href="méthodologie_réseau.html">Méthodologie</a></li>
                   </ul>

               </li>  

                <li class="dropdown" ><a href="#" class="dropdown-toggle" data-toggle="dropdown">Matériel et mobilier <i class="fa fa-angle-down"></i></a> <ul class="dropdown-menu" style="min-width: 265px;">
                     <li><a href="materiel_informatique.html">Matériel informatique</a></li> 
                     <li><a href="materiel_informatique_consammable.html">Materiel informatique consommable</a></li> 
                      <li><a href="Agencement.html">Mobilier de bureau</a></li>    
                      
                    </ul>
                    </li>
                 <li><a href="contact-us.html">Contacts</a></li> 

               <?php 
               require_once("classes/session.php");
               $session =new   Session();
               if($session->is_logedin() && $session->is_client()){
                  echo ' <li><a href="client.php">Client</a></li>';
                  echo ' <li><a href="includes/logout.php"><i class="fa fa-sign-out" ></i></a></li>';
              }else if($session->is_logedin() && !$session->is_client())
              {
                  echo ' <li><a href="admin.php">Admin</a></li>';
                  echo ' <li><a href="includes/logout.php"><i class="fa fa-sign-out" ></i></a></li>';
              }else
              {
                  echo '<li> <a href="#" id="loginbt"><i class="fa fa-sign-in" style="size:30px;"></i></a></li>';
                  echo '<li> <a href="formulaire.php">Inscription</a></li>';

              }
              ?>




          </ul>
      </div>
  </div><!--/.container-->
</nav><!--/nav-->

</header><!--/header-->

    <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                <div class="item active" style="background-image: url(images/slider/img5.gif)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content" >
                                    <h1 class="animation animated-item-1" style="color:rgba(0,0,0,0.7)">Lorem ipsum dolor sit amet consectetur adipisicing elit</h1>
                                    <h2 class="animation animated-item-2"  style="color:rgba(0,0,0,0.7)">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Plus...</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="images/slider/3LOGOS.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/img1.gif)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1" style="color:rgba(0,0,0,0.7)">Lorem ipsum dolor sit amet consectetur adipisicing elit</h1>
                                    <h2 class="animation animated-item-2" style="color:rgba(0,0,0,0.7)">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Plus...</a>
                                </div>
                            </div>

                            

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/img4.gif)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1" style="color:rgba(0,0,0,0.7)" >Lorem ipsum dolor sit amet consectetur adipisicing elit</h1>
                                    <h2 class="animation animated-item-2" style="color:rgba(0,0,0,0.7)">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">plus...</a>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="images/slider/chaise4.gif" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.item-->
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>

        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section><!--/#main-slider-->
    <!--/services-->
    <section id="services" class="service-item">
	   <div class="container">
            <div class="center wow fadeInDown">
                <h2>Nos Services</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row">

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services1.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">INTEGRATEUR DE SOLUTIONS DE GESTION</h3>
                            <p>Lorem ipsum </br> dolor sit  ame consectetur  adipisicing elit </br></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services2.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">INTEGRATEUR DE SOLUTONS RESEAUX TELECOM ET VIDEO-SURVEILLANCE</h3>
                            <p>Lorem ipsum dolor sit ame consectetur adipisicing  elit</p> 
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services3.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">AGENCEMENT ET INSTALLATION DE BUREAU</h3>
                            <p>Lorem ipsum dolor sit ame consectetur adipisicing <br/> elit <br/></p>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#feature--><!--/#recent-works-->

   
    <!--/#middle-->

    <section id="content">
        <div class="container">
            <!--/.row-->
        </div><!--/.container-->
    </section><!--/#content-->

    <section id="partner">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Nos partenaires</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>    

            <div class="partners">
                <ul>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="images/partners/sage.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="images/partners/mobotix2.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="images/partners/pelco.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="images/partners/gestimum.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="images/partners/horoquartz.png"></a></li>
                </ul>
                <ul>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="images/partners/hp.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="images/partners/dell.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="images/partners/trarem.png"></a></li>
                </ul>
                
            </div>        
        </div><!--/.container-->
    </section><!--/#partner-->

    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h2>Have a question or need a custom quote?</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation +0123 456 70 80</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->

    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                       <h3>Solutions de gestion</h3>
                        <ul>
                          <li><a href="ERP.html" title="solutions de gestion de sage ">ERP sage </a></li>
                          <li><a href="Logiciel_CRIAG.html" title="solutions de gestion de CRIAG">Logiciel Criag</a></li>
                          <li class="active"><a href="Gestimum.html" title="solutions de gestion de Gestimum">Gestimum</a></li>
                          <li><a href="methodologie_gestion.html" title=" notre Methodologie">Méthodologie</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                       <h3>Solutions Réseaux</h3>
                     <ul>
                       <li><a href="installation_reseaux.html" title="installation reseaux">Installation des réseaux</a></li>
                       <li><a href="Camera_surveillance.html" title="Camera de surveillance">Caméra de surveillance </a></li>
                       <li><a href="Pointage_controle_d'acces.html" title="Pointage controle d'acces">Pointage et contrôle d'accès</a></li>

                       <li><a href="méthodologie_réseau.html" title="notre méthodologie réseau">Méthodologie</a></li>
                   </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                      <h3> Matériel et mobilier </h3>
                     <ul>
                     <li><a href="materiel_informatique.html" title="Matériel informatique">Matériel informatique</a></li> 
                     <li><a href="materiel_informatique_consammable.html" title="Materiel informatique consommable">Materiel informatique consommable</a></li> 
                      <li><a href="Agencement.html" title="Mobilier de bureau">Mobilier de bureau</a></li>    
                      
                    </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>CRIAG group</h3>
                        <ul>
                            <li><a href="le_groupe.html#criag">CRIAG sarl</a></li>
                            <li><a href="le_groupe.html#pc_halle">Pc halle</a></li>
                            <li><a href="le_groupe.html#serviges">Serviges</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->
    
    <div id="logindiv">			
            <form class="form" action="#" id="login">
                <img src="images/button_cancel.png" class="img" id="cancel"/>	
                <h3>Connexion</h3>
                <hr/><br/>
                <label>Email : </label>
                <br/>
                <input type="text" id="email" placeholder="Ex -john123"/><br/>
                <br/>
                <label>password : </label>
                <input type="text" id="password" placeholder="************"/><br/>
                <br/>
                <input type="button" id="loginbtn" value="Login"/>
                <input type="button" id="cancel" value="Cancel"/>
                <br/> 

            </form>

        </div>

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2014 CRIAG Tous droits réservés.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="contact-us.html">Contacts</a></li>
                        <li>   <a target="_blank" href="http://ma.linkedin.com/pub/otmane-el-guanouni/83/b04/34a/" title="otmane el guenouni lineked "> <small>Créé par Otmane  El Guenouni</small></a> 
</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
    <script >
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

    </script>
</body>
</html>