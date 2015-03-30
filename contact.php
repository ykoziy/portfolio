<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yuriy Koziy &mdash; Contact</title>
  <link rel="stylesheet" href="css/text.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <header>
    <div class="container" id="header-background">
      <div class="row">
        <div class="col-xs-6" id="logo">
          <img src="img/logo.png" alt="Yuriy Koziy">
        </div> <!-- #logo -->
        <nav class="col-md-5">
          <ul>
            <li><a href="index" title="">HOME</a></li>
            <li><a href="about" title="">ABOUT</a></li>
            <li><a class="active" href="contact" title="">CONTACT</a></li>
          </ul>
        </nav> <!-- #nav -->
      </div> <!-- #row -->
    </div> <!-- #header-background -->
  </header>

  <div class="main-background">
    <div class="container main-background">
      <div class="col-md-11 main-content" id="contact-area">
        <div id="contact-form">
          <h1>Get in Touch</h1>
          <?php
              //cf = contact form
              $cf = array();
              //sr = server response
              $sr = false;

              if(isset($_SESSION['cf_return'])) {
                  $cf = $_SESSION['cf_return'];
                  $sr = true;
              }
          ?>
          <ul class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>" id="error">
            <li id="error-msg">There were some problems with your form submission:</li>
            <?php
                if(isset($cf['errors']) && count($cf['errors']) > 0) :
                  foreach($cf['errors'] as $er) :
            ?>
            <li><?php echo $er ?></li>
            <?php
                  endforeach;
                endif;
            ?>
          </ul>
          <p class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>" id="success">Thank you! I will get back to you ASAP!</p>
          <form action="php/sendmail.php" method="POST">
            <label for="name">Name<span class="required">*</span></label>
            <input name="name" id="name" type="text" placeholder="Type here" autofocus="autofocus">
            <label for="email">Email Address<span class="required">*</span></label>
            <input name="email" id="email" type="email" placeholder="jon@example.com">
            <label for="message">Message<span class="required">*</span></label>
            <textarea name="message" id="message" placeholder="Your message must be greater than 20 charcters"></textarea>
            <div class="g-recaptcha" data-sitekey="6LeDMfQSAAAAABcDfpMl3WaMANd6KHFQFDoQd4G6"></div>
            <p id="req-field"><span class="required">*</span> indicates a required field</p>
            <input id="submit-button" name="submit" type="submit" value="Submit">
          </form>
          <?php unset($_SESSION['cf_return']); ?>
        </div> <!-- #contact-form -->
      </div> <!-- #contact-area -->
    </div> <!-- .main-background -->
  </div> <!-- .main-background -->

  <footer>
    <div class="container" id="footer-background">
      <div class="col-md-12">
        <p>Copyright &copy; 2015 Yuriy Koziy. All Rights Reserved.</p>
      </div> <!-- .grid24 -->
    </div> <!-- #footer-background -->
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>