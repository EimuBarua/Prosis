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
    
    ?>
 <?php
                           
     $valid=0;
    if(mysqli_num_rows($q) > 0){

        while($group=mysqli_fetch_assoc($q)){
       $ss="SELECT DISTINCT(batch) FROM group_members,students WHERE students.id=group_members.student_id and group_id=".$group['id']."";
       
         $qq=mysqli_query($conn,$ss);
        $nrows=mysqli_num_rows($qq);
                                     
                            if($_REQUEST['batch']==0&&$nrows==1)
                            continue;
                            if($_REQUEST['batch']>0&&$nrows>1)
                            continue;
                            if($_REQUEST['batch']==0)
                            $ss="SELECT id,first_name,last_name FROM group_members,students WHERE students.id=group_members.student_id and group_id=".$group['id']."";
                            else
                            $ss="SELECT id,first_name,last_name FROM group_members,students WHERE students.id=group_members.student_id and group_id=".$group['id']." and batch=".$_REQUEST['batch']."";
                            $qq=mysqli_query($conn,$ss);
                            $nrows=mysqli_num_rows($qq);
                            if($nrows==0)
                            continue;
                            $valid=1;
                            
                             }
                            }
                            if($valid==0)
                            {
                             $_SESSION['error']=1;
                              header('location:'.$_SESSION['url']);
                               exit();
                            }
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

                            <!-- <input class="form-control" id="myInput" type="text" placeholder="Search.."> -->

                            <table class="table table-bordered table-hover bg-white text-center text-dark">
                                <thead>
                                    <tr>
                                        <th>Group name</th>
                                        <th >Members Name</th>
                                        <th>Members ID</th>
                                        <th colspan="2"> Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                <?php
                                 $str="SELECT * FROM groups where supervisor_id=".$_SESSION['id']."";
                                 /// echo $str;
                                  $q=mysqli_query($conn,$str);
                                    if(mysqli_num_rows($q) > 0){

                                            
                                            while($group=mysqli_fetch_assoc($q)){
                                                $ss="SELECT DISTINCT(batch) FROM group_members,students WHERE students.id=group_members.student_id and group_id=".$group['id']."";
                                              
                                                $qq=mysqli_query($conn,$ss);
                                                $nrows=mysqli_num_rows($qq);
                                              
                                                if($_REQUEST['batch']==0&&$nrows==1)
                                                continue;
                                                 if($_REQUEST['batch']>0&&$nrows>1)
                                                continue;
                                               
                                                
                                                if($_REQUEST['batch']==0)
                                                $ss="SELECT id,first_name,last_name FROM group_members,students WHERE students.id=group_members.student_id and group_id=".$group['id']."";
                                                else
                                                $ss="SELECT id,first_name,last_name FROM group_members,students WHERE students.id=group_members.student_id and group_id=".$group['id']." and batch=".$_REQUEST['batch']."";
                                                $qq=mysqli_query($conn,$ss);
                                                $nrows=mysqli_num_rows($qq);
                                                if($nrows==0)
                                                continue;
                                                $valid=1;
                                                $name=[];
                                                $ids=[];
                                                ?>
                                                

                                                <tr>
                                                    <td  rowspan="<?php echo $nrows?>"><?php echo $group["name"]?></td>
                                                    <td>
                                                       <?php 
                                                        while($rows=mysqli_fetch_assoc($qq))
                                                        {
                                                            $s=$rows['first_name'].' '.$rows['last_name'];
                                                            if(sizeof($name)==0)
                                                            echo $s;
                                                            
                                                            array_push($name,$s);
                                                        }
                                                            
                                                        ?>
                                                    </td>
                                                    <td>
                                                       <?php 
                                                        $qq=mysqli_query($conn,$ss);
                                                        while($rrr=mysqli_fetch_assoc($qq))
                                                        {
                                                           
                                                            $s=$rrr['id'];
                                                            if(sizeof($ids)==0)
                                                            echo $s;
                                                           
                                                            array_push($ids,$s);
                                                        }
                                                        ?>
                                                    </td>
                                                   
                                                    <td  rowspan="<?php echo $nrows?>"><a title="view tasks" href="progressbar.php?grpId=<?php echo $group["id"] ?>"><i class="fa fa-eye"></i></a></td>

                                                    <td rowspan="<?php echo $nrows?>"><a title="assign task" href="assignTasks.php?grpId=<?php echo $group["id"] ?>"><i class="fa fa-tasks" aria-hidden="true"></i></a></td>
                                                </tr>

                                               
                                                <?php
                                                for($i=1;$i<sizeof($name);$i++)
                                                {
                                                    ?>
                                                    <tr id='pp'>
                                                    <td>
                                                            <?php echo $name[$i];?>
                                                    </td>
                                                    <td>
                                                    <?php echo $ids[$i];?>
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>

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
         
        });
    </script>
    <!--x-- Custom script --x-->
</body>

</html>