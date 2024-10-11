<?php
session_start();
if (isset($_SESSION["userID"])) {
    header("Location: ./index.php");
    exit();
}

if (isset($_POST['user-name'])){
        require_once 'include/connection.php';
        $sql = "SELECT 
                    * 
                FROM 
                    USERS 
                WHERE 
                    BINARY USERS.USERID = ? 
                    AND BINARY USERS.PASSWORD = ? 
                    ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $USERID, $PASSWORD);
        $USERID = $_POST['user-name'];
        $PASSWORD = $_POST['user-password'];
        $rows = array();
        //acquire data
        if ($stmt->execute()){
            $result = $stmt->get_result();
            if($r = $result->fetch_assoc()) {
                if ($r["FLG"] == "1"){
                    if ($r["HR_FLG"] == "0"){
                        $error = "Your account is prohibited from accessing KASH.";
                    } else {
                        try {
                            mysqli_autocommit($conn,FALSE);
                
                            $sql = "INSERT INTO 
                                        ACCESS_LOG ( 
                                            USERID, 
                                            IPADDRESS, 
                                            DATETIME ) 
                                        VALUES ( 
                                            ? , 
                                            ? , 
                                            ? ) ";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ssi", 
                                                    $USERID, 
                                                    $IPADDRESS, 
                                                    $DATETIME);
                            $USERID = $_POST['user-name'];;
                            $IPADDRESS = $_SERVER['REMOTE_ADDR'];
                            $DATETIME = date("YmdHis");
                            if ($stmt->execute()){ 
                                $stmt->close();
                            } else {
                                $stmt->close();
                                mysqli_rollback($conn);
                                mysqli_close($conn);
                                http_response_code(400);
                            }   
                            mysqli_commit($conn);
                            mysqli_close($conn);
                            $_SESSION['userID'] = $r['userid'];
                            $_SESSION['userName'] = $r['firstname'] . $r['lastname'];
                            $_SESSION['FIRSTNAME'] = $r['firstname'];
                            $_SESSION['LASTNAME'] = $r['lastname'];
                            http_response_code(200); 
                        } catch (Exception $e) {
                            mysqli_rollback($conn);
                            mysqli_close($conn);
                            http_response_code(400);
                            $error = "Unable to login! Please try again!";
                        }  
                        mysqli_close($conn);
                        header("Location: ./index.php"); 
                        exit();
                    }
                    
                } else {
                    $error = "Your account is locked! Please contact the system administrator.";
                    
                }  
            } else {
                $error = "Invalid username/password!";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="./login.css">
    <link rel="stylesheet" href="./Assets/css/preloader.css">
    <title>KREXIM ASSISTANCE AND SOLUTIONS HUB</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://kit.fontawesome.com/b6a4693a3f.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="preloader">
        <div class="loader-container">
            <div class="loader-text ">K<span class="highlight blink ">R</span>EXIM</div>
            <div class="loader-subtitle">We make it happen</div>
        </div>
</div>
<div class="login">
  <div class="form">
    <h2>Krexim Assistance And Solutions Hub</h2>
    <form method="POST" action="">
      <div class="form-field">
        <label for="login-mail"><i class="fa fa-user"></i></label>
        <input id="login-mail" type="text" name="user-name" placeholder="Username" required>
        <svg>
          <use href="#svg-check" />
        </svg>
      </div>
      <div class="form-field">
        <label for="login-password"><i class="fa fa-lock"></i></label>
        <input id="login-password" type="password" name="user-password" placeholder="Password" required>
        <svg>
          <use href="#svg-check" />
        </svg>
      </div>
      <button type="submit" class="button">
        <div class="arrow-wrapper">
          <span class="arrow"></span>
        </div>
        <p class="button-text">SIGN IN</p>
      </button>
    </form>
  </div>
  <div class="finished">
    <svg>
      <use href="#svg-check" />
    </svg>
  </div>
</div>

<!-- //--- ## SVG SYMBOLS ############# -->
<svg style="display:none;">
  <symbol id="svg-check" viewBox="0 0 130.2 130.2">
    <polyline points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
  </symbol>
</svg>
<script src="./login.js"></script>
<script src="./Assets/js/preloader.js"></script>
</body>
</html>
