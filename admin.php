<?php
require_once("classes/session.php");
$session = new Session();

if(!$session->is_logedin() || $session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:index.php");
}
require_once("classes/client.php");
require_once("classes/admin.php");
require_once("classes/service.php");
require_once("includes/functions.php");

$admin= new Admin();
$admin_data=$admin->find_by_id($session->get_user_id());
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog Single | Corlate</title>
    
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
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="portfolio.html">Portfolio</a></li>         
                                <li class="active"><a href="client.php">Admin</a></li>                              
                        </li>
                        <li><a href="blog.html">Blog</a></li> 
                        <li><a href="contact-us.html">Contact</a></li>                        
                        <li><a href="includes/logout.php" id="loginbt">logout</a>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->


    <section id="blog" class="container">
     
     <div class="center">
            <h2><?php echo  escape(ucwords($admin_data["nom"]))." ".escape(ucwords($admin_data["prenom"]));   ?></h2>
        </div>
      <div class="blog">
          <div class="row">
            <div class="col-md-8">
            <div><?php echo $session->message(); ?></div>
            <!--/.blog-item-->
            </div><!--/.col-md-8-->

                <aside class="col-md-4">
                     

                    <div class="widget categories">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="blog_category">
                                    <li><a href="#" id="show_param">Paramètre </a></li>
                                   
                                    <li><a href="#" id="show_services">Mes Services  </a></li>
                                    <li><a href="formulaire.php" >Ajouter un admin </a></li>
                                      <li><a href="includes/logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>                     
                    </div><!--/.categories-->
    					        <div class="widget categories" style="padding-left:20px;display:none" id="all_services">
                                 <table border="1" id="tab" class="table table-striped table-bordered table-condensed">
                                         <?php
										 $services =$admin->mes_services();
										  foreach( $services as $service){
		 echo '<tr id="re_'.escape($service["svc_id"]).'">
		 <td>'.escape($service["svc_nom"]).'</td>
		 <td>'.escape($service["svc_type"]).'</td>
		 <td><button  onClick="return delete_service('.escape($service["svc_id"]).');" class="btn btn-default">supprimer</button></td>
		 </tr>';
                                             } ?>  
                                         
                                </table> 
                                <form>       
                                <input type="text" id="nom_svc" placeholder="Nom" />
                                <input type="text" id="type" placeholder="Type" /><br>
                                            <button type="submit" id="ajouter"  class="btn btn-default">Ajouter</button> 
                                            
                                            </form>       
                    </div>
                  <!-- client parametres  -->  
                    <div class="widget categories" style="padding-left:20px;display:none;" id="parametre">
                    <div id="msg"></div>
                      <form>
                      <table width="100%" border="1">
                    <tr>
                      <td><input type="text" value="<?php echo escape($admin_data["nom"] ); ?>" placeholder="Nom" id="nom"/></td>
                    </tr>
                    <tr>
                      <td><input type="text" value="<?php echo escape($admin_data["prenom"] ); ?>" placeholder="Prenom" id="prenom"/></td>
                    </tr>
                    <tr>
                      <td><input type="email" value="<?php echo escape($admin_data["email"] ); ?>" placeholder="exemple@exemple.com" id="email"/></td>
                    </tr>
                    <tr>
                      <td><input type="password" value="" placeholder="******" id="password"/></td>
                    </tr>
                    <tr>
                      <td><input type="password" value="" placeholder="Confirmation" id="password2"/></td>
                    </tr>
                    <tr>
                      <td><input type="tel" value="<?php echo escape($admin_data["num_tel"] ); ?>" placeholder="06 00 00 00 00 " id="tel"/></td>
                    </tr>
                    <tr>
                      <td><input type="text" value="<?php echo escape($admin_data["adresse"] ); ?>" placeholder="adresse..." id="adresse"/></td>
                    </tr>
                    <tr>
                      <td><button  id="enregistrer"  class="btn btn-default">Enregistrer</button></td>
                    </tr>
                  </table>
                  </form>
                    </div>
                               
    				
                </aside>     

        </div><!--/.row-->

      </div><!--/.blog-->

    </section><!--/#blog-->
     <img src="images/load.GIF" style="margin-left:45%;display:none;" id="loader" />
<button id="load_more" class="btn btn-primary btn-lg" style="width:100%;">Plus...</button>

    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Company</h3>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">We are hiring</a></li>
                            <li><a href="#">Meet the team</a></li>
                            <li><a href="#">Copyright</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Support</h3>
                        <ul>
                            <li><a href="#">Faq</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">Refund policy</a></li>
                            <li><a href="#">Ticket system</a></li>
                            <li><a href="#">Billing system</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Developers</h3>
                        <ul>
                            <li><a href="#">Web Development</a></li>
                            <li><a href="#">SEO Marketing</a></li>
                            <li><a href="#">Theme</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Email Marketing</a></li>
                            <li><a href="#">Plugin Development</a></li>
                            <li><a href="#">Article Writing</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Our Partners</h3>
                        <ul>
                            <li><a href="#">Adipisicing Elit</a></li>
                            <li><a href="#">Eiusmod</a></li>
                            <li><a href="#">Tempor</a></li>
                            <li><a href="#">Veniam</a></li>
                            <li><a href="#">Exercitation</a></li>
                            <li><a href="#">Ullamco</a></li>
                            <li><a href="#">Laboris</a></li>
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
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
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
    <script src="js/ajax_admin.js"></script>
</body>
</html>