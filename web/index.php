<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Macho Man | AKPLAY</title>
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-9ZfPnbegQSumzaE7mks2IYgHoayLtuto3AS6ieArECeaR8nCfliJVuLh/GaQ1gyM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@900&family=Cinzel:wght@900&family=Ewert&family=Geostar+Fill&family=Orbitron:wght@900&family=Vast+Shadow&display=swap" rel="stylesheet">
</head>
<body class="bodygame" >

 <?php
        $conn = new mysqli("localhost:3306", "root", "amokhalaf27", "jsgame");
        $conn->set_charset("utf8"); 
   
     if($conn->connect_error)
    {
        echo "Failed to connect to MySQL : " . $conn->connect_error . " (" . $conn->connect_errno . ")";
        exit(); 
    }
    
   
    ?>
    <?php

            function findes($a, $b)
            {
                return true;
            }
    ?>






<?php 
    // Registration form
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // require_once('index.php');
        
        $username = $_REQUEST['Name1'];
        $score = $_REQUEST['score'];
    
           $sql = $conn->prepare("insert into scoreboard (Name, Score) values(?, ?) ");
           $sql->bind_param("si",$username, $score);
            $sql->execute();
            $conn->close();
    }
    
?>

    
   <div class="container">
       <div class="row justify-content-between">
    <h1 class="text-center align-center mb-3">Macho Game</h1>
    <button class="btn align align-right bg-dark border text-dark"><a class=" text-center align-center text-decoration-none text-white" href="loginform.php">Log out</a> </button>
  </div>
    <div class="row fluid ">
    <div class="col-sm-3 col-md-3 col-lg-3  rounded bg-transparent ">
    <h2 class="text-center  text-info shadow-lg p-1 mb-3 bg-dark rounded font-weight-bold">Rules:</h2>
    <p class="text-center mt-5 text-info shadow-lg p-1 mb-3 bg-dark rounded font-italic font-weight-bold">Use the arrows to play</p>
    <p class="text-center  text-info shadow-lg p-1 mb-3 bg-dark rounded font-italic font-weight-bold">You start with 30000 Points</p>
    <p class="text-center text-info  shadow-lg p-1 mb-3 bg-dark rounded font-italic font-weight-bold">The goal is to keep the 30000 points</p>
    <p class="text-center  text-info  shadow-lg p-1 mb-3 bg-dark rounded font-italic font-weight-bold">Complete the level as fast as you can to reach maxium points</p>
    <p class="text-center  text-info  shadow-lg p-1 mb-3 bg-dark rounded font-italic font-weight-bold">If u get hit by the soliders you lose 5000 points</p>
    <p class="text-center  text-info  shadow-lg p-1 mb-3 bg-dark rounded font-italic font-weight-bold">Save the woman, Macho Man !!</p>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6">
      <canvas  width="500" height="500" id="canvas">
        </canvas>
        <form class="navnform mt-3 p-3 text-center border border-primary  rounded" action="index.php" method="POST" style="display: hidden;">
            <input id="navnscore" class="navnscore border-primary bg-white text-dark mr-4 border rounded" type="text" name="Name1" placeholder="Insert name" >
            <input id="score1" name="score" type="hidden">
            <input id="subknap" class="border pl-2 pr-2 rounded bg-dark text-white" type="submit" value="Insert">




        </form>

    </div>
    <div class="col-sm-3">
       <div class="col-md-3">
           <div class="col-lg-3 ml-3">
               <div class="col-xl-3 ">
                    <form class="scoreboard" action="table.php" method="post">
                        <?php
                            $conn = new mysqli("localhost:3306", "root", "amokhalaf27", "jsgame");
                            $conn->set_charset("utf8");
                            ?>
  
                        <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
 
                            ?>
                                <?php
                                $sql = $conn->prepare("select * from scoreboard order by Score DESC"); // DESC er en tæller fra det højeste tal og ned
                                $sql->execute();
                                $result = $sql->get_result();
                                echo '<table   class="bg-transparent  border border-white rounded table"> ';
                                echo "<tr>";
                                echo '<th class="bg-dark text-info" >Nr</th>';
                                echo '<th class="bg-dark text-info">Name</th>';
echo '<th class="bg-dark text-info">Score</th>';

                                echo "</tr>";
                                //if ($result->num_rows > 0)
                                $number = 1; // Her, tæller vi fra 1 og opad. vi gennemføre et loop

                                {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='bg-dark text-white border border-white '>".$number."</td>";
        echo "<td class='bg-dark text-white border border-white  '>".$row["Name"]."</td>";
        echo "<td class='bg-dark text-white border border-white  '>".$row["Score"]."</td>";
        echo "</tr>";

        $number++;

    }    
                                }
//else

echo "</table>"
?>
     <?php
        $conn->close();
        ?>
    <p>
   
    </form>
    </div>
    </div>
    </div>
    </div>
  </div>
</div>



</div>

</div>

<div class="container text-center">
<button class="btn border rounded align-items-center bg-info text-white" id="replay">Reset<i ></i></button>


</div>


    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>









