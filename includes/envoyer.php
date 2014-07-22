<?php
require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin() || !$session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:../index.php");
}
require_once("../classes/client.php");
require_once("../classes/service.php");
require_once("../classes/admin.php");
require_once("../classes/reclamation.php");
require_once("../includes/functions.php");

$client= new Client();
$client_data=$client->find_by_id($session->get_user_id());

if(isset($_POST["message"]) && isset($_POST["service"]))
{
	if (empty($_POST['message']) || empty($_POST['service']) || !is_numeric($_POST['service'])) {
     
	header('HTTP/1.1 500 , les deux champs sont obligatoire');
	    exit();
		
    }
	$reclamation = new Reclamation();
	$reclamation->set_reclamation("re_date", date("Y-m-d H:i:s",time()));
	$reclamation->set_reclamation("service_id",$_POST["service"]);
	$reclamation->set_reclamation("client_utilisateur_u_id",$session->get_user_id());
	$reclamation->set_reclamation("re_text",$_POST['message'] );
	$reclamation->set_reclamation("vue", 0);
	if(!$reclamation->create())
	{
		header('HTTP/1.1 500 , erreur de la base de donnée,essayer une nouvelle fois');
	    exit();	
	}
	$rcl=$reclamation->get_reclamation();
	?>
           <div class="blog-item">
                      <div class="row">  
                          <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date"><?php echo escape(date("d M Y",strtotime($rcl["re_date"])));?></span>
                                        <span><i class="fa fa-user"></i> <a href="#"> 
                                        <?php echo  reduce_name(escape(ucwords($client_data["nom"]))." ".escape(ucwords($client_data["prenom"])));   ?>
                                        </a></span>
                                        <span><i class="fa fa-comment"></i> <a href="client.php#comments">0 Réponse </a></span>
                                        <span><i class="fa fa-eye"></i>
                                        <a href="#">
                                        Non 
                                        Vue
                                        </a></span>
                                    </div>
                        </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    <p>
                                    <?php echo nl2br(escape($rcl["re_text"]));?>
                                    </p>
                                    <div class="post-tags">
                                        <strong>Service:</strong> <a href="#">
                                        <?php
											$service=new Service();
											$sdata=$service->find_by_id($rcl["service_id"]);
											echo escape($sdata["svc_nom"]);
										?>
                                        </a>
                                        <p style="float:right"><a href="includes/delete.php?re_id=<?php echo $rcl["re_id"];  ?> "onclick="return confirmation();">supp</a></p>
                                    </div>
                                </div>
                      </div>
              </div>
	<?php
}else
{
header('HTTP/1.1 500 , there is no post request');
	    exit();	
}


?>