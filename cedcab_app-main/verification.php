

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
<body>
 <section class="">
  <nav class="navbar navbar-expand-lg navbar-light py-0"style="background-color: #fabd06;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="index.php"><p id="logo">Ced<span id="clr">Cab</span></p></a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a href="#fbd" type="button" class="btn btn-warning b">Fare Calculator</a>
        </li>
        <li class="nav-item active">
          <a href="login.php" type="button" class="btn btn-success">Login</a>
        </li>
      </ul>
    </div>
  </nav>
</section>
<?php

session_start();
 ini_set("SMTP","ssl://smtp.gmail.com");
   ini_set("smtp_port","587");
   $otp= rand(100000,999999);
             $_SESSION['otp']=$otp;
  //echo("<script>console.log('OTP is: " . $otp . "');</script>");
  if(isset($_POST['register'])){
             $_SESSION['email']=$_POST['email'];//session
             
             $_SESSION['mobile']=$_POST['mobile'];
             
              
    /*Sending mail here*/
    
      $email= $_SESSION['email'];
      
             
			require 'PHPMailerAutoload.php';
			require 'credential.php';
			//require 'includes/SMTP.php';

			$mail = new PHPMailer;

	   // Enable verbose debug output

			$mail->isSMTP();                                                 // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';                                   // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                                         // Enable SMTP authentication
			$mail->Username = 'pk5753549@gmail.com';                          // SMTP username
			$mail->Password = 'Kumar@2021';                                // SMTP password
			$mail->SMTPSecure = 'tls';                                     // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                             // TCP port to connect to
            //echo $_POST['email'];
			$mail->setFrom('pk5752549@gmail.com', 'CEDCAB');
			$mail->addAddress($email);                                    // Add a recipient
          
			$mail->addReplyTo(EMAIL);
			
			$mail->isHTML(true);                                                  // Set email format to HTML
 
			
			$mail->Body ='Your OTP is:'. $_SESSION['otp'] ;
			

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo "<script>alert('Message has been sent successfully')</script>";
			
      }
     

    
  
  
      /*Mail Sending is done*/

              
    
    /*Now Mobile Sending is going to be done*/
          
    
			$fields = array(
				"sender_id" => "FSTSMS",
				"message" => $_SESSION['otp'],
				"language" => "english",
				"route" => "p",
				"numbers" => $_SESSION['mobile'],
			);
			
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode($fields),
			  CURLOPT_HTTPHEADER => array(
				"authorization: kM01wAxbyJXfnVQG4ThocJyQDZbiVAFfc6ZAAU6xO7srlIGU8g3TWszkg3M5",
				"accept: */*",
				"cache-control: no-cache",
				"content-type: application/json"
			  ),
			));
			
			$response = curl_exec($curl);
			$err = curl_error($curl);
			
			curl_close($curl);
			
			if ($err) {
			  //echo "cURL Error #:" . $err;
			} else {
			  //echo $response;
           }
     }  

     if(isset($_POST['check'])){
        $check=$_POST['check'];
        if($check===$_SESSION['otp'])
        {
            echo "<script>alert('User Verified!!')</script>";
        }
        else{
            header("location:signup.php");
        }


     }
     session_destroy();

     
               ?>
               <div class="row">
    <div class="col-md-9 col-md-offset-2">
        <form role="form" method="post" enctype="multipart/form-data">
        	<div class="row">
                <div class="col-sm-9 form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength="50">
                
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 form-group">
                <label for="mobile">Mobile:</label>
               <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter your number" maxlength="150">
              
                </div>
            </div>
            
                 <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="register" class="btn btn-lg btn-success btn-block">SEND OTP</button>
                    <label for="check">CHECK:</label>
                    <input  name="check1" class='form-control' maxlength=6>
                    <button type="submit" name="check" class="btn btn-lg btn-success">Check OTP</button>
                </div>
            </div>
			
        </form>
        
        </div>
        </div>
  


</body>
</html>
