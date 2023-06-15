<?php
  include '../connection.php';
  session_start();
  ob_start();
  $_SESSION['url']=$_SERVER['REQUEST_URI'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Auth</title>
    <link rel="stylesheet" href="../assets/css/style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/43694a3c17.js" crossorigin="anonymous"></script>
    <script>
        $(function() {

$('#sign-in-link').click(function(e) {
$("#sign-in").delay(100).fadeIn(100);
$("#sign-up").fadeOut(100);
$('#sign-up').removeClass('active');
$('#sign-up').addClass('Inactive');
$('#ex1').removeClass('logsha');
$('#ex2').addClass('logsh');
e.preventDefault();
});
$('#sign-up-link').click(function(e) {
$("#sign-up").delay(100).fadeIn(100);
$("#sign-in").fadeOut(100);
$('#sign-in').removeClass('active');
$('#sign-in').addClass('Inactive');
$('#ex2').removeClass('logsh');
$('#ex1').addClass('logsha');
e.preventDefault();
});

});
    </script>
  </head>
  <body >
    <section class="wrapper ">
        <div class="containter login ">
            <p class="fs-1 fff-2  text-center">PROSIS</p>
            <p class="text-center">A project and thesis management system.</p>
            <div class="col-8 offset-2 col-md-8 offset-2 col-xl-6 offset-xl-3  text-center shadow-lg">
               
                <div class="row ro mb-3 ">
                    <div class=" col py-2" id="ex1">
                        <a href="#" class=" fs-6 text-dark text-center text-decoration-none fff "  id="sign-in-link">sign in</a>
                    </div>
                    <div class="col logsh py-2" id="ex2">
                        <a href="#" class="fs-6  text-dark text-center text-decoration-none fff"id="sign-up-link">sign up</a>
                    </div>
                </div>
                <form method='post' class=" rounded bg-white  px-5 pb-5 " id="sign-in" action="">
        
                    <div class="form-floating mb-3 pb-4 m">
                        <input type="number" name="UserID" class="form-control" id="floatingInput" placeholder="User ID">
                        <label for="floatingInput"><i class="fa-solid fa-user"></i> User ID</label>
                    </div>
                    <div >
                      <div class="form-floating  pb-4">

                        <input type="password" name="UserPass"  class="form-control" id="passid" placeholder="Password" >
                        <label for="floatingPassword" ><i class="fa-solid fa-key"></i> Password</label>
                        <i id='vis' class="vis fa-solid fa-eye-slash"></i>
              
      
                
                      </div>
                     
                      
                    </div>
                    
                    <button name='submit' type="submit" class="cb btn  submit_btn w-100 my-4 bt-shadow" >Sign In</button>
                    
                </form>

























                <!-- / <........................................Sign UP starts............................................> -->
                <form class="Inactive rounded bg-white  px-5 pb-5 " id="sign-up" action="">
        

                    <div class="row g-4 pb-4">
                        <div class="col-md ">
                          <div class="form-floating" id='dfn'>
                            <input type="text" class="form-control"  name="fname" id="fname" placeholder="First Name" value="">
                            <label for="floatingInputGrid"><i class="fa-regular fa-user"></i> First Name</label>
                          </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating" id='dln'>
                              <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="">
                              <label for="floatingInputGrid"><i class="fa-regular fa-user"></i> Last Name</label>
                            </div>
                          </div>
                      </div>
                      <div class="form-floating pb-4" id='did'>
                        <input type="number" class="form-control" name="id" id="id" placeholder="ID">
                        <label for="floatingNumber"> <i class="fa-solid fa-user"></i> ID</label>
                    </div>
                    <!-- <div class="row g-4 pb-4">
                        <div class="col-md">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="session" id="floatingInputGrid" placeholder="Session" value="" disabled>
                            <label for="floatingInputGrid"><i class="fa-solid fa-clock"></i> Session</label>
                          </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                              <input type="text" class="form-control" name="batch" id="floatingInputGrid" placeholder="Batch" value="" disabled>
                              <label for="floatingInputGrid"><i class="fa-solid fa-graduation-cap"></i> Batch</label>
                            </div>
                          </div>
                      </div> -->
                      <div class="row g-4 pb-4">
                        <div class="col-md">
                          <div class="form-floating" id='de'>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="">
                            <label for="floatingInputGrid"><i class="fa-solid fa-envelope"></i> Email</label>
                          </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                              <input type="tel" class="form-control" name="phone" id="floatingInputGrid" placeholder="Phone" value="" disabled>
                              <label for="floatingInputGrid"><i class="fa-solid fa-phone"></i> Phone no.</label>
                            </div>
                          </div>
                        </div>
                        <div class="row g-4 pb-4">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="dob"id="floatingInputGrid" placeholder="Date of Birth" value="" disabled>
                                    <label for="floatingInputGrid"><i class="fa-solid fa-calendar"></i> Date of Birth</label>
                                </div>
                            </div>
                            <!-- <div class="col-md">
                                <div class="form-floating">
                                  <input type="text" class="form-control" id="floatingInputGrid" placeholder="Gender" value="">
                                  <label for="floatingInputGrid"><i class="fa-solid fa-user"></i> Gender</label>
                                </div>
                              </div> -->
                              <div class="col-md form-floating">
                              
                                <select name="cid" id="" class='form-control' id="floatingInputGrid" disabled>
                          
                                  <option value="NULL" ><img src="https://img.icons8.com/windows/32/000000/user.png"/> Gender</option>

                                   <option value="1" data-thumbnail="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/LetterA.svg/2000px-LetterA.svg.png"></option>> Male</option>
                                   <option value="2">Female</option>
                                   <option value="3"> Others</option>
                                  </select>
                              </div>
                      
                      </div>
                      <div class="input-group pb-4">
                        <label class="input-group-text cho" for="inputGroupFile01"><i class="fa-solid fa-image-portrait pl"></i>Profile Picture</label>
                        <input name="file" type="file" class="form-control" id="policy_image" >
                      </div>
                      <div class="form-floating pb-4">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" disabled></textarea>
                        <label for="floatingTextarea2"><i class="fa-solid fa-map-location-dot"></i> Address</label>
                      </div>
                    <div class="form-floating pb-4">
                        <input type="password" class="form-control" id="pass" placeholder="Password">
                        <label for="floatingPassword"><i class="fa-solid fa-key"></i> Password</label>
                    </div>
                    <div class="form-floating " id='passcheck'>
                        <input type="password" class="form-control" id="cpass" placeholder="Password">
                        <label for="floatingPassword"><i class="fa-solid fa-key"></i> Confirm Password</label>
                    </div>
                   
                    <button id='submit2' type="submit" class="btn cb submit_btn w-100 my-4 bt-shadow">Sign Up</button>
                    
                </form>
                <!-- / <........................................Sign UP ends ............................................> -->
                
            </div>
         

        </div>




        

    </section>


    <script>
      
      $(document).ready(function(){
                $('#vis').click(function(){
                var ff=$("#vis").attr("class");
                console.log(ff);
                if(ff=="vis fa-solid fa-eye-slash")
                {
                  $("#vis").removeClass("fa-eye-slash");
                  $("#vis").addClass("fa-eye");
                  var pp=$('#passid').val();
                /// console.log(pp);
                  $('#passid').attr('type', 'text'); 
                }
                else
                {
                  $("#vis").removeClass("fa-eye");
                  $("#vis").addClass("fa-eye-slash");
                  $('#passid').attr('type', 'password'); 
                  // $("#passid").attr('type','password');
                }
              /// console.log(123);

              });
              var valid=1;
        $(document).on("keyup","#fname",function(){
            var sid=$(this).val();
            $("#fname").removeClass("is-invalid");
            $('#rrn').remove();
            valid=1;
           /// console.log(sid);
                  
                     ///  console.log(7897);
                     if (!/[^a-zA-Z]/.test(sid))
                     {
                          ///
                     }
                     else
                     {valid=0;
                      $("#fname").addClass("is-invalid");
                       x=`<div id='rrn' class="invalid-feedback">
                       Must Contain Alphabets.
                    </div>`
             $('#dfn').append(x);
                     }
   
                     
                    
                });
                var valid=1;
        $(document).on("keyup","#lname",function(){
            var sid=$(this).val();
            $("#lname").removeClass("is-invalid");
            $('#rrl').remove();
            valid=1;
           /// console.log(sid);
                  
                     ///  console.log(7897);
                     if (!/[^a-zA-Z]/.test(sid))
                     {
                          ///
                     }
                     else
                     {valid=0;
                      $("#lname").addClass("is-invalid");
                       x=`<div id='rrl' class="invalid-feedback">
                     Must Contain Alphabets.
                    </div>`
             $('#dln').append(x);
                     }
                    
                });

                var valid=1;
        $(document).on("keyup","#id",function(){
            var sid=$(this).val();
            $("#id").removeClass("is-invalid");
            $('#rr').remove();
            
            valid=1;
           /// console.log(sid);
           function hasNumber(myString) {
         return /\d/.test(myString);
          }
            if(sid.length>0&&sid.match(/^[0-9]+$/) == null)
            {
              valid=0;
              $("#id").removeClass("is-invalid");
            $('#rr').remove();
                      $("#id").addClass("is-invalid");
                       x=`<div id='rr' class="invalid-feedback">
                    Must Contain Numbers.
                    </div>`
             $('#did').append(x);
            }
            if(sid.length>0&&sid.length != 13)
            {
              valid=0;
              $("#id").removeClass("is-invalid");
            $('#rr').remove();
                      $("#id").addClass("is-invalid");
                       x=`<div id='rr' class="invalid-feedback">
                    Must Contain a 13 digit Number.
                    </div>`
             $('#did').append(x);
            }

            


                  $.ajax
                  ({
                    url:'api5.php?id='+sid,
                    type:'GET',
                    success: function(res){
                      
                      if(res.length>0)
                      {
                     ///  console.log(7897);
                     valid=0;
                     $("#id").removeClass("is-invalid");
            $('#rr').remove();
                      $("#id").addClass("is-invalid");
                       x=`<div id='rr' class="invalid-feedback">
                     This ID is already exists.
                    </div>`
             $('#did').append(x);
                     }
    //                  else
    //                  {
    //                   $("#"+id).addClass("is-invalid");
    //                    x=`<div id="extra${id}" class="invalid-feedback">
    //                  Please Input a Valid ID.
    //                 </div>`
    // $('#d'+id).append(x);
    //                  }
                     
                    }
                });
            });
            var valid=1;
        $(document).on("keyup","#email",function(){
            var sid=$(this).val();
            $("#email").removeClass("is-invalid");
            $('#rre').remove();
            
            valid=1;
            em=0;
            for(var i=0;i<sid.length;i++)
            {
              if(sid[i]=='@')
              em++;
            }
            if(sid.length>0&&em!=1)
            {
              valid=0;
              $("#email").removeClass("is-invalid");
            $('#rre').remove();
                      $("#email").addClass("is-invalid");
                       x=`<div id='rre' class="invalid-feedback">
                   Invalid Email(ex-e@gmail.com)
                    </div>`
             $('#de').append(x);
            }
           
            


                  $.ajax
                  ({
                    url:'emailc.php?id='+sid,
                    type:'GET',
                    success: function(res){
                      
                      if(res.length>0)
                      {
                       console.log(7897);
                     valid=0;
                     $("#email").removeClass("is-invalid");
            $('#rre').remove();
                      $("#email").addClass("is-invalid");
                       x=`<div id='rre' class="invalid-feedback">
                     This Email is already exists.
                    </div>`
             $('#de').append(x);
                     }
    //                  else
    //                  {
    //                   $("#"+id).addClass("is-invalid");
    //                    x=`<div id="extra${id}" class="invalid-feedback">
    //                  Please Input a Valid ID.
    //                 </div>`
    // $('#d'+id).append(x);
    //                  }
                     
                    }
                });
            });
            $(document).on("keyup","#cpass",function(){
              var pass=$("#pass").val();
                        var cpass=$("#cpass").val();
            $("#cpass").removeClass("is-invalid");
            $('#rrp').remove();
            valid=1;
           /// console.log(sid);
           if(cpass!=pass)
           {
                        console.log(cpass);
                     ///  console.log(7897);
                     valid=0;
                      $("#cpass").addClass("is-invalid");
                       x=`<div id='rrp' class="invalid-feedback">
                     Password doesn't match
                    </div>`
             $('#passcheck').append(x);
                     }
            });
          
                    $("#submit2").click(function(e){
                        e.preventDefault();
                        var id=$("#id").val();
                        var fname=$("#fname").val()
                        var lname=$("#lname").val();
                        // console.log(name);
                        var email=$("#email").val();
                        var pass=$("#pass").val();
                        var cpass=$("#cpass").val();
                        // var fd = new FormData(this);
                        // fd.append('file',$('#file')[0].files[0]);
                        // fd.append('id',$('#id').val());
                        // fd.append('fname',$('#fname').val());
                        // fd.append('lname',$('#lname').val());
                        // fd.append('email',$('#email').val());
                        // fd.append('pass',$('#pass').val());
                        // fd.append('cpass',$('#cpass').val());
                      
                                              
                        if(valid==1&&pass==cpass)
                        {
                          ///  console.log(7777);
                                // $.ajax({
                                //     url:"poststuTwo.php",
                                //     type:"POST",
                                //     data: fd, 
                                //     cache: false,
                                //     contentType: false,
                                //     processData: false, 
                                //     success: function(res)
                                //     {
                                //     ///     console.log(res.data.succ);
                                //     alert('SuccessFully Registered');
                                    
                                //     $("#sign-up")[0].reset()
                                //     }
                                // });
                                var file_data = $('#policy_image').prop('files')[0];
                                var form_data = new FormData();
                                form_data.append('policy_image', file_data);
                                form_data.append('id',$('#id').val());
                                form_data.append('fname',$('#fname').val());
                                form_data.append('lname',$('#lname').val());
                                form_data.append('email',$('#email').val());
                                form_data.append('pass',$('#pass').val());
                                form_data.append('cpass',$('#cpass').val());
                                
                                

                                $.ajax({
                                    url         :'poststuTwo.php',
                                    cache       : false,
                                    contentType : false,
                                    processData : false,
                                    data        : form_data,                         
                                    type        : 'post',
                                    success     : function(output){
                                        alert(output);
                                    }
                                });
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


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
  </body>
</html>
<?php
if(isset($_POST['submit']))
{
    $userid=$_POST['UserID'];
    $password=$_POST['UserPass'];
    $s="SELECT * FROM students where id=".$userid." and pass='".$password."'";
    $us=mysqli_query($conn,$s);
    $u=mysqli_fetch_assoc($us);
    if(mysqli_num_rows($us)>0)
    {
       $_SESSION['id']=$u['id'];
      $_SESSION['role']='student';
      $_SESSION['error']=0;
        exit(header("Location:studentProgressBar.php"));
        ob_end_clean();
    }
    else
    {
?>
      <script>
         $(document).ready(function(){
          // e.preventDefault();
           var x=`   <p class="text-danger" id='invalid' >Incorrect ID or Password</p>`;
           $('#sign-in').append(x);
         });
      </script>
      <?php
    }
}
?>