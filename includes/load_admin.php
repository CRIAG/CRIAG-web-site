<?php
require_once("../classes/session.php");
$session = new Session();

if(!$session->is_logedin() || $session->is_client()){
	$session->message(" vous n'etes pas connecté ");
	header("location:../index.html");
}
require_once("../classes/client.php");
require_once("../classes/service.php");
require_once("../classes/admin.php");
require_once("../classes/reclamation.php");
require_once("../includes/functions.php");

$admin= new Admin();
$admin_data=$admin->find_by_id($session->get_user_id());

if(isset($_POST["load"]))
{
	
	
	$reclamations=$admin->mes_reclamations();
	foreach($reclamations as $reclamation){
		//set vue for reclamation
		if($reclamation["vue"]==0)
		{
		$rec=new Reclamation();
		$rec->find_by_id($reclamation["re_id"]);
		$rec->set_reclamation("vue",1)	;
		$rec->update();
		}
		
		
		$client=new Client();
		$client_data=$client->find_by_id($reclamation["client_utilisateur_u_id"]);
		
?>
<div class="blog-item">
                      <div class="row">  
                          <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date"><?php echo escape(date("d M Y",strtotime($reclamation["re_date"])));?></span>
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
											
											echo escape($reclamation["svc_nom"]);
										?>
                                        </a>
                                       
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
                                <a href="#"><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?php escape($admin_data["nom"])." ".escape($admin_data["prenom"]);  ?>&choe=UTF-8" class="img-circle" alt="" /></a>
                            </div>
                            <div class="media-body post_reply_comments">
                                <h3>
                                <?php 
								echo escape(ucwords($admin_data["nom"]))." ".escape(ucwords($admin_data["prenom"]))
								?>
                                </h3>
                                <h4><?php echo escape(date("F j, Y, g:i a",strtotime($cmt["cmt_date"])));?> </h4>
                                <p><?php echo nl2br(escape($cmt["cmt_text"]));?></p>
                            </div>
                        </div>
      <?php 
	  endforeach;
	  } 
	  ?>
      <!-- section commentaires -->
       <div class="form-group" id="cmt_<?php echo $reclamation["re_id"] ; ?>">
                              <label>Ajouter un commentaire : </label>
                              <textarea name="commentaire" id="commentaire_<?php echo $reclamation["re_id"] ; ?>" required class="form-control" rows="8" style="50px;border:rgba(0,0,0,1) solid 1px;width:650px;height:150px;"></textarea>
                              <button type="submit"  class="btn btn-default" onclick="addCmt(<?php echo $reclamation["re_id"] ; ?>)">Ajouter</button>
                           </div>
      
      <?php
	}
	  ?>                
		
<?php		
	
}else
{
header('HTTP/1.1 500 Error occurred, there is no post request');
	    exit();
		
	
}


?>