<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer_files/Exception.php';
require 'phpmailer_files/PHPMailer.php';
require 'phpmailer_files/SMTP.php';

include("connection.php");

$emailSent = false;

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $dateFilled = $_POST['dateFilled'];

    $stmt = $conn->prepare("INSERT INTO `dbtable` (`name`, `email`, `phone`, `message`, `dateFilled`) VALUES (?, ?, ?, ?, ?);");
    $stmt->bind_param("ssiss", $name, $email, $phone, $message, $dateFilled);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);
        try {
// These credentials will change at the end; the once mentioned below are for test purpose only.
            $mail->isSMTP();
            $mail->Host = 'smtp.elasticemail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ravijeetsharma180@gmail.com';
            $mail->Password = 'BE0F6C82083078F49D2B96A33BB0AFDCDFA4';
            $mail->Port = 2525;

 // Email content
            $mail->setFrom('ravijeetsharma180@gmail.com', 'Sender Name');
            $mail->addAddress('ravijeetsharmargra1@gmail.com');   // Recipient email (will have multiple recipients in future)
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Enquiry';    // Email's subject
            $mail->Body = "Name: $name <br>Phone: $phone <br> Email: $email<br>Message: $message <br> Date of enquiry: $dateFilled";

            if($mail->send()){
                $emailSent = true;
            }
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();


   
    if ($emailSent) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var popupShown = sessionStorage.getItem('popupShown');
                if (!popupShown) {
                    document.querySelector('.popup').classList.add('active');
                    sessionStorage.setItem('popupShown', true);
                }
    
                var dismissPopupHandler = function() {
                    document.getElementById('btn').style.display = 'block';
                    document.querySelector('.popup').classList.remove('active');
                    sessionStorage.removeItem('popupShown');
                };
    
                document.getElementById('dismiss-popup-btn').addEventListener('click', dismissPopupHandler);
            });
        </script>";
    } else {
        echo "<script>alert('Email could not be sent. Please try again.');</script>";
    }

}


?>

<!-- HTML begins from here -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <meta name="description" content="TCET ACM-SIGAI">
    <meta name="keywords" content="ACM-SIGAI, acm, acm-sigai, tcet, TCET">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="icon" type="image/x-icon" href="./Images/logo.png">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="Gallery.css">
    <link rel="stylesheet" href="contact.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="Script.js"></script>

   
    <title>ACM-SIGAI TCET</title>
</head>
<body>
  <div class="mob-res-div" id="ResDiv">
  <h2 class="responsive-text">ACM SIG-AI</h2>
  <div class="divider"></div>
  
  </div>
    <nav class="navbar">
        <div class="navbar-brand">
          
            <img src="./Images/SIG_AI.png" class="logo" id="logo" alt="Logo Image">
        </div>
        <div class="navbar-list" id="TopNav">
            <ul>
              <li><a href="#home">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#events">Events</a></li>
              <li><a href="#publications">Publications</a></li>
              <li><button><a href="#contact">Contact Us</a></button></li>
              <li><a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a></li>
            </ul>
        </div>
        
    </nav>
<section id="home"></section>
<section class="home">
  <div class="home-content">
      <h1>Welcome to</h1>
      <h3>TCET ACM-SIGAI</h3>
      <p>Student's Chapter</p>

      <div class="btn-box">
          <a href="#">Get Started</a>
          <a href="#">Let's Talk</a>
      </div>
  </div>

  <div class="home-sci">
      <a href="#"><i class='bx bxl-facebook'></i></a>
      <a href="#"><i class='bx bxl-instagram' ></i></a>
      <a href="#"><i class='bx bxl-linkedin' ></i></a>
  </div>

  <span class="home-imgHover"></span>
</section>

<!-- <section id="about"></section> -->
<div class="about-us">
  <div class="container">
      <div class="row">
          <div class="flex">
              <h3>About Us</h3>
              <h2>TCET-ACM SIGAI Student's Chapter</h2>
              <h2><h3></h3></h2>
              <p id="about-description" ></p>
              <div class="social-links">
                  <a href=""><i class="fab fa-facebook-f"></i></a>
                  <a href=""><i class="fab fa-twitter"></i></a>
                  <a href=""><i class="fab fa-instagram"></i></a>
              </div>
              <a href="" class="btn">Learn More</a>
          </div>
          <div class="flex">
              <div class="flex-image">
                   <img class= about-image src='./Images/sigai.JPG'>
              </div>
             
          </div>
      </div>
  </div>
