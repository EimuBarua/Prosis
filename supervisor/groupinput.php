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
    }
}
    else
    header('Location:auth-supervisor.php');
    $_SESSION['url']=$_SERVER['REQUEST_URI'];
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <link rel="stylesheet" href="../assets/css/style1.css">
    <title>Enter Group info</title>
  </head>
  <body>
  <div class="main-wrapper">

<!-- navigation content -->
<?php include 'navContent.php'; ?>
<!--x--- navigation content --x--->



<!-- main content -->
<div class="content-wrapper">
    <!-- <div class="row">
      <div class="col-6">
      <form  action=""  method="POST" id="mem2">
      <input type="number" class='paisi form-control' name="id[]" id="id11" placeholder='Enter Member ID'>
      <input type="number" class='paisi form-control' name="id[]" id="id10" placeholder='Enter Member ID'>
      </form>
      </div>
    </div> -->
      <div class="container ">
            <h1>Enter Group info</h1>
            <div class="col-6">
                <label for="">Members</label>
                <select class='form-control'  name="" id="members">
                    <option value="">Select NO of Members</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            
              <div class='mt-3'>
                <form  action=""  method="POST" id="mem">
                    
                    <h2>Members Info</h2>
                  
                    </form>
                </div>

            </div>      
    </div>       
  </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id='modal-body'>
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id='no' >No</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='yes'>Yes</button>
      </div>
    </div>
  </div>
</div>
</div>
<script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" charset="utf8" src="../assets/js/data-table/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    <script src="../assets/js/chart/apexcharts.min.js"></script>
    <script src="../assets/js/chart/chart.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>
      $(document).ready(function(){
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

             var students=[5];
             for(var i=1;i<=3;i++)
             students[i]=0;
             var names=[5];
             var members_no;
             // $('#divison').change(function(){
               //     $('#district').empty();
            //       var id= $(this).val();
            //       $.ajax
            //       ({
            //         url:'api2.php?id='+id,
            //          type:'GET',
            //         success: function(res){
            //            var str='<option value="">Select District</option>';
            //            for(var i=0;i<res.length;i++)
            //            {
            //              str+=" <option value="+res[i].dist_id+">"+res[i].dist_name+"</option>"
            //              ///console.log(str);
            //             }
            //             $('#district').append(str);
                     
            //         }

            //       });
            //      // console.log(divison_id);
            //   });
           
              $('#members').change(function(){
                members_no = $(this).val();
                    var x='<h2>Members Info</h2>';
                    $('#mem').empty();
                    for(var i=1;i<=3;i++)
             students[i]=0;
                   for(var i=1;i<=Math.min(members_no,3);i++)
                   {
        
                        x+=`
                        <div class="row">
                <div class="col-4 pt-2" id="did${i}">
                     <input type="number"  class='form-control paisi' name="id[]" id="id${i}" placeholder='Enter Member ID'>
                </div>
                <div class="col-4 pt-2">
                <input type="text" value='' class='form-control paisi' name="name[]" id="nameid${i}" placeholder='Name' disabled>
                </div>
                <div class="col-4 pt-2"> 
                <input type="text" value='' class='form-control paisi' name="email[]" id="emailid${i}" placeholder='Email' disabled>
                </div>
                </div>
                `;
                
                   }


               $('#mem').append(x);
                //    x='';
                   ///console.log(x);
                x=`
                <button id='submit' name="submit" type="submit" class='btn btn-info mt-2'>Submit</button>
                `;
                $('#mem').append(x);
                $("#submit").attr('disabled','disabled');
              });

              // $(document).on("change", ".paisi", function(){
                $(document).on("keyup",".paisi",function(){
                  $("#submit").removeAttr('disabled');
                 $("#submit").attr('disabled','disabled');
                var id=$(this).attr('id'); 
                var itemId = id.substring(2, id.length);
                var sid= $(this).val();
                var f_group=0;
                $.ajax
                  ({
                    url:'api3.php?id='+sid,
                     type:'GET',
                     async: false ,
                    success: function(res){
                      //console.log('fff ',res.length);
                      if(res.length>0)
                      f_group=1;
                     
                      //console.log(f_group);
                    }
                  });
                  $.ajax
                  ({
                    url:'api4.php?id='+sid,
                    type:'GET',
                    
                    success: function(res){
                      $('#name'+id).empty();
                      $('#extra'+id).remove();
                      $("#"+id).removeClass("is-invalid");
                      $('#email'+id).empty();
                      students[itemId]=0;
                      if(res.length>0)
                      {
                      var found=0;
                      for(var i=1;i<=students.length;i++)
                      {
                        if(res[0].id==students[i])
                        found=1;
                      }
                       if(f_group==1)
                      {
                        $("#"+id).addClass("is-invalid");
                       x=`<div id="extra${id}" class="invalid-feedback">
                     This ID is already selected in other group.
                    </div>`
                    $('#d'+id).append(x);
                      }
                     else if(found==0)
                      {
                       /// console.log(res[0].id,res[0].name,res[0].email);

                     names[itemId]=res[0].fname;
                     $('#name'+id).val(res[0].fname);
                     $('#'+id).val(res[0].id);
                     /// $('#name'+id).append(res[0].name);
                     $('#email'+id).val(res[0].email);

                      students[itemId]=res[0].id;
                      var fg=1;
            for(var i=1;i<=members_no;i++)
            {
              if(students[i]==0)
                fg=0;
            }
            console.log(fg);
            if(fg)
            $("#submit").removeAttr('disabled');
           
                      }
                      else
                     {
                      $("#"+id).addClass("is-invalid");
                       x=`<div id="extra${id}" class="invalid-feedback">
                     This ID is already selected for this group.
                    </div>`
    $('#d'+id).append(x);
                     }

                     }
                     else
                     {
                      $("#"+id).addClass("is-invalid");
                       x=`<div id="extra${id}" class="invalid-feedback">
                     Please Input a Valid ID.
                    </div>`
    $('#d'+id).append(x);
                     }
                     
                    }
                });
          
           
            
           });
           $("form").submit(function(e){
            e.preventDefault();
            // console.log(members_no);
            var valid=1;
            var x=`Are you Sure You Want to Create A Group With `;
            for(var i=1;i<=members_no;i++)
            {
              if(students[i]==0)
              valid=0;
              console.log(names[i]);
              x+='<b>';
              x+=names[i];
              x+='</b>';
              console.log(x);
              if(i==members_no-1)
              x+=' and ';
              else if(i!=members_no)
              x+=',';
            }
            if(valid==1)
            {
              x+' ?';
              $('#exampleModalLabel').empty();
               $('#exampleModalLabel').append('Confirmation');
               $('#modal-body').empty();
                   $('#modal-body').append(x);
               $('#exampleModal').modal('show');
               
               if($("#yes").unbind().click(function(){
                console.log('yes')
                $.ajax({
                  url:"postgroups.php",
                 type:"POST",
                  data :
                  {
                      id:students,
                      name:names,
                      members:members_no,
                      supervisor:<?php echo $_SESSION['id'];?>
                  },
                  success: function(res)
                  {
                   ///     console.log(res.data.succ);
                   $("#mem")[0].reset();
                      for(var i=1;i<=members_no;i++)
                      {$('#nameid'+i).empty();
                        $('#emailid'+i).empty();
                      }
                   ///$("#myform")[0].reset()
                  }
               });
}));


             }
             else
             {
               alert('Please Enter The Details Correctly.')
             }
             
           });
          });
         </script>
         <script>
              
         </script>
    
  </body>
</html>
<?php
// if(ISSET($_POST['submit']))
// echo 'sss';

?>