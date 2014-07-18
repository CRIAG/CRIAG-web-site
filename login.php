<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require_once("classes/session.php");
$session = new Session();

if($session->is_logedin() ){
	
	echo "is logedin";
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/jquery_popup.css" rel="stylesheet">
</head>
<body>

<a href="#" id="loginbt">Login</a><br />
<a href="includes/logout.php">logout</a>

<!--Login Form -->	
        <div id="logindiv">			
            <form class="form" action="#" id="login">
                <img src="images/button_cancel.png" class="img" id="cancel"/>	
                <h3>Login Form</h3>
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
         <script src="js/jquery.js"></script>
<script src="js/ajax.js"></script>
</body>
</html>