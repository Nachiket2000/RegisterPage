
<?php
require_once "config.php";

$email = $password = $confirm_password = "";
$email_error = $password_error = $confirm_password_error = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty(trim($_POST["email"]))){
        $email_error = "Email cannot be blank";
    }
    else{
        $sql = "SELECT `id` FROM `users` WHERE `email` = ? ";
        $sql2 = mysqli_prepare($con, $sql);

        if($sql2){
            mysqli_sql2_bind_par($sql2 , "s" , $par_email);


            //Set value of par email
            $par_email= trim($_POST['email']);

            //Execution of the statement
            if(mysqli_sql2_execute($sql2)){
                mysqli_sql2_store_result($sql2);

                if(mysqli_sql2_num_rows($sql2) == 1){
                    $email_error = "this email is already taken";
                }
                else{
                    $email = trim($_POST['email']);
                }
            }
            else{
                echo "Error occured";
            }


        }
    }
    mysqli_sql2_close($sql2);


//Password check
if(empty(trim($_POST['password']))){
    $password_error = "Password cannot be empty";
}
elseif(strlen(trim($_POST['password'])) < 8){
    $password_error = "Minimun 8 characters required";
}
else{
    $password = trim($_POST['password']);
}

//confirm field
if(trim($_POST['password']) != trim($_POST['confirm_password'])){
    $password_error = "Passwords must be same";
}

//No errors
if(empty($email_error) && empty($password_error) && empty($confirm_password_error)){
    $sql = "INSERT INTO `users` (`email`,`password`) VALUES (?,?)";
    $sql2 = mysqli_prepare($con,$sql);
    if($sql2){
        mysqli_sql2_bind_par($sql2, "ss", $par_email, $par_password);

        //set these parameters
        $par_email = $email;
        $par_password = password_hash($password,PASSWORD_DEFAULT);

        //execution of query
        if(mysqli_sql2_execute($sql2)){
            header("location: login.html");
        }
        else{
            echo "Error occured! cannot redirect";
        }
    }
    mysqli_sql2_close($sql2);
}
mysqli_close($con);



}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task2 Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
    <img class ="bg" src="https://c1.wallpaperflare.com/preview/108/814/559/laptop-office-desk-camera.jpg" alt="">
    <div class="container1">
        <div class="title">
            <h2>Registration Form</h2>
        </div>
        <form action="" method="POST">
        <div class="form">
            <div class="box1">
                <label>Name</label>
                <input type="text" class="box">
            </div>
            <div class="box1">
                <label>Email</label>
                <input type="email" name="email" class="box">
            </div>
            <div class="box1">
                <label>Mobile Number</label>
                <input type="number" class="box">
            </div>
            <div class="box1">
                <label>Branch</label>
                <div class="select1">
                    <select>
                        <option value="">Select</option>
                        <option value="cse">Computer Science</option>
                        <option value="it">Information & Technology</option>
                        <option value="iee">Instrumentation & Electronics</option>
                        <option value="ee">Electrical</option>
                        <option value="me">Mechanical</option>
                        <option value="cv">Civil</option>
                        <option value="ft">Fashion & Technology</option>
                        <option value="tt">Textile</option>

                    </select>
                </div>
            </div>
            <div class="box1">
                <label>Year</label>
                <input type="text" class="box">
            </div>
            <div class="box1">
                <label>Domain</label>
                <div class="select1">
                    <select>
                        <option value="">Select</option>
                        <option value="hd">Hardware</option>
                        <option value="st">Software</option>
                        <option value="ds">Design</option>

                    </select>
                </div>

            </div>
            <div class="box1">
                <label>Password</label>
                <input type="password" name="password" class="box">
            </div>
            <div class="box1">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="box">
            </div>
            <div class="box1 terms">
                <label class="check">
                    <input type="checkbox">
                    <span class="mark"></span>
                </label>
                <p>Agreed to terms and conditions</p>
            </div>
            <div class="box1">
                <input type="submit" value="Submit" class="btn">
            </div>
            <p class="member">Already a member?
                <a href="#">Login</a>
            </p>
        </div>
        </form>

    </div>

</body>

</html>