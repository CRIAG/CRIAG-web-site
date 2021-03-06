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

if(isset($_POST["load"]))
{
	$ofsset=$_POST["load"]*10;
	$reclamations=$client->mes_reclamations($ofsset);
	
	foreach($reclamations as $reclamation){
?>
<div class="blog-item">
                      <div class="row">  
                          <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date"><?php 
										setlocale(LC_TIME, 'fra_fra.utf8');
										echo escape(strftime(" %#d %b %Y",strtotime($reclamation["re_date"])));?></span>
                                        <span><i class="fa fa-user"></i> <a href="#"> 
                                        <?php echo  reduce_name(escape(ucwords($client_data["nom"]))." ".escape(ucwords($client_data["prenom"])));   ?>
                                        </a></span>
                                        <span><i class="fa fa-comment"></i> <a href="client.php#comments">
                                        <?php
										$count =Reclamation::commentaires_counts($reclamation["re_id"]);
										echo $count." Reponse";
										echo ( $count<2)?"":"s";
										?>
                                        
                                        </a></span>
                                        <span><i class="fa fa-eye"></i>
                                        <a href="#">
                                        <?php echo ($reclamation["vue"]==1)?"":"Non "  ?>
                                        Vue
                                        </a></span>
                                    </div>
                        </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    <p>
                                    <?php echo nl2br(escape($reclamation["re_text"]));?>
                                    </p>
                                    <div class="post-tags">
                                        <strong>Service:</strong> <a href="#">
                                        <?php
											$service=new Service();
											$sdata=$service->find_by_id($reclamation["service_id"]);
											echo escape($sdata["svc_nom"]);
										?>
                                        </a>
                                        <p style="float:right"><a href="includes/delete.php?re_id=<?php echo $reclamation["re_id"];  ?> "onclick="return confirmation();">supp</a></p>
                                    </div>
                                </div>
                      </div>
              </div><!--/.blog-item-->
   <?php if($count!=0){ 
   ?>
                        <h1 id="comments_title"> <?php
										echo $count." Reponse";
										echo ( $count<2)?"":"s";
										?></h1>
   <?php
   $cmts=Reclamation::mes_commentaires($reclamation["re_id"]);
   foreach($cmts as $cmt):
   ?>
                        <div class="media comment_section">
                            <div class="pull-left post_comments">
                            <?php 
							    $admin=new Admin();
								$admin_data= $admin->find_by_id($cmt["admin_utilisateur_u_id"]);
							?>
                                <a href="#"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?php escape($admin_data["nom"])." ".escape($admin_data["prenom"]);  ?>&choe=UTF-8" class="img-circle" alt="" /></a>
                            </div>
                            <div class="media-body post_reply_comments">
                                <h3>
                                <?php 
								echo escape(ucwords($admin_data["nom"]))." ".escape(ucwords($admin_data["prenom"]))
								?>
                                </h3>
                                <h4><?php 
								setlocale(LC_TIME, 'fra_fra');
								echo escape(strftime("%#d %B %Y, %H:%M ",strtotime($cmt["cmt_date"])));?> </h4>
                                <p><?php echo nl2br(escape($cmt["cmt_text"]));?></p>
                            </div>
                        </div>
      <?php 
	  endforeach;
	  } ?>                
		
<?php		
	}
}else
{
header('HTTP/1.1 500 Error occurred, there is no post request');
	    exit();
		
	
}


?>