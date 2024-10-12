<?php
  session_start();
  if(!isset($_SESSION['userID'])){
      header("Location: ./login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KREXIM ASSISTANCE AND SOLUTIONS HUB</title>
    <link rel="stylesheet" href="./Assets/css/index.css">
    <link rel="stylesheet" href="./Assets/css/task.css">
    <link rel="stylesheet" href="./Assets/css/tickets.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://kit.fontawesome.com/b6a4693a3f.js" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
   <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="https://kit.fontawesome.com/b6a4693a3f.js" crossorigin="anonymous"></script>

</head>
<body>

<!-- wrapper -->
<div class="wrapper">
  <!-- search starts -->
  <div class="search">
    <form class="search-form d-flex">
      <label>
        <button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
        <input type="search" id="site-search" class="search-input" placeholder="Search something..." autocomplete="on" />
      </label>

      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19.5 18.2071V18.5H4.5V18.2071L6.35355 16.3536L6.5 16.2071V16V11C6.5 8.09437 8.02219 5.78092 10.6153 5.16653L11 5.07538V4.68V4C11 3.44614 11.4461 3 12 3C12.5539 3 13 3.44614 13 4V4.68V5.07506L13.3843 5.16644C15.9681 5.78076 17.5 8.10482 17.5 11V16V16.2071L17.6464 16.3536L19.5 18.2071ZM13.4135 20.5C13.2061 21.0806 12.6488 21.5 12 21.5C11.3443 21.5 10.7907 21.0813 10.5854 20.5H13.4135Z" fill="white" stroke="#C2CFE0" />
        <circle cx="17" cy="6" r="4.5" fill="#F7685B" stroke="white" />
      </svg>
      
     
    </form>
  </div>
  <!-- search ends -->

  <!-- sidebar starts -->
  <aside class="sidebar">
    <!-- saas header -->
    <div class="header">
      <a href="#"><img src="./Assets/image/Logo.png" alt="" class="img-logo"></a>
    </div>
    <!-- sidebar inner -->
    <div class="sidebar_inner">
      <!-- person block-->
      <div class="person">
        <img src="./Assets/image/Arvin.jpg" alt="profile_picture" class="profileImg" />
        <div class="description">
          <span class="descriptionName"><?=$_SESSION["FIRSTNAME"]." ".$_SESSION["LASTNAME"]?></span>
          <span class="descriptionMail">@<?=strtolower($_SESSION["userName"])?></span>
        </div>
      </div>

      <!-- navbar-->
      <nav class="navbar">
        <ul>
          <li class="nav-item ">
            <a class="tablinks active " data-content="dashboard">
              <div class="menu-icon">
                 <i class="fa-solid fa-gauge"></i>
                <span class="nav-label">Dashboard</span>
              </div>
            </a>
          </li>
          <li class="nav-item ">
          <a class="tablinks"  data-content="tasks">
              <div class="menu-icon">
                <i class="fa-solid fa-list-check"></i>
                <span class="nav-label">Tasks</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
          <a class="tablinks"  data-content="email">
              <div class="menu-icon">
                <i class="fa-solid fa-envelope"></i>
                <span class="nav-label">Email</span>
              </div>
            </a>
          </li>
          <li class="nav-item ">
          <a class="tablinks"  data-content="knowledgebased">
              <div class="menu-icon">
                <i class="fa-solid fa-book"></i>
                <span class="nav-label ">Knowledge Based</span>
              </div>
            </a>
          </li>
          <li class="nav-item ">
          <a class="tablinks"  data-content="chat">
              <div class="menu-icon">
                <i class="fa-solid fa-message"></i>
                <span class="nav-label">Chat</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="tablinks"  data-content="ticket">
              <div class="menu-icon">
                <i class="fa-solid fa-ticket"></i>
                <span class="nav-label">Tickets</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="tablinks"  data-content="integration">
              <div class="menu-icon">
                <i class="fa-solid fa-mobile"></i>
                <span class="nav-label">Apps and Integration</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="tablinks"  data-content="settings">
              <div class="menu-icon">
                <i class="fa-solid fa-gear"></i>
                <div class="dropdown">
                    <a  role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#6c757d">
                        <span class="nav-label">Settings</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li class="drop"><a class="dropdown-item" href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket task-icon"></i> Logout</a></li>
                    </ul>
                </div>
              </div>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- navbar ends -->
      <div class="toggle">
        <a href="">
          <div class="menu-icon">
            <!-- <img src="./img/toggle_sidebar.svg" alt="" /> -->
             
          </div>
          toggle
        </a>
      </div>
      <!-- toggle ends-->
    </div>
    <!-- inner ends -->
  </aside>
  <!-- sidebar ends -->
 
  <?php  
      require('./view/dashboard.php');
      require('./view/tasks.php');
      require('./view/chat.php');
      require('./view/email.php');
      require('./view/ticket.php');
      require('./view/knowledgebased.php');
      require('./view/integration.php')
    ?>
</div>

<!-- wrapper -->

    <script src="./Assets/js/index.js"></script>
    <script src="./Assets/js/task.js"></script>
    <script src="./Assets/js/ticket.js"></script>
    <script src="./Assets/js/integration.js"></script>
</body>
</html>
