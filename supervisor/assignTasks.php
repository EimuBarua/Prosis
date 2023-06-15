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
        .r.btn:focus {
            outline: none;
            box-shadow: none;
        }
        #jinku{
            flex:wrap;
            color:red;
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
            <div class="container-fluid px-3">
                <div class="row col-lg-6 col-md-12">
                    <div class="  bg-white">
                        <form id="assignTask" action="" method="post">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Visiting Date</label>
                                <input type="date" name="date" class="form-control" id="date">
                            </div>
                            <label class="form-label">Assign Task</label>
                            <div class="mb-3" id="1">
                               <div class="d-flex mb-1">
                                    <input type="text" id="input1" class="g form-control " name="task[]" placeholder="write a task here...">

                                    <a id="addBtn" href="#" class="btn r bg-transparent h-25 p-0 "><i class="fa fa-plus-circle fs-5 text-success" aria-hidden="true"></i></a>
                               </div>
                               <textarea class="form-control " name="description[]" placeholder="add description here..." id="description1" rows="3"></textarea>
                            </div>                            
                            <!-- <button id="submitBtn" type="button" value="Submit" class="btn btn-success">Submit</button> -->
                            <input id="submitBtn" type="submit" value="Submit" class="btn btn-success">
                        </form>
                    </div>
                   
                </div>



                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body" id="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
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
    <!-- Jquery Validation CDN -->
    <script src=" https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

    <!-- Custom script -->
    <script>
        $(document).ready(function () {
            <?php
            
            if($_SESSION['error']==1) {
          ?>
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
           <?php   $_SESSION['error']=0;
           }
            ?>


            $submitted = true;
            


            //Custom duplicate chaking function
            function checkDuplicate(name) {
                var wrong = false;
                var str = '<p>Warning:</p>'
                var arr = name;
                var map = arr.reduce(function (prev, cur) {
                    prev[cur] = (prev[cur] || 0) + 1;
                    return prev;
                }, {});
                for (var key in map) {
                    if (map[`${key}`] > 1) {
                        // console.log(`${key}==>${map[`${key}`]}`)
                        str += `<p>\n ${key} appear ${map[`${key}`]} times </p>`;
                        wrong = true;
                    }
                }
                if (wrong) {
                    $mod = $("#modal-body");
                    $mod.empty();
                    $submitted = false;
                    $("#exampleModal").modal("show");
                    $mod.append(str);
                }else{
                    $submitted=true;
                }

            }


            // Overidding methods
            $.validator.prototype.errorsFor = function (element) {
                var name = this.idOrName(element);
                var elementParent = element.parentElement;
                return this.errors().filter(function () {
                    return $(this).attr("for") == name && $(this).parent().is(elementParent);
                });
            };
            $.validator.prototype.checkForm = function () {
                this.prepareForm();
                for (
                    var i = 0, elements = (this.currentElements = this.elements());
                    elements[i];
                    i++
                ) {
                    if (
                        this.findByName(elements[i].name).length != undefined &&
                        this.findByName(elements[i].name).length > 1
                    ) {
                        for (
                            var cnt = 0;
                            cnt < this.findByName(elements[i].name).length;
                            cnt++
                        ) {
                            this.check(this.findByName(elements[i].name)[cnt]);
                        }
                    } else {
                        this.check(elements[i]);
                    }
                }
                return this.valid();
            };


            


            // Initializing Variables With Regular Expressions
            var task_regex = /^[a-zA-Z0-9 ]+$/;

            $.validator.addMethod(
                "taskCheck",
                function (value, element) {
                    return value.match(task_regex);
                },
                "Invalid Task"
            );

            $("#assignTask").validate({
                errorPlacement: function($error, $element) {
                    $error.appendTo($element.parent().siblings("p"));
                },
                rules: {
                    "task[]": {
                        required: true,
                        taskCheck: true,
                    }
                },
                messages: {
                    "task[]": {
                        required: "This field is mandatory",
                    },
                  
                }
            });


            $ii = 2;
            $("#addBtn").click(function () {
                $sib = $(this).siblings();
                $value = $sib.val();
                $taskDescription=$(this).parent().siblings().val();
                console.log($value);
                console.log($taskDescription);
                $(`<div class="mb-3" id="${$ii}">
                        <input id="input${$ii}"  type="text" class="g form-control mb-1" name="task[]" placeholder="write a task here...">
                        <textarea class="form-control " name="description[]" id="description${$ii}" placeholder="add description here..." rows="3"></textarea>
                </div>`).insertBefore($('#assignTask').children().last().prev());

                $(`#input${$ii}`).val($value);
                $(`#description${$ii}`).val($taskDescription);
                $(this).parent().siblings().val('');
                $sib.val('');
                $ii++;
            });

            

            // $("form").submit(function (e) {
                
            // });
                // alert("Submitted");
   
                    $("#assignTask").submit(function(e) {

                        e.preventDefault(); // avoid to execute the actual submit of the form.
                        const name = $.map($('input[type=text][name="task[]"]'), function (el) {
                            return el.value;
                        });
                        const description = $.map($('textarea[name="description[]"]'), function (el) {
                            return el.value;
                        });
                        const date= $('#date').val();
                        // console.log(date);
                        // console.log(name);
                        // console.log(description);

                        checkDuplicate(name);

                        if(date== ''){
                            $submitted = false;
                            $("#exampleModal").modal("show");
                            $mod = $("#modal-body");
                            $mod.text('Date Is mendatory.');
                        }
                        // console.log(name);
                        // console.log(date);
                        // console.log($submitted); 


                        
                        if($submitted){
                            // console.log($submitted);     
                            $.ajax({
                                url: "postTasks.php",
                                type: "GET",
                                data: {
                                    date: date,
                                    name: name,
                                    description:description,
                                    grpId: <?php echo $grpId ?>
                                },
                                success: function (res) {
                                    if(res.success=='ok'){
                                        $("#exampleModal").modal("show");
                                        $mod = $("#modal-body");
                                        $mod.text('Successfully Sbmitted');
                                    }
                                },
                            });
                        }
                    });   
        });

    </script>

    <!--x-- Custom script --x-->
</body>

</html>