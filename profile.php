<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/chart/apexcharts.css">

    <link rel="stylesheet" type="text/css" href="assets/css/data-table/jquery.dataTables.css">

    <link rel="stylesheet" href="assets/css/sass.css">
    <link rel="stylesheet" href="assets/css/layets.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <div class="main-wrapper">
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
                            <img src="assets/img/profile.svg" alt="" class="icon">
                        </a>

                        <div class="dropdown-menu">
                            <div class="user-profile-section">
                                <div class="media mx-auto">
                                    <img src="assets/img/profile.svg" alt="" class="img-fluid mr-2">
                                    <div class="media-body">
                                        <h5>Rajesh Pal</h5>
                                        <p>Super admin</p>
                                    </div>
                                </div>
                            </div>

                            <div class="dp-main-menu">
                                <a href="" class="dropdown-item"><span class="fas fa-user"></span>Profile</a>
                                <a href="" class="dropdown-item"><span class="fas fa-outdent"></span>Log Out</a>
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
                        <li class="active">
                            <a href="index.html"> <i class="fas fa-home"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-box-open"></i>Profile</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fab fa-uikit"></i> Assign Work</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-chart-bar"></i> Project</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fab fa-telegram-plane"></i> Assign Task</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-edit"></i> Thesis</a>
                        </li>

                        <!-- <li class="sub-menu">
                            <a href="#"> <i class="fas fa-cogs"></i> S
                                <div class="fa fa-caret-down right"></div>
                            </a>
                            <ul class="left-menu-dp">
                                <li><a href=""><i class="fas fa-user-circle"></i>Account</a></li>
                                <li><a href=""><i class="fas fa-id-card"></i>Profile</a></li>
                                <li><a href=""><i class="fas fa-fingerprint"></i>Security &amp; Privacy</a></li>
                                <li><a href=""><i class="fas fa-key"></i>Password</a></li>
                                <li><a href=""><i class="fas fa-bell"></i>Notification</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-chart-bar"></i> Charts</a>
                        </li> -->
                        <!-- <li>
                            <a href="#"> <i class="fas fa-table"></i> Tables</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-search"></i> Popups</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-bell"></i> Notification</a>
                        </li> -->
                        <!-- <li>
                            <a href="#"> <i class="fas fa-icons"></i> Icons</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-map-marker-alt"></i> Maps</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-sad-cry"></i> Error Pages</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fab fa-pagelines"></i> General Pages</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fab fa-opencart"></i> E-Commerce</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-envelope"></i> E-mail</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-calendar-alt"></i> Calendar</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-check-circle"></i> Todo List</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fab fa-envira"></i> Gallery</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-book"></i> Documentation</a>
                        </li>

                        <li>
                            <a href="#"> <i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </div>
        <!-- ------------------SIDEBAR END----------- -->

        <div class="content-wrapper">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <div class="w-100 ">
                                        <img src="assets/img/admin-4.jpg"
                                        alt="avatar" class="rounded-circle rounded-corners-gradient-borders  img-fluid mx-auto d-block" style="width:200px;height:200px;">
                                        <!-- <img src="..." class="" alt="..."> -->
                                    </div>
                                    <h5 class="my-3">Rajesh Pal</h5>
                                    <p class="text-muted mb-1">Full Stack Developer</p>
                                    <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <button type="button" class="btn btn-primary">Follow</button>
                                        <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fas fa-globe fa-lg text-warning"></i>
                                            <p class="mb-0">https://mdbootstrap.com</p>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                            <p class="mb-0">mdbootstrap</p>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                            <p class="mb-0">@mdbootstrap</p>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                            <p class="mb-0">mdbootstrap</p>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                            <p class="mb-0">mdbootstrap</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">Johnatan Smith</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">example@example.com</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">(097) 234-5678</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Mobile</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">(098) 765-4321</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span>
                                                Project Status</p>
                                            <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 80%"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 72%"
                                                    aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 89%"
                                                    aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 55%"
                                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                            <div class="progress rounded mb-2" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 66%"
                                                    aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span>
                                                Project Status</p>
                                            <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 80%"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 72%"
                                                    aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 89%"
                                                    aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 55%"
                                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                            <div class="progress rounded mb-2" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 66%"
                                                    aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" charset="utf8" src="assets/js/data-table/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    <script src="assets/js/chart/apexcharts.min.js"></script>
    <script src="assets/js/chart/chart.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>