<?php 
session_start();
include '../connection.php'; 
?>
<?php 
    if(isset($_SESSION['id'])){
        if($_SESSION['role']!='student')
        {$_SESSION['error']=1;
        header('location:'.$_SESSION['url']);}

    }
    else
    header('Location:auth-student.php');
    $_SESSION['url']=$_SERVER['REQUEST_URI'];
?>
<?php

    $student_id=$_SESSION["id"];
    $str2="SELECT * FROM group_members WHERE student_id=$student_id";
    $studentInfo=mysqli_query($conn,$str2);
    $student=mysqli_fetch_assoc($studentInfo);

    $grpId = $student['group_id'];

    // $str="SELECT * FROM task GROUP BY date HAVING group_id=".$grpId.";";
    $str ="SELECT id,group_id,date,task_details,status FROM (SELECT * FROM task WHERE group_id=".$grpId.") AS T GROUP BY T.date;";
    $taskInfo=mysqli_query($conn,$str);


    function getMentions($content)
    {
        // global $DB;
        $mention_regex = '/@\[([0-9]+)\]/i'; //mention regrex to get all @texts

        if (preg_match_all($mention_regex, $content, $matches))
        {
            foreach ($matches[1] as $match)
            {
                include 'connection.php';
                // $match_user =$DB->row("SELECT * FROM users WHERE user_id=?",array($match));
                $str="SELECT * FROM students WHERE id=$match;";
             
                echo $str;
                $user=mysqli_query($conn,$str);
                $match_user=mysqli_fetch_assoc($user);
                $match_search = '@[' . $match . ']';
                $match_replace = '<a target="_blank" href="' . $match_user['user_profile_url'] . '">@' . $match_user['first_name'].' '.$match_user['last_name']. '</a>';

                if (isset($match_user['id']))
                {
                    $content = str_replace($match_search, $match_replace, $content);
                }
            }
        }
        return $content;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosis</title>
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->

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
    <!-- Bootstrap CSS file -->
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->



    <link rel="stylesheet" type="text/css" href="../css/jquery.mentionsInput.css" />
    <style type="text/css">
        #status-overlay {
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.50);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99999;
            overflow: hidden;
        }

        #highlight-textarea {
            background: #fff;
        }

        .form-control:focus {
            box-shadow: 0 0 0 2px #4BB543;
            outline: 0;
        }

        h2 {
            font-size: 20px;
        }
        .divimg{
            overflow:hidden;
            width:40px;
            height:40px;
            object-fit: contain;
        }
        .roundimg {
            width: 100%;
            height: 100%;
            border-radius: 50%;
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
                                <input class="form-check-input fs-6 cust_check" type="checkbox" value=""
                                    id="flexCheckDefault<?php echo $count++;?>" checked>
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
                                <input class="form-check-input fs-6 cust_uncheck" type="checkbox" value=""
                                    id="flexCheckDefault<?php echo $count++;?>">
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
                    // echo $_SESSION['error'];
                        } 
                        ?>
                    </ul>

                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button id="myElement2" type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="taskList">
                                <ul id="modal-body" class="col-12 px-4 list-group list-group-flush">
                                </ul>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <form id="highlight-textarea" method="POST" class="form">
                                            <div class="form-group">
                                                <textarea onclick="highlight();" name="postText"
                                                    class="form-control postText mention" cols="10" rows="2"
                                                    placeholder="What&#039;s going on?" dir="auto"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-end mt-2">
                                                <input type="button" value="Post" id="cmnt-btn"
                                                    class="btn btn-success px-3 pull-right postMention">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12" id="comments">
                                        
                                        
                                    </div>
                            </div>


                            <!-- <div class="modal-footer">
                                
                                <button id="myElement" type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            </div> -->
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
            
            if ($_SESSION['error'] == 1) { ?>

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
                    <?php $_SESSION['error'] = 0;
            } ?>
                // console.log($grpId);
                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

            $(".text-dark").click(function () {
                $ptext = $(this).children().children(".date").text();

                // alert(ptext);
                // console.log($ptext);
                // $.ajax({
                //     url: "grpTask.php",
                //     type: "GET",
                //     data: {
                //         date: $ptext,
                //         gId: </?php echo $grpId?>
                //     },
                //     success: function (res) {
                //         $("#modal-body").empty();
                //         $str = '';
                //         // console.log(res);
                //         for ($i = 0; $i < res.length; $i++) {
                //             // console.log(res[$i].task_details);
                //             // console.log(res[$i].status);
                //             if (res[$i].status == 0) {
                //                 $str += `<div class="form-check ">
                //                         <input data-value="${res[$i].id}" class="form-check-input fs-6 cust_uncheck_student" type="checkbox" value="" id="flexCheckDefault${$i}" >
                //                         <a class="text-dark" title="Click here to toggle task description" data-bs-toggle="collapse" href="#collapseExample${$i}" role="button" aria-expanded="false" aria-controls="collapseExample${$i}">
                //                             <label class="form-check-label fs-6 text-decoration-underline " for="flexCheckDefault${$i}">
                //                                 ${res[$i].task_details}  
                //                             </label>
                //                         </a>
                //                         <div class="collapse border border-success rounded" id="collapseExample${$i}">
                //                             <div class="card card-body">
                //                                 ${res[$i].task_description}
                //                             </div>
                //                         </div>
                //                 </div>`;
                //             }
                //             else {
                //                 $str += `<div class="form-check ">
                //                             <input data-value="${res[$i].id}" class="form-check-input fs-6 cust_check_student" type="checkbox" value="" id="flexCheckDefault${$i}"checked>
                //                             <a class="text-dark" title="Click here to toggle task description" data-bs-toggle="collapse" href="#collapseExample${$i}" role="button" aria-expanded="false" aria-controls="collapseExample${$i}">
                //                                 <label class="form-check-label fs-6 text-decoration-underline " for="flexCheckDefault${$i}">
                //                                     ${res[$i].task_details} <span class="text-success">(done by ${res[$i].student_name})</span>
                //                                 </label>
                //                             </a>
                //                             <div class="collapse border border-success rounded" id="collapseExample${$i}">
                //                                 <div class="card card-body">
                //                                 ${res[$i].task_description}
                //                                 </div>
                //                             </div>
                //                         </div>`;
                //             }
                //             $.ajax({
                //                     url: "get_comments.php",
                //                     type: "GET",
                //                     data: {
                //                         date: $ptext,
                //                         gId: </?php echo $grpId?>
                //                     },
                //                     success: function (res2) {
                //                         // $("#modal-body").empty();
                //                         $str2 = '';
                //                         console.log(res2);
                //                         for ($i = 0; $i < res2.length; $i++) {
                //                             // console.log(res[$i].name);
                //                             // console.log(res[$i].date);
                //                             $str2+=`<div class="d-flex flex-start">
                //                                             <img class="rounded-circle shadow-1-strong me-3"
                //                                                 src="${res2[$i].user_profile_url}" alt="avatar" width="65"
                //                                                 height="65" />
                //                                             <div class="flex-grow-1 flex-shrink-1">
                //                                                 <div>
                //                                                     <div class="d-flex justify-content-between align-items-center">
                //                                                         <p class="mb-1">
                //                                                         ${res2[$i].name} <span class="small">- ${res2[$i].date}</span>
                //                                                         </p>
                //                                                         <!-- <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a> -->
                //                                                     </div>
                //                                                     <p class="small mb-0">
                //                                                         ${res2[$i].post_text}
                //                                                     </p>
                //                                                 </div>
                //                                             </div>
                //                                         </div>`;
                                            

                //                         }
                //                         // $("#flexCheckDefault").attr('checked',true);
                //                         // $('#flexCheckDefault').prop('disabled', true);
                //                         // console.log("ok");
                //                         // $("#exampleModal").modal("show");

                //                         // $(".modal-title").text($ptext);
                //                         // // $mod = $("#modal-body");
                //                         // $("#comments").append($str);
                //                         console.log($str2);


                //                     },
                //                 });

                //         }
                //         // $("#flexCheckDefault").attr('checked',true);
                //         // $('#flexCheckDefault').prop('disabled', true);
                //         // console.log("ok");
                //         $("#exampleModal").modal("show");

                //         $(".modal-title").text($ptext);
                //         // $mod = $("#modal-body");
                //         $("#modal-body").append($str);


                //     },
                // });
                
                    //setup an array of AJAX options,
                    //each object will specify information for a single AJAX request
                    var ajaxes  = [
                            
                            {
                                url      : 'get_comments.php',
                                data     : {date: $ptext,
                                        gId: <?php echo $grpId?>},
                                callback : function (res2) { console.log('hi');        $str2 = '';
                                        console.log(res2);
                                        for ($i = 0; $i < res2.length; $i++) {
                                            // console.log(res[$i].name);
                                            // console.log(res[$i].date);
                                             
                                            $str2+=`<div class="d-flex flex-start">
                                                            <div class="divimg" >
                                                                <img class="roundimg eshadow-1-strong me-3"
                                                                src="${res2[$i].user_profile_url}" alt="avatar"  />
                                                            </div>
                                                            <div class="flex-grow-1 flex-shrink-1">
                                                                <div>
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <p class="mb-1">
                                                                        ${res2[$i].name} <span class="small">- ${res2[$i].date}</span>
                                                                        </p>
                                                                        
                                                                    </div>
                                                                    <p class="small mb-0">
                                                                         ${res2[$i].post_text} 
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>`
                                            

                                        }
                                        // $("#flexCheckDefault").attr('checked',true);
                                        // $('#flexCheckDefault').prop('disabled', true);
                                        // console.log("ok");
                                        // $("#exampleModal").modal("show");

                                        // $(".modal-title").text($ptext);
                                        // // $mod = $("#modal-body");
                                        $("#comments").append($str2);
                                        // console.log($str2); 
                                    }
                            },
                            {
                                url      : "grpTask.php",
                                data     : {date: $ptext,gId: <?php echo $grpId?>},
                                callback : function (res) { $("#modal-body").empty();
                                $str = '';
                                // console.log(res);
                                for ($i = 0; $i < res.length; $i++) {
                                    // console.log(res[$i].task_details);
                                    // console.log(res[$i].status);
                                    if (res[$i].status == 0) {
                                        $str += `<div class="form-check ">
                                                <input data-value="${res[$i].id}" class="form-check-input fs-6 cust_uncheck_student" type="checkbox" value="" id="flexCheckDefault${$i}" >
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
                                    else {
                                        $str += `<div class="form-check ">
                                                    <input data-value="${res[$i].id}" class="form-check-input fs-6 cust_check_student" type="checkbox" value="" id="flexCheckDefault${$i}"checked>
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
                                $("#modal-body").append($str); }
                            }
                        ],
                        current = 0;

                    //declare your function to run AJAX requests
                    function do_ajax() {

                        //check to make sure there are more requests to make
                        if (current < ajaxes.length) {

                            //make the AJAX request with the given info from the array of objects
                            $.ajax({
                                url      : ajaxes[current].url,
                                data     : ajaxes[current].data,
                                success  : function (serverResponse) {

                                    //once a successful response has been received,
                                    //no HTTP error or timeout reached,
                                    //run the callback for this request
                                    ajaxes[current].callback(serverResponse);

                                },
                                complete : function () {

                                    //increment the `current` counter
                                    //and recursively call our do_ajax() function again.
                                    current++;
                                    do_ajax();

                                    //note that the "success" callback will fire
                                    //before the "complete" callback

                                }
                            });
                        }
                    }

                    //run the AJAX function for the first time once `document.ready` fires
                    do_ajax();

                    });



            // });

            

        $('#modal-body').on('change', 'input[type=checkbox]', function (e) {
            // console.log(this.checked);
            // var value = $(this).data('value');
            // console.log("The value is=" + value);
            e.preventDefault();
            $taskId = $(this).data('value');
            $this = $(this);
            $status = 0;
            $studentId =<?php echo $student_id;?>;
            $statusDisplay = $detailsDisplay = $nameDisplay = undefined;

            if (this.checked == true) {
                $status = 1;
                $(this).removeClass('cust_uncheck_student');
                $(this).addClass('cust_check_student');
                $(this).siblings('.text-dark').children('.form-check-label').empty();
                $.ajax({
                    url: "updateTaskStatus.php",
                    type: "GET",
                    data: {
                        taskId: $taskId,
                        status: $status,
                        studentId: $studentId
                    },
                    success: function (res) {

                        console.log(res.id);
                        console.log(res.group_id);
                        console.log(res.students_name);
                        console.log(res.status);
                        // console.log($(this).siblings('.text-dark'));
                        $statusDisplay = res.status;
                        $detailsDisplay = res.task_details;
                        $nameDisplay = res.students_name;

                        // if($statusDisplay){
                        //     $(this).siblings('.text-dark').children('.form-check-label').text(`${$detailsDisplay} <span class="text-success">(done by ${$nameDisplay})</span>`);
                        // }
                        // else{
                        //     $(this).siblings('.text-dark').children('.form-check-label').text($detailsDisplay);
                        // }
                        if ($statusDisplay) {


                            $this.siblings('.text-dark').children('.form-check-label').append(`${$detailsDisplay} <span class="text-success">(done by ${$nameDisplay})</span>`);
                            // $this.siblings('.text-dark').children('.form-check-label').text("rws=");
                        }
                        // else{
                        //     $this.siblings('.text-dark').children('.form-check-label').append($detailsDisplay);
                        // }

                    },
                });

            }
            else {
                $status = 0;
                $(this).removeClass('cust_check_student');
                $(this).addClass('cust_uncheck_student');
                $(this).siblings('.text-dark').children('.form-check-label').empty();
                $.ajax({
                    url: "updateTaskStatus.php",
                    type: "GET",
                    data: {
                        taskId: $taskId,
                        status: $status,
                        studentId: $studentId
                    },
                    success: function (res) {

                        console.log(res.id);
                        console.log(res.group_id);
                        console.log(res.students_name);
                        console.log(res.status);
                        // console.log($(this).siblings('.text-dark'));
                        $statusDisplay = res.status;
                        $detailsDisplay = res.task_details;
                        $nameDisplay = res.students_name;

                        // if($statusDisplay){
                        //     $(this).siblings('.text-dark').children('.form-check-label').text(`${$detailsDisplay} <span class="text-success">(done by ${$nameDisplay})</span>`);
                        // }
                        // else{
                        //     $(this).siblings('.text-dark').children('.form-check-label').text($detailsDisplay);
                        // }
                        if ($statusDisplay) {
                            // alert($detailsDisplay);
                            $this.siblings('.text-dark').children('.form-check-label').append($detailsDisplay);
                        }


                    },
                });

            }

            $('#modal-body').css('transition', 'all 0.3s ease');



            // console.log($detailsDisplay);


        });

        // $('#myElement').click(function() {
        //     location.reload();
        // });
        // $('#myElement2').click(function() {
        //     location.reload();
        // });
        $('#exampleModal').on('hidden.bs.modal', function () {
            location.reload();
        });


        

        });


    </script>
    <!--x-- Custom script --x-->

    <!-- Bootstrap Script file -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.rawgit.com/jashkenas/underscore/1.8.3/underscore-min.js" type="text/javascript"></script>
    <script src="../js/lib/jquery.elastic.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/jquery.mentionsInput.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('textarea').on('click', function (e) {
                e.stopPropagation();
            });
            $(document).on('click', function (e) {
                $("#status-overlay").hide();
                $("#highlight-textarea").css('z-index', '1');
                $("#highlight-textarea").css('position', '');
            });
        });

        $(document).ready(function () {

            function highlight() {
                $("#status-overlay").show();
                $("#highlight-textarea").css('z-index', '9999999');
                $("#highlight-textarea").css('position', 'relative');
            }

            //used for get users from database while typing @..
            $("textarea.mention").mentionsInput({
                onDataRequest: function (mode, query, callback) {
                    $.getJSON("../ajax/get_users_json.php", function (responseData) {
                        responseData = _.filter(responseData, function (item) {
                            return (
                                item.name.toLowerCase().indexOf(query.toLowerCase()) > -1
                            );
                        });
                        callback.call(this, responseData);
                    });
                },
            });

            $('.postMention').click(function () {
                // $("#comments").empty();
                // console.log('</?php echo $student_id;?>');
                $('textarea.mention').mentionsInput('val', function (text) {
                    var post_text = text;
                    $ptext =$(".modal-title").text();;
                    // console.log($ptext);
                    if (post_text != '') {
                        var post_data = "text=" + encodeURIComponent(post_text);
                        $.ajax({
                            type: "POST",
                            data: post_data,
                            // data :{
                            //     post_data:post_data,
                            //     student_id:</?php echo $student_id;?>,
                            //     grpId:</?php echo $grpId;?> 
                            // },
                            url: '../ajax/post.php?grpId=<?php echo $student_id;?>&date='+$ptext,
                            success: function (msg) {
                                if (msg == 1) {
                                    alert('Something Went Wrong!');
                                } else {
                                    $("#post_updates").prepend(msg);
                                    //reset the textarea after successful update
                                    $("textarea.mention").mentionsInput('reset');
                                }
                               
                                $.ajax({
                                            url: "get_comments.php",
                                            type: "GET",
                                            data: {
                                                date: $ptext,
                                                gId: <?php echo $grpId?>
                                            },
                                            success: function (res2) {
                                                // $("#modal-body").empty();
                                                $str2 = '';
                                                console.log(res2);
                                                for ($i = 0; $i < res2.length; $i++) {
                                                    // console.log(res[$i].name);
                                                    // console.log(res[$i].date);
                                                    $str2+=`<div class="d-flex flex-start">
                                                                    <img class="rounded-circle shadow-1-strong me-3"
                                                                        src="${res2[$i].user_profile_url}" alt="avatar" width="40"
                                                                        height="40" />
                                                                    <div class="flex-grow-1 flex-shrink-1">
                                                                        <div>
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <p class="mb-1">
                                                                                ${res2[$i].name} <span class="small">- ${res2[$i].date}</span>
                                                                                </p>
                                                                                <!-- <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a> -->
                                                                            </div>
                                                                            <p class="small mb-0">
                                                                                ${res2[$i].post_text}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>`;
                                                    

                                                }
                                                // $("#flexCheckDefault").attr('checked',true);
                                                // $('#flexCheckDefault').prop('disabled', true);
                                                // console.log("ok");
                                                // $("#exampleModal").modal("show");

                                                // $(".modal-title").text($ptext);
                                                // // $mod = $("#modal-body");
                                                $("#comments").empty();
                                                $("#comments").append($str2);
                                                // console.log('lol'+$str2);


                                            },
                                        });

                            }
                        });


                        // var ajaxes2  = [
                            
                            
                        //     {
                        //         type     : "POST",
                        //         url      :'../ajax/post.php?grpId=</?php echo $student_id;?>&date='+$ptext,
                        //         data     : post_data,
                        //         callback : function (msg) { if (msg == 1) {
                        //             alert('Something Went Wrong!');
                        //         } else {
                        //             $("#post_updates").prepend(msg);
                        //             //reset the textarea after successful update
                        //             $("textarea.mention").mentionsInput('reset');
                        //         }}
                        //     }
                        // ]
                        // current = 0;

                        // //declare your function to run AJAX requests
                        // function do_ajax2() {

                        //     //check to make sure there are more requests to make
                        //     if (current < ajaxes2.length) {

                        //         //make the AJAX request with the given info from the array of objects
                        //         $.ajax({
                        //             url      : ajaxes2[current].url,
                        //             data     : ajaxes2[current].data,
                        //             success  : function (serverResponse) {

                        //                 //once a successful response has been received,
                        //                 //no HTTP error or timeout reached,
                        //                 //run the callback for this request
                        //                 ajaxes2[current].callback(serverResponse);

                        //             },
                        //             complete : function () {

                        //                 //increment the `current` counter
                        //                 //and recursively call our do_ajax() function again.
                        //                 current++;
                        //                 do_ajax2();

                        //                 //note that the "success" callback will fire
                        //                 //before the "complete" callback

                        //             }
                        //         });
                        //     }
                        // }

                        // //run the AJAX function for the first time once `document.ready` fires
                        // do_ajax2();

                        // });


                    } else {
                        alert("Post cannot be empty!");
                    }
                });
            });

            


            
        });
    </script>
</body>

</html>