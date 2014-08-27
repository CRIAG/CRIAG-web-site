<?php
    

    $name = @trim(stripslashes($_POST['name'])); 
    $email = @trim(stripslashes($_POST['email'])); 
    $subject = @trim(stripslashes($_POST['subject'])); 
    $message = @trim(stripslashes($_POST['message'])); 
    $number=@trim(stripslashes($_POST['number'])); 
   
    $email_from = $email;
    $email_to = 'the_loverboy@hotmail.fr';//replace with your email
    if(!empty($name) && !empty($email) && !empty($subject) && !empty($message) )
    {
        $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;
        if(!empty( $number))
        {
           $body.=' TEL: '.$number;
       }
       $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');
       if($success)
       {

           echo "<h1>votre message a été envoyer</h1>";
          echo '<meta http-equiv="refresh" content="5;url=index.php">';
           echo "<br/>redirection dans 5 secondes";
       }else
       {
        echo "<h1>erreur :votre message n'a pas pu  etre envoyer</h1>";
        echo '<meta http-equiv="refresh" content="5;contact-us.html">';

        echo "<br/>redirection dans 5 secondes";
    }
    }else
    {
         echo "<h1>les champs nom, email, sujet et message sont obligatoire</h1>";
          echo '<meta http-equiv="refresh" content="5;contact-us.html">';
           echo "<br/>redirection dans 5 secondes";
    }

    ?>