<?php 
session_start();
include '../connection.php'; 
?>
<?php 

    if(isset($_SESSION['id']))
    {
        if($_SESSION['role']=='supervisor')
{   
        $str="SELECT * FROM groups where supervisor_id=".$_SESSION['id']."";
   /// echo $str;
    $q=mysqli_query($conn,$str);
}
else
{
    $_SESSION['error']=1;
    header('location:'.$_SESSION['url']);
    exit();
    }
}
    else
    header('Location:auth-supervisor.php');
    $_SESSION['url']=$_SERVER['REQUEST_URI'];
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/chart/apexcharts.css">

    <link rel="stylesheet" type="text/css" href="../assets/css/data-table/jquery.dataTables.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/sass.css">
    <link rel="stylesheet" href="../assets/css/layets.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <style>
        .center{
            width:100% !important;
            height:100% !important;
            /* background:green; */
            position:absolute;
            top:-10px;
            transform: translate(22%);
            display:flex;
            align-items:center;
            /* justify-content:center; */
        }
    </style>
</head>

<body>
    <div class="main-wrapper">

        <!-- navigation content -->
        <?php include 'navContent.php'; ?>
        <!--x--- navigation content --x--->



        <!-- main content -->
        <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-12 ">

                            <input class="form-control" id="myInput" type="text" placeholder="Search..">

                            <table class="table table-bordered table-hover bg-white text-center text-dark">
                                <thead>
                                    <tr>
                                        <th>Group name</th>
                                        <th colspan="2"> Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                <?php
                                    if(mysqli_num_rows($q) > 0){
                                            
                                            while($group=mysqli_fetch_assoc($q)){?>
                                                

                                                <tr>
                                                    <td><?php echo $group["name"]?></td>

                                                    <td><a title="view tasks" href="progressbar.php?grpId=<?php echo $group["id"] ?>"><i class="fa fa-eye"></i></a></td>

                                                    <td><a title="assign task" href="assignTasks.php?grpId=<?php echo $group["id"] ?>"><i class="fa fa-tasks" aria-hidden="true"></i></a></td>
                                                </tr>

                                    <?php 
                                        }
                                    } 
                                    else{ ?>
                                        <h1 class="center">No groups available yet.</h1>
                                   <?php } ?>
                                    




                                    <!-- <tr>
                                        <td>John</td>
                                        <td><a title="view tasks" href="#"><i class="fa fa-eye"></i></a></td>
                                        <td><a title="assign task" href="#"><i class="fa fa-tasks"
                                        aria-hidden="true"></i></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Rajesh</td>
                                        <td><a title="view tasks" href="#"><i class="fa fa-eye"></i></a></td>
                                        <td><a title="assign task" href="#"><i class="fa fa-tasks"
                                        aria-hidden="true"></i></i></a></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        
                        </div>

                    </div>
                </div>
        </div>

    </div>
    <!---x-- main content ---x-->

    </div>



    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" charset="utf8" src="../assets/js/data-table/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    <script src="../assets/js/chart/apexcharts.min.js"></script>
    <script src="../assets/js/chart/chart.js"></script>
    <script src="../assets/js/main.js"></script>

    <!-- Custom script -->
    <script>
        $(document).ready(function(){
            <?php
            
            if($_SESSION['error']==1) {?>
        
            let timerInterval
Swal.fire({
 title: "Unauthorized Access",
  text: "Sorry You Don't have Permission to Access This Page",
  icon: "error",
  timer: 4000,
  timerProgressBar: true,
  confirmButtonText: 'Cancel'
})
           <?php $_SESSION['error']=0;
           }
            ?>
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
    <!--x-- Custom script --x-->
</body>

</html>