<?php
require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin() || $session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:../index.html");
}
require_once("../classes/admin.php");
require_once("../classes/reclamation.php");
require_once("../classes/commentaire.php");
require_once("../includes/functions.php");

$admin= new Admin();
$admin_data=$admin->find_by_id($session->get_user_id());
if(isset($_POST["commentaire"]))
{
	$cmt=trim($_POST["commentaire"]);
		if(empty($cmt))
		{
			header('HTTP/1.1 500 , le champ commentaire est obligatoire');
			exit();	
		}
	$commentaire= new Commentaire();
	$commentaire->set_commentaire("cmt_text",$cmt);	
	$commentaire->set_commentaire("cmt_date",date("Y-m-d H:i:s",time()));
	$commentaire->set_commentaire("reclamation_re_id",$_POST["re_id"]);
	$commentaire->set_commentaire("admin_utilisateur_u_id",$session->get_user_id());
	$commentaire->set_commentaire("vue",0);
	if(!$commentaire->create())
	{
		
			header('HTTP/1.1 500 , Erreur de la BD');
			exit();	
	}
	$cmt_data=$commentaire->get_commentaire();
	?>
	
	
	 <div class="media comment_section">
								<div class="pull-left post_comments">
									<a href="#"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?php escape($admin_data["nom"])." ".escape($admin_data["prenom"]);  ?>&choe=UTF-8" class="img-circle" alt="" /></a>
								</div>
								<div class="media-body post_reply_comments">
									<h3>
									<?php 
									echo escape(ucwords($admin_data["nom"]))." ".escape(ucwords($admin_data["prenom"]))
									?>
									</h3>
									<h4><?php echo escape(date("F j, Y, g:i a",strtotime($cmt_data["cmt_date"])));?> </h4>
									<p><?php echo nl2br(escape($cmt_data["cmt_text"]));?></p>
								</div>
	 </div>
	 <?php
	}else
	{
		header('HTTP/1.1 500 , there is no post request');
			exit();	
}
 ?>