<?php
$success = false;
$exist = false;
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $server = "localhost";
    $username = "root";
    $passworddb = "";
    $database = "users123";
    $con = mysqli_connect($server,$username,$passworddb,$database);

    $userid = $_POST["userid"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql0 = "SELECT * FROM `users_table` WHERE `userid` = '$userid'";
    $result0 = mysqli_query($con,$sql0);
    $num = mysqli_num_rows($result0);
    if($num == 1)
        $exist = true;
    else
        $exist = false;
    if($exist == false){
        $sql = "INSERT INTO `users_table` (`userid`, `email`, `password`) VALUES ('$userid', '$email', '$password')";
        $result = mysqli_query($con,$sql);
        if($result){
            $success = true;
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            setcookie("userid","$userid");
        }
    }
}
       
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>QuizAura/Signup</title>
        <link
      rel="shortcut icon"
      href="https://www.quiztriviagames.com/wp-content/uploads/2021/06/cropped-favicon-Quiz-trivia-games-1.png"
      type="image/x-icon"
    />
    <style>
           *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: radial-gradient(circle at 51% 93%,#39dafd,#1f8ffb 69%);
}
nav{
    background-color: rgb(82, 212, 251);
    display: flex;
    justify-content: space-between;
}
.head {
    display: flex;
}

nav div a{
    cursor: pointer;
}
nav ul{
    list-style: none;
    display: flex;
    margin: auto ;
    margin-right: 4rem;
}
nav ul li{
    
    padding: 1.5rem;
}
nav ul li a {
    text-decoration: none;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
}
nav ul li a:hover{
    color: blue;
    font-weight: bold;
}
.hamBurger{
    display: none;
}
.responsive .notHome{
    display: block;
}
@media screen and (max-width:700px){
    .hamBurger{
        display: inline;
        position: absolute;
        right: 0;
    }
    .notHome{
        display: none;
    }
    nav.responsive ul{
        display: flex;
        flex-direction: column;
    }    

}

h1{
    
    text-align: center;
    color: rgb(32, 97, 154);
    
    padding: 1.2rem;
    font-weight:700;
    font-size: 2rem;
}
#logo{
    height: 10vh;
}
#logoBox{
    margin-left: 2rem;
    margin-top:  2rem;
    display: flex;
    
}
.container{
    height: 88vh;
    width: 100vw;
    background-image: /*linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4))*/url(https://img.freepik.com/free-psd/gradient-abstract-borders_23-2150602085.jpg?w=1060&t=st=1697259532~exp=1697260132~hmac=4eb658cbe66fc66e3f208480cdcf069989d2b15d85fe4c734d71c5561cc34cf0);
    background-position: center;
    background-size: cover;
    position: absolute;
}
 /* @media (max-width:1162px){
    .form_box{
    width: 90vw ;
    height: 80vh;
 
    margin: 2% auto;
    background:#fff;
   
   display: flex;
   flex-direction: column;
    overflow: hidden;
    padding: 0.2rem;
    text-align: center;

}
.input_group{
    top: 10rem;
    position: relative;
    width: 95%;
    transition: .5s;
    padding-left: 0.5rem;
    text-align: center;
}
.input_field{
    width: 95%;
    padding: 1rem 2rem;
    margin: 1rem 0.4rem;
    border-left: 0;
    border-right: 0;
    border-top: 0;
    border-bottom: 1px solid black ;
    outline: none;
    background: transparent;
    display: block;
    font-size: 0.7rem;
    text-align: center;
}
#login{
    left: 1rem;

    
}
#signup{
    left: 30rem;
}
.button_box{
    width: 70%;
    margin: 2rem auto ;
    position: relative;
    display: flex;
    justify-content: space-around;
    overflow: hidden;
    box-shadow: 0 0 2rem 1.5rem #2a11eb1f ;
    border-radius: 2rem;

}
.toggle_button{
    padding:1.5rem 3rem ;
    cursor: pointer;
    background:transparent;
    border: 0;
    outline: none;
    position: relative;
}
#btn{
    top: 0;
    left: 0;
    position: absolute;
    width: 50%;
    height: 100%;
    background: linear-gradient(to right,#1c0da0,#7abceb);
    transition: .5s;
    border-radius: 2rem;


}
}  */
.form_box{
    width: 35vw ;
    height: 75vh;
    position: relative;
    margin: 2% auto;
    background:#fff;
   
    overflow: hidden;
    padding: 0.4rem;
}
.button_box{
    width: 70%;
    margin: 2rem auto ;
    position: relative;
    display: flex;
    justify-content: space-around;
    overflow: hidden;
    box-shadow: 0 0 2rem 1.5rem #2a11eb1f ;
    border-radius: 2rem;

}
.toggle_button{
    padding:1.5rem 3rem ;
    cursor: pointer;
    background:transparent;
    border: 0;
    outline: none;
    position: relative;
}
#btn{
    top: 0;
    left: 0;
    position: absolute;
    width: 50%;
    height: 100%;
    background: linear-gradient(to right,#1c0da0,#7abceb);
    transition: .5s;
    border-radius: 2rem;

}
.social_icon{
    margin: 1rem auto;
    text-align: center;

}
.social_icon img{
    width: 7rem;
    height: 5rem;
    box-shadow: 0 0 2rem 0 #39dafd;
    cursor: pointer;

}
.input_group{
    top: 15rem;
    position: absolute;
    width: 70%;
    transition: .5s;
    padding-left: 4rem;
    text-align: center;
}
.input_field{
    width: 80%;
    padding: 1rem 2rem;
    margin: 1rem 0.4rem;
    border-left: 0;
    border-right: 0;
    border-top: 0;
    border-bottom: 1px solid black ;
    outline: none;
    background: transparent;
    display: block;
    font-size: 1rem;
    text-align: center;
}
.submit_btn{
    width: 85%;
    margin-top: 0.5rem;
    padding: 1rem 2rem;
    cursor: pointer;
    display: block;
    background: linear-gradient(to right,#1c0da0,#7abceb);
    outline: none;
    border-radius: 2rem;
}
.check_box{
    margin: 1.5rem 1rem 1rem 0;
}
span{
    font-size: 1rem;
    
}
#login{
    left: 5rem;

    
}
#signup{
    left: 38rem;
}

