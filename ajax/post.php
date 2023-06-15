<?php

    include 'connection.php';
    $studentId=$_REQUEST['grpId'];
    $date=$_REQUEST['date'];
    // $studentId=$_REQUEST['student_id'];
    // $post_data=$_REQUEST['post_data'];
    // // echo $grpId.' '.$studentId.' '.$post_data;
    echo $date;
    $str="SELECT * FROM group_members WHERE student_id= $studentId ";
    $user=mysqli_query($conn,$str);
    $e=mysqli_fetch_assoc($user);
    echo $e['group_id'];
    $groupId=$e['group_id'];
    // echo $studentId;
    // echo $post_data;
    // echo'<br>';
    // $text = strip_tags($post_data); //clean the text
    // echo $text;    
    // // echo $_POST['text'];

    if(isset($_POST) && !empty($_POST['text']) && $_POST['text'] != '')
    {
        include 'connection.php';
        
        $user = $studentId; //w3lessons demo user

        $text = strip_tags($_POST['text']); //clean the text
        // echo $text;
        echo $_POST['text'];
        $str="INSERT INTO comments(post_text,post_user_id,post_group_id,ondate) VALUES('".$text."',$user,$groupId,'".$date."')";
        // echo $text;
        // echo $str;
        mysqli_query($conn,$str);
       

        // $DB->query("INSERT INTO posts(post_text,post_user_id) VALUES(?,?)", array($text,$user));
        ?>
        <div class="media">
            <div class="media-left">
                <img src="https://cdn.w3lessons.info/logo.png" class="media-object" style="width:60px">
            </div>
                <div class="media-body">
                    <h4 class="media-heading">w3lessons</h4>
                    <p><?php echo getMentions($text); ?></p>
                </div>
            </div>
        </div>
        <hr>
    <?php
    }
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











