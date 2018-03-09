<?php
if(isset($_POST['email'])) {
	
	// CHANGE THE TWO LINES BELOW
	$email_to = "mr.aryee@gmail.com";
	
	$email_subject = "Sanctus Property Group website form submissions";
	
			$template_1 = '
		<head>
    <meta charset="UTF-8">
    <title>Sanctus Property Group</title>
    <link rel="stylesheet" href="css/style.css??v=7">
    <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
      <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>

  </head>
  <body class="contact">
    <!-- header -->
    <header>
      <nav>
        <!-- <div class="logo">
          
        </div> -->
        <ul>
          <li class="logo">
            <a href="index.html">
              <img src="images/logo_190x268.png" width="95" height="134" />
              <!--<img src="images/logo_315_134.png" width="315" height="134" />-->
            </a>
          </li>
          <li><a href="index.html">Home</a></li>
          <li>
            <div class="dropdown">
              <a href="services.html">Our Services</a>
              <div class="dropdown-content">
                <ul>
                <li><a href="services.html">Tailored Property Sourcing</a></li>
                <li><a href="services2.html">Rent to Rent</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="contact.html">Contact us</a></li>
        </ul>
      </nav>
      <!-- Banner -->
      <section class="banner">
        <div class="banner-item">
          <img src="images/banner1.jpg" />
        </div>
        <div class="banner-item">
          <img src="images/banner2.jpg" />
        </div>
        <div class="banner-item">
          <img src="images/banner3.jpg" />
        </div>
      </section>
    </header>
    <!-- main body -->
    <h1 class="page-heading">Contact Us</h1>
    <main class="main-content container">
      <div class="content-full">
        ';

		$template_2 = '
		
      </div>
    </main>
    <!-- footer -->
    <footer>
      <div class="footer-items container">
        <span class="footer-item copyright">Copyright 2017 &copy; Lion Property Solutions LTD | All Rights Reserved</span>
        <img class="footer-item" src="images/logo_footer.png" width="124px">
        <!--<img class="footer-item" src="images/logo_161_73.png" width="161px">-->
        <img class="footer-item" src="images/prs_logo.png" width="154">
      </div>
    </footer>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->

  <script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

  </body>
		';

	function died($error) {
		// your error code can go here
		echo $template_1;
		echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
		echo $error."<br /><br />";
		echo "<a href='contact.html'>Please go back</a> and fix these errors.<br /><br />";
		echo $template_2;
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['first_name']) ||
		// !isset($_POST['last_name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['telephone']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');		
	}
	
	$first_name = $_POST['first_name']; // required
	// $last_name = $_POST['last_name']; // required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
  	$error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  // if(!preg_match($string_exp,$last_name)) {
  // 	$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  // }
  if(strlen($comments) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Form details below.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Name: ".clean_string($first_name)."\n";
	// $email_message .= "Last Name: ".clean_string($last_name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Telephone: ".clean_string($telephone)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>

<!-- place your own success html below -->
<?php
echo $template_1;
echo "Thank you for contacting us. We will be in touch with you very soon.";
echo $template_2;

}
die();
?>