@media screen and (max-width:1034px){
    #login{
    left: 3rem;
    width: 90%;

    
}
#signup{
    left: 38rem;
    width: 90%;
    overflow: hidden;
}
.input_group{
    top: 15rem;
    position: absolute;
    width: 90%;
    height: 90%;
    transition: .5s;
    padding-left: 1rem;
    text-align: center;
}
.form_box{
    width: 70%;
    height: 90%;
    position: relative;
    margin: 2% auto;
    background:#fff;
   
    overflow: hidden;
    padding: 0.4rem;
}
}

@media screen and (max-width:660px){
    #login{
    left: 3rem;
    width: 90%;



    
}
#signup{
    left: 38rem;
    width: 90%;
    overflow: hidden;
}
.form_box{
    width: 70%;
    height: 90%;
    position: relative;
    margin: 2% auto;
    background:#fff;
   
    overflow: hidden;
    padding: 0.4rem;
}
.input_group{
    top: 15rem;
    position: absolute;
    width: 90%;
    height: 80%;
    transition: .5s;
    padding-left: 0.1rem;
    text-align: center;
}
.toggle_button{
    padding:1rem 2rem ;
    cursor: pointer;
    background:transparent;
    border: 0;
    outline: none;
    position: relative;
}
}

    .successmessage{
        padding: 4px;
        color:green;
        text-align: center;
        font-weight: bolder;
        font-size: 20px;
        background-color: rgb(183, 212, 226);
    }
    .errormessage{
    padding: 4px;
    color:red;
    text-align: center;
    font-weight: bolder;
    font-size: 20px;
    background-color: rgb(183, 212, 226);
    }   
    </style>
    </head>
<body>
    <nav id="navBar" >
        <div class="head">
        <a href="home.php"><img id="logo" src="logo.png" alt="logo" /></a>
            <!-- <h1 >QuizAura</h1> -->
        </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li class="notHome"><a href="contactUs.html">Contact Us</a></li>
            <li class="notHome"><a href="signup.php">Login</a></li>
            <li class="notHome"><a href="help.html">Help</a></li>
            <li class="hamBurger"><a href="javascript:void(0)" onclick="toggleNav()">&#9776;</a></li>
        </ul>
    </nav>
    <main class="container">
        <div class="form_box">
            <div class="button_box">
                <div id="btn"> </div>
                <button type="button" class="toggle_button" onclick="login()" id="login_btn">
                    Log in
                </button>
                <button type="button" class="toggle_button" onclick="signup()" id="signup_btn">
                    Sign Up
                </button>
            </div>
            <div class="social_icon">
                <img src="logo2.png" alt="">
            </div>
            <form id="login" class="input_group" action = 'login.php' method = 'post'>
                <input type="text" class="input_field" placeholder="User Id" required  name='userid'>
                <input type="password" class="input_field" placeholder="Enter Password" required name='password'>
                <input type="checkbox" class="check_box" ><span>Remember Password</span>
                <button type="submit" class="submit_btn">Log in</button>
            </form>
            <form id="signup" class="input_group" action = 'signup.php' method = 'post'>
                <input type="text" class="input_field" placeholder="User Id" required name="userid">
                <input type="email" class="input_field" placeholder="Email Id" required name="email">
                <input type="password" class="input_field" placeholder="Enter Password" name="password">
                <input type="checkbox" class="check_box" required><span>I agree to the terms & condition</span>
                <button type="submit" class="submit_btn">Sign Up</button>
            </form>
        </div>
    <div class="successdiv">
        <?php
        if($success){
            echo "<p class='successmessage'>Signed in Successfully</p>";
        }
        if($exist){
            echo "<p class='errormessage'>User name allrerady taken.Try new one</p>";
        }
        ?>
    </div>   
    </main>
    <script>
        function toggleNav(){
    let navBar = document.getElementById('navBar');

    if(navBar.className === '')
        navBar.className = 'responsive';
    else
        navBar.className = '';
}

const loginButton = document.getElementById('login_btn');
        const signupButton = document.getElementById('signup_btn');
        const toggleButton = document.getElementById('btn');
        const loginForm = document.getElementById('login');
        const signupForm = document.getElementById('signup');

        function login() {
            loginForm.style.left = '5%';
            signupForm.style.left = '91%';
            toggleButton.style.left = '0';
        }

        function signup() {
            loginForm.style.left = '-70%';
            signupForm.style.left = '12%';
            toggleButton.style.left = '50%';
        }

    </script>
</body>
</html>