<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizAura/Scores</title>
    <link
      rel="shortcut icon"
      href="https://www.quiztriviagames.com/wp-content/uploads/2021/06/cropped-favicon-Quiz-trivia-games-1.png"
      type="image/x-icon"
    />
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: radial-gradient(circle at 51% 93%, #39dafd, #1f8ffb 69%);
            background-image: url('https://img.freepik.com/free-vector/blue-shapes-background-abstract-design_23-2148276793.jpg?w=1060&t=st=1699860129~exp=1699860729~hmac=6c4ef7a0b5ed97eeb42f1c325ef2e8f4e42304fa5b08f791972112a38f7aa2fd');
            background-size: cover;
            background-repeat: no-repeat;
        }

        nav {
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

        nav ul {
            list-style: none;
            display: flex;
            margin: auto;
            margin-right: 4rem;
        }

        nav ul li {

            padding: 1.5rem;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }

        nav ul li a:hover {
            color: blue;
            font-weight: bold;
        }

        .hamBurger {
            display: none;
        }

        .responsive .notHome {
            display: block;
        }

        @media screen and (max-width:700px) {
            .hamBurger {
                display: inline;
                position: absolute;
                right: 0;
            }

            .notHome {
                display: none;
            }

            nav.responsive ul {
                display: flex;
                flex-direction: column;
            }
        }

        #logo {
            height: 10vh;
        }

        h1 {
            text-align: center;
            color: rgb(32, 97, 154);
            padding: 1.2rem;
            font-weight: 700;
            font-size: 2rem;
        }

        main {
            display: flex;
            justify-content: space-between;
        }

        .scoreimg {
            height: 88vh;
            width: 42vw;
        }
        section{
            margin-right: 2rem;
        }
        .sechead {
            color: white;
        }

        table {
            color: azure;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #415a77;
        }

        th {
            background-color: #1f4068;
            color: #64a1f4;
        }
        tr{
            background-color: #2a3b4b;
        }
        @media screen and (max-width:1220px){
            table{
                font-size: 1.3rem;
            }
        }
        @media screen and (max-width:1100px){
            table{
                font-size: 1.1rem;
            }
        }
        @media screen and (max-width:950px){
            table{
                font-size: 1rem;
            }
        }
        @media screen and (max-width:900px){
            .scoreimg {
                width: 30vw;
            }
        }
        @media screen and (max-width:530px){
            main{
                flex-direction: column;
            }
            .scoreimg {
                width: 100vw;
                height: auto;
            }
        }
        @media screen and (max-width:360px){
            .scoreimg {
                display: none;
            }
            table{
                font-size: 0.8rem;
            }
        }
        h2{
            color: azure;
        }
    </style>
</head>

<body>
    <nav id="navBar">
        <div class="head">
        <a href="home.php"><img id="logo" src="logo.png" alt="logo" /></a>
            <!-- <h1>QuizAura</h1> -->
        </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li class="notHome"><a href="subject.html">Quizes</a></li>
            <li class="notHome"><a href="contactUs.html">Contact Us</a></li>
            <li class="notHome"><a href="signup.php">Login</a></li>
            <li class="notHome"><a href="help.html">Help</a></li>
            <li class="hamBurger"><a href="javascript:void(0)" onclick="toggleNav()">&#9776;</a></li>
        </ul>
    </nav>
    <main>
        <aside>
            <img src="https://img.freepik.com/free-vector/gradient-video-game-health-bar-element_23-2150328436.jpg?w=740&t=st=1699860485~exp=1699861085~hmac=7d5bf4bc2b2e47c1ab879d9cd6eaa5621dc57e7cfa5beb0a912a382a91ceea7e"
                alt="" class="scoreimg">
        </aside>
        <section>
            <h1 class="sechead">My Quiz Scores</h1>
            <?php
                // Step 1: Establish a connection to the MySQL database
                $servername = "localhost"; // Replace with your server name
                $username = "root"; // Replace with your username
                $password = ""; // Replace with your password
                $database = "users123"; // Replace with your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Step 2: Fetch data from the database
                $sql = "SELECT * FROM scorecard WHERE `userid` = '" . $_COOKIE['userid'] . "'";
                $result = $conn->query($sql);

                // Step 3: Display the data as a table
                if ($result->num_rows > 0) {
                    echo "<table>
                    <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>TotalQuestion</th>
                        <th>Correct Answers</th>
                        <th>Score</th>
                    </tr>
                    </thead>
                    <tbody>";
                
                    // Step 4: Iterate through the fetched data
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["subject"] . "</td>";
                        echo "<td>5</td>";
                        echo "<td>" . ($row["score"]/20) . "</td>";
                        echo "<td>" . $row["score"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<h2>Attend a quiz first.</h2>";
                }

                // Close the connection
                $conn->close();
            ?>
            <!-- <table>
                <thead>
                  <tr>
                    <th>Quiz Title</th>
                    <th>TotalQuestion</th>
                    <th>Correct Answers</th>
                    <th>Score</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>General Knowledge</td>
                    <td>5</td>
                    <td>4</td>
                    <td>80</td>
                  </tr>
                </tbody>
              </table> -->
        </section>
    </main>
    <script>
        function toggleNav(){
            let navBar = document.getElementById('navBar');

            if(navBar.className === '')
                navBar.className = 'responsive';
            else
                navBar.className = '';
        }
    </script>
</body>
</html>