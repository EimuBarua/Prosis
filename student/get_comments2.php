<?php include '../connection.php'; ?>
<?php

function getMentions($content)
{
    // global $DB;
    $mention_regex = '/@\[([0-9]+)\]/i'; //mention regrex to get all @texts

    if (preg_match_all($mention_regex, $content, $matches))
    {
        foreach ($matches[1] as $match)
        {
            include '../connection.php';
            // $match_user =$DB->row("SELECT * FROM users WHERE user_id=?",array($match));
            $str="SELECT * FROM students WHERE id=$match;";
         
            // echo $str;
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




    $date=$_REQUEST['date'];
    $grpId=$_REQUEST['gId'];
    // echo $grpId;
    // echo $date;
    // $str="SELECT * FROM comments WHERE ondate='".$date."'AND post_group_id=".$grpId.";";
    $str="SELECT * FROM (SELECT * FROM comments WHERE ondate='".$date."' AND post_group_id=".$grpId.") AS T INNER JOIN students ON T.post_user_id=students.id;";
    // echo $str;
    $q=mysqli_query($conn,$str);
    $data=[];
    
    while($row=mysqli_fetch_array($q)){
        // print_r($row);
        // echo $row['id'].' '.$row['name'].'<br>';
        $obj=[];
        $name=$row['first_name'].' '.$row['last_name'];
        $date=$row['post_date'];
        $post_text=getMentions($row['post_text']);
        $user_profile_url=$row['user_profile_url'];
        // $student_id=$row['student_id'];
        // $status=$row['status'];


        $obj['name']=$name;
        
        $obj['date']=$date;
        $obj['post_text']=$post_text;
        $obj['user_profile_url']=$user_profile_url;
        
        // $obj['status']=$status;

        array_push($data,$obj);

        // echo $row['id'];
    }
    // print_r($data);
    header('Content-Type: application/json');
    echo json_encode($data);
?>