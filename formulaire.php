<?php
require_once("classes/session.php");
$session = new Session();	
	if($session->is_logedin() && $session->is_client())
	{
	      header('Location:client.php');
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Inscription | CRIAG</title>
    
    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
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
</head><!--/head-->

<body>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +0123 456 70 90</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="https://www.facebook.com/criaggroup" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/CRIAGgroup" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="skype:criag.group?userinfo"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
    <form role="form"  method="post" action="include /CRIAG-web-site/include/inscription.php">
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
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li ><a href="index.php">Accueil</a></li>
                        <li><a href="le_groupe.html">Le groupe</a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Solutions de gestion<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
            
      
                             
                               <li><a href="ERP.html">ERP sage </a></li>
                                <li><a href="Logiciel_CRIAG.html">Logiciel Criag</a></li>
                                                               <li><a href="Gestimum.html">Gestimum</a></li>
                                                                                              <li><a href="methodologie_gestion.html">Méthodologie</a></li>
                            </ul>

                        </li> <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Solutions Réseaux<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
            
      
                             
                               <li><a href="Camera_surveillance.html">Caméra de surveillance </a></li>
                                <li><a href="Pointage_controle_d'acces.html">Pointage et contrôle d'accès</a></li>
                                                               
                                                                                              <li><a href="méthodologie_réseau.html">Méthodologie</a></li>
                            </ul>

                        </li>  
    
                             <li><a href="Agencement.html">Mobilier de bureau</a></li>              
                       
                        <li><a href="contact-us.html">Contact</a></li> 
                        <li class="active"><a href="formulaire.php">Inscription</a></li> 
                        
                       
                          
                       
                      
                       
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

    <section id="contact-info"></section>  <!--/gmap_area -->

    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Remplissez ce formulaire</h2>
                <p class="lead"> * Champs obligatoires </p>
            </div> 
            <div class="row contact-wrap" > 
                <div class="center"> <b> <?php echo $session->message(); ?> </b></div>
<form  class="contact-form" name="contact-form" method="post" action="includes/inscription.php">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label >Nom *</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Prenom *</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                      <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirmez le password *</label>
                            <input type="password" name="password2" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Adresse </label>
                            <input type="text" name="adresse" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Numero de téléphone </label>
                            <input type="tel" name="tel" class="form-control">
                        </div>
                               <div class="form-group">
                            <input type="submit"  required="required" class="btn btn-default"/>
                        </div>                
                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

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
                        <li>   <a target="_blank" href="http://ma.linkedin.com/pub/otmane-el-guenouni/83/b04/34a/" title="otmane el guenouni linkedin profil "> <small>Créé par Otmane  El Guenouni</small></a> 
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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55208366-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>