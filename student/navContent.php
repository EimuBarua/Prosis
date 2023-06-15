<?php
    include '../connection.php';
    $role=$_SESSION['role'];
    if($_SESSION['role']=='supervisor')
    $s="SELECT * FROM teachers where id=".$_SESSION['id']."";
    if($_SESSION['role']=='student')
    $s="SELECT * FROM students where id=".$_SESSION['id']."";
    $us=mysqli_query($conn,$s);
    $u=mysqli_fetch_assoc($us);
   
?>

<!-- --NAVBAR---- -->
<div class="header-container fixed-top">
    <header class="header  navbar navbar-expand-sm expand-header">
        <!-- --Logo Start-- -->
        <div class="header-left d-flex">
            <div class="logo">
                PROSIS
            </div>
            <a href="#" class="sidebarCollapse" id="toogleSidebar" data-placement="bottom">
                <span class="fas fa-bars"></span>
            </a>
        </div>
        <!-- --Logo End-- -->



        <!-- --User profile Start -->
        <ul class="navbar-item flex-row ml-auto extra-list">
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="" class="nav-link user" id="Notify" data-bs-toggle="dropdown">
                    <img src="../assets/img/profile.svg" alt="" class="icon">
                </a>

                <div class="dropdown-menu">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="../assets/img/profile.svg" alt="" class="img-fluid mr-2">
                            <div class="media-body">
                                <h5><?php echo ucfirst($u['first_name']).' '.ucfirst($u['last_name']);?></h5>
                                <p><?php echo ucfirst($_SESSION['role']);?></p>
                            </div>
                        </div>
                    </div>

                    <div class="dp-main-menu">
                        <a href="profile.php" class="dropdown-item"><span class="fas fa-user"></span>Profile</a>
                        <a href="../logout.php" class="dropdown-item"><span class="fas fa-outdent"></span>Log Out</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- --User profile End -->
    </header>
</div>
<!-- --NAVBAR END---- -->


<!-- ------------------SIDEBAR START----------- -->
<div class="left-menu">
    <div class="menubar-content">
        <nav class="animated bounceInDown">
            <ul id="sidebar">
                        <li>
                            <a href="studentProgressBar.php"> <i class="fas fa-chart-bar"></i>Group Task</a>
                        </li>
                <li>
                    <a href="../logout.php"> <i class="fas fa-edit"></i>Log out</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- ------------------SIDEBAR END----------- -->