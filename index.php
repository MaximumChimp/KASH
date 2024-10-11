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
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.5 10.1333C3.33431 10.1333 3.2 9.99902 3.2 9.83333V3.5C3.2 3.33431 3.33431 3.2 3.5 3.2H8.16667C8.33235 3.2 8.46667 3.33431 8.46667 3.5V9.83333C8.46667 9.99902 8.33235 10.1333 8.16667 10.1333H3.5ZM3.5 16.8C3.33431 16.8 3.2 16.6657 3.2 16.5V13.5C3.2 13.3343 3.33431 13.2 3.5 13.2H8.16667C8.33235 13.2 8.46667 13.3343 8.46667 13.5V16.5C8.46667 16.6657 8.33235 16.8 8.16667 16.8H3.5ZM11.8333 16.8C11.6676 16.8 11.5333 16.6657 11.5333 16.5V10.1667C11.5333 10.001 11.6676 9.86667 11.8333 9.86667H16.5C16.6657 9.86667 16.8 10.001 16.8 10.1667V16.5C16.8 16.6657 16.6657 16.8 16.5 16.8H11.8333ZM11.5333 3.5C11.5333 3.33431 11.6676 3.2 11.8333 3.2H16.5C16.6657 3.2 16.8 3.33431 16.8 3.5V6.5C16.8 6.66569 16.6657 6.8 16.5 6.8H11.8333C11.6676 6.8 11.5333 6.66569 11.5333 6.5V3.5Z" stroke="#C2CFE0" stroke-width="1.4" />
                </svg>
                <span class="nav-label">Dashboard</span>
              </div>
            </a>
          </li>
          <li class="nav-item ">
          <a class="tablinks"  data-content="tasks">
              <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.49996 3.2H16.6666C16.7384 3.2 16.8 3.2616 16.8 3.33333V8.33333C16.8 8.40507 16.7384 8.46667 16.6666 8.46667H2.49996C2.42823 8.46667 2.36663 8.40507 2.36663 8.33333V3.33333C2.36663 3.2616 2.42823 3.2 2.49996 3.2ZM2.49996 11.5333H16.6666C16.7384 11.5333 16.8 11.5949 16.8 11.6667V16.6667C16.8 16.7384 16.7384 16.8 16.6666 16.8H2.49996C2.42823 16.8 2.36663 16.7384 2.36663 16.6667V11.6667C2.36663 11.5949 2.42823 11.5333 2.49996 11.5333Z" stroke="#C2CFE0" stroke-width="1.4" />
                </svg>

                <span class="nav-label">Tasks</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
          <a class="tablinks"  data-content="email">
              <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.37496 5.0005V4.99992C2.37496 4.46528 2.80778 4.03325 3.33329 4.03325H16.6666C17.1967 4.03325 17.6333 4.46985 17.6333 4.99992V14.9999C17.6333 15.53 17.1967 15.9666 16.6666 15.9666H3.33329C2.80331 15.9666 2.36677 15.5301 2.36663 15.0002C2.36663 15.0001 2.36663 15 2.36663 14.9999L2.37496 5.0005Z" stroke="#C2CFE0" stroke-width="1.4" />
                  <path d="M2.5 5L10 10L17.5 5" stroke="#C2CFE0" stroke-width="1.4" />
                </svg>

                <span class="nav-label">Email</span>
              </div>
            </a>
          </li>
          <li class="nav-item ">
          <a class="tablinks"  data-content="knowledgebased">
              <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6.81118 6.11106C6.81118 4.34905 8.23806 2.92217 10.0001 2.92217C11.7621 2.92217 13.189 4.34904 13.189 6.11106C13.189 7.87307 11.7621 9.29995 10.0001 9.29995C8.23806 9.29995 6.81118 7.87307 6.81118 6.11106ZM2.92229 14.8611C2.92229 14.4716 3.11181 14.0787 3.54729 13.6768C3.98752 13.2705 4.63079 12.904 5.39805 12.5966C6.9337 11.9814 8.78966 11.6722 10.0001 11.6722C11.2105 11.6722 13.0664 11.9814 14.6021 12.5966C15.3693 12.904 16.0126 13.2705 16.4528 13.6768C16.8883 14.0787 17.0778 14.4716 17.0778 14.8611V17.0777H2.92229V14.8611Z" stroke="#C2CFE0" stroke-width="1.4" />
                </svg>
                <span class="nav-label ">Knowledge Based</span>
              </div>
            </a>
          </li>
          <li class="nav-item ">
          <a class="tablinks"  data-content="chat">
              <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0)">
                    <path d="M4.99996 14.3001H4.71001L4.50499 14.5051L2.36663 16.6435V3.33342C2.36663 2.80335 2.80323 2.36675 3.33329 2.36675H16.6666C17.1967 2.36675 17.6333 2.80335 17.6333 3.33342V13.3334C17.6333 13.8635 17.1967 14.3001 16.6666 14.3001H4.99996Z" stroke="#C2CFE0" stroke-width="1.4" />
                  </g>
                  <defs>
                    <clipPath id="clip0">
                      <rect width="20" height="20" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
                <span class="nav-label">Chat</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="tablinks"  data-content="ticket">
              <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.49996 4.03325H17.5C17.5717 4.03325 17.6333 4.09485 17.6333 4.16659V15.8333C17.6333 15.905 17.5717 15.9666 17.5 15.9666H2.49996C2.42823 15.9666 2.36663 15.905 2.36663 15.8333V4.16659C2.36663 4.09485 2.42823 4.03325 2.49996 4.03325Z" stroke="#C2CFE0" stroke-width="1.4" />
                  <rect x="6.5" y="3.33325" width="1.16667" height="13.3333" fill="#C2CFE0" />
                  <rect x="12.3334" y="3.33325" width="1.16667" height="13.3333" fill="#C2CFE0" />
                </svg>

                <span class="nav-label">Tickets</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="tablinks"  data-content="integration">
              <div class="menu-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.49996 4.03325H17.5C17.5717 4.03325 17.6333 4.09485 17.6333 4.16659V15.8333C17.6333 15.905 17.5717 15.9666 17.5 15.9666H2.49996C2.42823 15.9666 2.36663 15.905 2.36663 15.8333V4.16659C2.36663 4.09485 2.42823 4.03325 2.49996 4.03325Z" stroke="#C2CFE0" stroke-width="1.4" />
                  <rect x="6.5" y="3.33325" width="1.16667" height="13.3333" fill="#C2CFE0" />
                  <rect x="12.3334" y="3.33325" width="1.16667" height="13.3333" fill="#C2CFE0" />
                </svg>

                <span class="nav-label">Apps and Integration</span>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a class="tablinks"  data-content="settings">
              <div class="menu-icon">
                <svg width="14" height="4" viewBox="0 0 14 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.00004 0.333252C1.08337 0.333252 0.333374 1.08325 0.333374 1.99992C0.333374 2.91658 1.08337 3.66658 2.00004 3.66658C2.91671 3.66658 3.66671 2.91658 3.66671 1.99992C3.66671 1.08325 2.91671 0.333252 2.00004 0.333252ZM12 0.333252C11.0834 0.333252 10.3334 1.08325 10.3334 1.99992C10.3334 2.91658 11.0834 3.66658 12 3.66658C12.9167 3.66658 13.6667 2.91658 13.6667 1.99992C13.6667 1.08325 12.9167 0.333252 12 0.333252ZM7.00004 0.333252C6.08337 0.333252 5.33337 1.08325 5.33337 1.99992C5.33337 2.91658 6.08337 3.66658 7.00004 3.66658C7.91671 3.66658 8.66671 2.91658 8.66671 1.99992C8.66671 1.08325 7.91671 0.333252 7.00004 0.333252Z" fill="#C2CFE0" />
                </svg>
                <div class="dropdown">
                    <a  role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#6c757d">
                        <span class="nav-label">Settings</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li class="drop"><a class="dropdown-item" href="#"><i class="fa-regular fa-pen-to-square task-icon"></i> Edit</a></li>
                        <li class="drop"><a class="dropdown-item delete-btn" href="#" onclick="deleteTask('${taskId}')"><i class="fa-solid fa-trash task-icon"></i> Delete</a></li>
                        <li class="drop"><a class="dropdown-item" href="#"><i class="fa-solid fa-user-plus task-icon"></i> Add People</a></li>
                        <li class="drop"><a class="dropdown-item" href="./logout.php"><i class="fa-solid fa-arrow-right-from-bracket task-icon"></i> Leave</a></li>
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
    
</body>
</html>
