<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | AKPLAY</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-9ZfPnbegQSumzaE7mks2IYgHoayLtuto3AS6ieArECeaR8nCfliJVuLh/GaQ1gyM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@900&family=Cinzel:wght@900&family=Ewert&family=Geostar+Fill&family=Orbitron:wght@900&family=Vast+Shadow&display=swap" rel="stylesheet">
</head>
<body>
  <?php
    // Open database
    $conn = new mysqli('localhost:3306', 'root', 'amokhalaf27', 'jsgame');

    if($conn->connect_error)
    {
        echo "Failed to connect to MySQL : " . $conn->connect_error . " (" . $conn->connect_errno . ")";
        exit(); 
    }

    // Set character set to utf8 
    // utf-8 (8-bit Unicode Transformation Format) is a variable-width character encoding
    //echo "Initial character set is: " . $conn->character_set_name() . "<br/>";
    $conn->set_charset("utf8");
    //echo "Current character set is: " . $conn->character_set_name();
?>
    <header>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
   <a class="navbar-brand" href="#">
    <img src="img/logo-design-ak8.png" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">
   <span class="navbar-brand text-light mb-0 mt-2 h1">Play</span> 
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link text-light active" href="#">Games <span class="sr-only">(current)</span></a>
     
      
    </div>
  </div>
</nav>
</header>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
  <h1 class="display-4 text-center">Welcome to AK PLAY</h1>
  <p class="lead text-center">A gaming website for true heroes</p>
  <hr class="my-4">
  <div id="login" class="img-fluid rounded" >
     <?php
    // Login form
    if (isset($_POST['submit'])) {
        require_once("dblogin1.php");
        // remove special characters
        // adding basic security (mysqli_real_escape_string) to avoid SQL injection (' or 0=0 #)
        $username = $conn->real_escape_string($_POST['username']);
        $password = sha1($_POST['password']);

        $read = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
        $result = $conn->query($read);
        $conn->close();
        // if the query is NOT returning anything there is no match in the database
        if (!$result->num_rows == 1) 
        {
            echo "<p>Invalid username/password</p>";
        } 
        else 
        {
            // start a PHP session
            session_start();
            $_SESSION['logged_in'] = true;
            //redirect and stop present code
            header("Location: index.php"); 
            exit();      
        }
    }
?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            
            <div class="mask rgba-gradient align-items-center">
            
              <div class="container">
                
                
                <div class="row mt-2 justify-content-center ">
                  <div class="col-md-6 col-xl-5 mb-4">
                    
                  
                    <div class="card wow fadeInRight mt-5 bg-transparent border rounded " data-wow-delay="0.3s">
                      <div class="card-body">
                       
                        <div class="text-center">
                          <h3 class="white-text font-weight-bolder">
                            <i class="fas fa-user white-text text-dark"></i><p class="text-light font-weight-bolder"> Log in:</p></h3>
                          <hr class="hr-light text-white">
                        </div>
                      
                        <div class="md-form mt-5">
                          <i class="fas fa-user prefix white-text text-white active"></i>
                          <input type="text" id="form3" name="username" class="text-white form-control bg-transparent border rounded">
                          <label for="form3" class="active text-white">&nbsp;&nbsp;Username</label>
                        </div>
                        <div class="md-form">
                          <i class="fas fa-lock prefix white-text text-white active"></i>
                          <input type="password" id="form4" name="password" class="text-white form-control bg-transparent border rounded form-control">
                          <label for="form4" class="text-white">Your password</label>
                        </div>
                        <div class="text-center mt-4">
                          <input class="btn btn-indigo bg-dark border text-white" type="submit" name="submit" value="Login"></input>
                          <hr class="hr-light mb-3 mt-4">
                          <div class="inline-ul text-center">
                       <button class="btn btn-indigo bg-white border text-dark"><a class="text-decoration-none text-dark" href="register.php">Sign Up</a> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                   
                  </div>
                  
                </div>
               
              </div>
              
            </div>
            
          </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>