<?php 
session_start();
include '../connection.php'; 
?>
<?php 
    if(isset($_SESSION['id']))
    {
        if($_SESSION['role']!='supervisor')
        {
            $_SESSION['error']=1;
            header('location:'.$_SESSION['url']);
        }
        else
        {
            $sss="SELECT * FROM groups where supervisor_id=".$_SESSION['id']." and id=".$_REQUEST['grpId']."";
            $qq=mysqli_query($conn,$sss);
           /// echo mysqli_num_rows($qq);
           if(mysqli_num_rows($qq)==0)
           {
               $_SESSION['error']=1;
               header('location:'.$_SESSION['url']);
               exit();
            }
        }
    }
    else
    header('Location:auth-supervisor.php');
 

    $_SESSION['url']=$_SERVER['REQUEST_URI'];
    
?>

<?php
    $grpId = $_REQUEST['grpId'];
    // echo $id;
    // $str="SELECT * FROM task GROUP BY date HAVING group_id=".$grpId.";";
    $str ="SELECT id,group_id,date,task_details,status FROM (SELECT * FROM task WHERE group_id=".$grpId.") AS T GROUP BY T.date;";
    $taskInfo=mysqli_query($conn,$str);

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/data-table/jquery.dataTables.css">

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
            <div class="container-fluid px-1">
                <div class="row col-lg-6 col-md-12">
                    <ul class=" px-4 list-group list-group-flush">
                        <?php
                            if(mysqli_num_rows($taskInfo) > 0){?>
                                <h1 class="fs-3 bg-white px-2 text-success py-2">Visited dates</h1>
                                <?php
                                    $count=1;
                                    while($task=mysqli_fetch_assoc($taskInfo)){
                                        
                                        // echo $task['date'].'<br>';
                                        // print_r($task);


                                        $str2="SELECT sum(status) AS status FROM task WHERE date='".$task["date"]."' AND group_id=".$grpId.";";
                                        $taskInfo2=mysqli_query($conn,$str2);
                                        
                                        $task2=mysqli_fetch_assoc($taskInfo2);

                                        $str3="SELECT count(*) AS c FROM task WHERE date='".$task["date"]."' AND group_id=".$grpId.";";
                                        $taskInfo3=mysqli_query($conn,$str3);
                                       
                                        $task3=mysqli_fetch_assoc($taskInfo3);
                                        


                                        // echo($task2['status']).'  '.$task3['c'].'<br>';
                                    
                                        if($task2['status']==$task3['c']){
                                        ?>
                                        
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input fs-6 cust_check" type="checkbox" value="" id="flexCheckDefault<?php echo $count++;?>" checked >
                                                <a href="#" class="text-dark" id="list<?php echo $count++;?>">
                                                    <label class="form-check-label text-decoration-underline fs-6"
                                                    for="flexCheckDefault<?php echo $count++;?>">
                                                    <?php echo '<span class="date">'.$task["date"].' </span><span class="text-success">( ' .$task2['status'].' out of ' .$task3['c'].' completed )</span>';?>
                                                    </label>
                                                </a>
                                            </div>
                                        </li>
                                        <?php } else{ ?>
                                        <li class="list-group-item">
                                            <div class="form-check ">
                                                <input class="form-check-input fs-6 cust_uncheck" type="checkbox" value="" id="flexCheckDefault<?php echo $count++;?>" >
                                                <a href="#" class="text-dark" id="list<?php echo $count++;?>">
                                                    <label class="form-check-label text-decoration-underline fs-6"
                                                    for="flexCheckDefault<?php echo $count++;?>">
                                                        <?php echo '<span class="date">'.$task["date"].' </span><span class="text-success">( ' .$task2['status'].' out of ' .$task3['c'].' completed )</span>';?>
                                                    </label>
                                                </a>
                                            </div>
                                        </li>
                                    <?php  }
                        
                                }
                            }
                            else{ ?>
                                <h1 class="center">No task assigned yet.</h1>
                           <?php } 
                        ?> 
                        <!-- <li class="list-group-item">
                            <div class="form-check ">
                                <input class="form-check-input fs-5" type="checkbox" value="" id="flexCheckDefault"
                                    disabled>
                                <a href="#" class="text-dark">
                                    <label class="form-check-label text-decoration-underline fs-5"
                                        for="flexCheckDefault">
                                        12-04-2022
                                    </label>
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check ">
                                <input class="form-check-input fs-5" type="checkbox" value="" id="flexCheckDefault"
                                    disabled>
                                <a href="#" class="text-dark">
                                    <label class="form-check-label text-decoration-underline fs-5"
                                        for="flexCheckDefault">
                                        12-04-2022
                                    </label>
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check ">
                                <input class="form-check-input fs-5" type="checkbox" value="" id="flexCheckDefault"
                                    disabled>
                                <a href="#" class="text-dark">
                                    <label class="form-check-label text-decoration-underline fs-5"
                                        for="flexCheckDefault">
                                        12-04-2022
                                    </label>
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check ">
                                <input class="form-check-input fs-5" type="checkbox" value="" id="flexCheckDefault"
                                    disabled>
                                <a href="#" class="text-dark">
                                    <label class="form-check-label text-decoration-underline fs-5"
                                        for="flexCheckDefault">
                                        12-04-2022
                                    </label>
                                </a>
                            </div>
                        </li> -->
                    </ul>
                    
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" >
                                <ul id="modal-body" class="col-12 px-4 list-group list-group-flush">
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                        </div>
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
    <!-- <script src="assets/js/chart/chart.js"></script> -->
    <script src="../assets/js/main.js"></script>

    <!-- Custom script -->
    <script>
        $(document).ready(function () {
            <?php
            
            if($_SESSION['error']==1) {?>
            
            //  $("#errormodal").modal('show');
            //  setTimeout(function(){
            //     $("#errormodal").modal('hide');
            // }, 4000);
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


            // console.log($grpId);
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $(".text-dark").click(function(){
                $ptext = $(this).children().children(".date").text();

                // alert(ptext);
                console.log($ptext);
                $.ajax({
                    url: "grpTask.php",
                    type: "GET",
                    data: {
                        date: $ptext,
                        gId: <?php echo $grpId ?>
                    },
                    success: function (res) {
                        $("#modal-body").empty();
                        $str='';
                        // console.log(res);
                        for($i=0;$i<res.length;$i++){
                            // console.log(res[$i].task_details);
                            // console.log(res[$i].status);
                            if(res[$i].status==0){
                                $str+=`<div class="form-check ">
                                        <input class="form-check-input fs-6 cust_uncheck" type="checkbox" value="" id="flexCheckDefault${$i}" >
                                        <a class="text-dark" title="Click here to toggle task description" data-bs-toggle="collapse" href="#collapseExample${$i}" role="button" aria-expanded="false" aria-controls="collapseExample${$i}">
                                            <label class="form-check-label fs-6 text-decoration-underline " for="flexCheckDefault${$i}">
                                                ${res[$i].task_details}  
                                            </label>
                                        </a>
                                        <div class="collapse border border-success rounded" id="collapseExample${$i}">
                                            <div class="card card-body">
                                                ${res[$i].task_description}
                                            </div>
                                        </div>
                                </div>`;
                            }
                            else{
                                $str+= `<div class="form-check ">
                                            <input class="form-check-input fs-6 cust_check" type="checkbox" value="" id="flexCheckDefault${$i}"checked>
                                            <a class="text-dark" title="Click here to toggle task description" data-bs-toggle="collapse" href="#collapseExample${$i}" role="button" aria-expanded="false" aria-controls="collapseExample${$i}">
                                                <label class="form-check-label fs-6 text-decoration-underline " for="flexCheckDefault${$i}">
                                                    ${res[$i].task_details} <span class="text-success">(done by ${res[$i].student_name})</span>
                                                </label>
                                            </a>
                                            <div class="collapse border border-success rounded" id="collapseExample${$i}">
                                                <div class="card card-body">
                                                ${res[$i].task_description}
                                                </div>
                                            </div>
                                        </div>`;
                            }
                            
                        }
                        // $("#flexCheckDefault").attr('checked',true);
                        // $('#flexCheckDefault').prop('disabled', true);
                        // console.log("ok");
                        $("#exampleModal").modal("show");
                        
                        $(".modal-title").text($ptext);
                        // $mod = $("#modal-body");
                        $("#modal-body").append($str);
                        
                        
                    },
                });
                
            });
        });
    </script>
    <!--x-- Custom script --x-->
</body>

</html>