</div>
<script>
  const textToType = "TCET ACM SIGAI is a professional body that was established in January 2023. It is a body that aims to bring together and inculcate research ideologies in people from all over India with a passion in the field of Artificial intelligence and Machine Learning by means of conducting seminars, debates, Kaggle competitions, etc.";

  let index = 0;
  const speed = 15; // typing speed in milliseconds
  const descriptionElement = document.getElementById('about-description');

  function typeWriter() {
    if (index < textToType.length) {
      descriptionElement.innerHTML += textToType.charAt(index);
      index++;
      setTimeout(typeWriter, speed);
    }
  }

  typeWriter();
</script>
</section>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>



   <!-- ----------------------------------publication section Begins Here ------------------------------------- -->

    <!-- <section id="publications">
        
    </section> -->

    <!-- ----------------------------Gallery section------------------------- -->
    <div class="wrapper">
      <h1 class="gallery-heading">Gallery</h1>
      <div class="carousel">
        <img src="./Images/1.jpg" alt="img" draggable="false">
        <img src="./Images/2.png" alt="img" draggable="false">
        <img src="./Images/3.jpg" alt="img" draggable="false">
        <img src="./Images/4.jpg" alt="img" draggable="false">
        <img src="./Images/5.jpg" alt="img" draggable="false">
        <img src="./Images/6.jpg" alt="img" draggable="false">
        <img src="./Images/7.JPG" alt="img" draggable="false">
      </div>
      <div class="arrow-buttons">
        <i id="left" class="fas fa-angle-left"></i>
        <i id="right" class="fas fa-angle-right"></i>
      </div>
    </div>



    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    <br>
    <br>
    <br>
    
  
  

<!-- ----------------------------------Contact section Begins Here ------------------------------------- -->


    <section id="contact">
       
       
        <div class="container">
            <!-- <span class="big-circle"></span> -->
            <!-- <img src="img/shape.png" class="square" alt="" /> -->
            <div class="form">
              <div class="contact-info">
                <h3 class="title">Let's get in touch</h3>
                <p class="text">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe
                  dolorum adipisci recusandae praesentium dicta!
                </p>
      
                <div class="info">
                  <div class="information">
                    <img src="./Images/location.jpg" class="icon" alt="" />
                    <p>Thakur Village, Kandivali[East], Mumbai-400101 </p>
                  </div>
                  <div class="information">
                    <img src="./Images/email.png" class="icon" alt="" />
                    <p>acm-sigai@gmail.com</p>
                  </div>
                  <div class="information">
                    <img src="./Images/phone.jpg" class="icon" alt="" />
                    <p>123-456-789</p>
                  </div>
                </div>
      
                <div class="social-media">
                  <p>Connect with us :</p>
                  <div class="social-icons">
                    <a href="#">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                      <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#">
                      <i class="fab fa-linkedin-in"></i>
                    </a>
                  </div>
                </div>
              </div>
      
              <div class="contact-form">
                <!-- <span class="circle one"></span>
                <span class="circle two"></span> -->
      
               <form method="post" action="Index.php" id="contactForm" onsubmit="submitForm(event)">

                <h3 class="title">Contact us</h3>

                  <div class="input-container">
                    <input type="text" name="name" class="input" required/>
                    <label for="name">Username</label>
                    <span>Username</span>
                  </div>

                  <div class="input-container">
                    <input type="email" name="email" class="input" required/>
                    <label for="email">Email</label>
                    <span>Email</span>
                  </div>

                  <div class="input-container">
                    <input type="tel" name="phone" class="input" required/>
                    <label for="phone">Phone</label>
                    <span>Phone</span>
                  </div>

                 <input type="hidden" id="dateFilled" name="dateFilled" />

                  <div class="input-container textarea">
                    <textarea name="message" class="input"></textarea>
                    <label for="message">Message</label>
                    <span>Message</span>
                  </div>
                  <input type="submit" id="btn" value="Submit" name="submit" class="btn" />


                </form>
              </div>
            </div>
          </div>

          <!-- POP UP -->

          <div class="popup center">
            <div class="icon">
                <i class="fa fa-check"></i>
            </div>
            <div class="title">
               Mail Sent
            </div>
            <div class="description">
              We have received your message successfully.
            </div>
            <div class="dismiss-btn">
              <button id="dismiss-popup-btn">Dismiss</button>
            </div>
            </div>

             <!-- POP UP -->
             
      
          <script src="contact.js"></script>
          <script src="https://smtpjs.com/v3/smtp.js"></script>   
          <script>document.getElementById('dateFilled').value = new Date().toISOString();</script>
          </section>

    
    <script src="Gallery.js"></script>
</body>
</html>