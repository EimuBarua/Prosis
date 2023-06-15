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
<?php
$batch=[];
$str="SELECT * FROM groups where supervisor_id=".$_SESSION['id']."";
$qq=mysqli_query($conn,$str);
while($row=mysqli_fetch_assoc($qq))
{
   
    $ss="SELECT DISTINCT(batch) FROM group_members,students where group_members.student_id=students.id and group_members.group_id=".$row['id']."";
    $qqr=mysqli_query($conn,$ss);
    
    if(mysqli_num_rows($qqr)>1)
    array_push($batch,0);
    else if(mysqli_num_rows($qqr)==1)
    {
        while($result=mysqli_fetch_assoc($qqr))
        array_push($batch,$result['batch']);
    }

}
$batch = array_unique($batch); 
sort($batch);
// for($i=0;$i<sizeof($batch);$i++)
// echo $batch[$i].'<br>';

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
                <div class="continainer">

                        <div class="row justify-content-between">
                                <a style='color:black' href="batchgroup.php?batch=0">
                                    <div class="col-3 shadow p-3 mb-5 border border-success rounded" style="width: 18rem;">
                                        <div class="card-title text-center ">
                                        <p>
                                            <?php echo 'Sample Batch';?>
                                        </p>
                                        </div>    
                                    </div>
                                    
                                </a>
                                <a style='color:black' href="batchgroup.php?batch=0">
                                    <div class="col-3 shadow p-3 mb-5 border border-success rounded" style="width: 18rem;">
                                        <div class="card-title text-center ">
                                        <p>
                                            <?php echo 'Sample Batch';?>
                                        </p>
                                        </div>    
                                    </div>
                                    
                                </a>
                                <a style='color:black' href="batchgroup.php?batch=0">
                                    <div class="col-3 shadow p-3 mb-5 border border-success rounded" style="width: 18rem;">
                                        <div class="card-title text-center ">
                                        <p>
                                            <?php echo 'Sample Batch';?>
                                        </p>
                                        </div>    
                                    </div>
                                    
                                </a>
                    <?php 
                    for($i=0;$i<sizeof($batch);$i++)
                    {?>
                   
                                <?php
                                if($batch[$i]==0)
                                {
                                ?>
                                <a style='color:black' href="batchgroup.php?batch=0">
                                <div class="col-3 shadow p-3 mb-5 border border-success rounded" style="width: 18rem;">
                                    <div class="card-title text-center ">
                                    <p>
                                        <?php echo 'Mixed Batch';?>
                                    </p>
                                    </div>    
                                </div>
                                    
                                </a>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <a style='color:black' href="batchgroup.php?batch=<?php echo $batch[$i]; ?>">
                                    
                                    
                                    <div class="col-4 shadow p-3 mb-5 border border-success rounded"  style="width: 18rem;">
                              <div class="card-title">
                            <p>
                                    
                                    <?php echo 'Batch '.$batch[$i]; ?>
                                    </p>
                                </div>    </div>
                                    
                                
                                </a>
                                    <?php

                                }
                               
                                ?>
                          
                



                   <?php }
                    ?>
                       

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