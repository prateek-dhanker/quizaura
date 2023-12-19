<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("location: signup.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="stylequiz.css" />
    <title>QuizAura/Quiz</title>
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
        transition: 0.1s ease all;
      }

      body {
        background-color: radial-gradient(
          circle at 51% 93%,
          #39dafd,
          #1f8ffb 69%
        );
        background-image: url("https://img.freepik.com/free-psd/gradient-abstract-borders_23-2150602085.jpg?w=1060&t=st=1697259532~exp=1697260132~hmac=4eb658cbe66fc66e3f208480cdcf069989d2b15d85fe4c734d71c5561cc34cf0");
        background-size: cover;
        font-family: Arial, sans-serif;
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

      @media screen and (max-width: 700px) {
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

      /* quiz------  */

      /* Desktop layout */
      .quiz-container {
        max-width: 600px;
        margin: 10px auto;
        padding: 20px;
        border: 1px solid #8c8c8c;
        border-radius: 5px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      }

      /* Phone layout */
      @media screen and (max-width: 600px) {
        .quiz-container {
          max-width: 90%;
          padding: 10px;
        }

        .options li {
          padding: 8px;
        }

        #submit-button {
          margin-top: 15px;
          padding: 8px 15px;
          font-size: 14px;
        }
      }

      .question {
        font-size: 18px;
        font-weight: bold;
      }

      .options {
        list-style-type: none;
        padding: 0;
      }

      .options li {
        margin: 10px 0;
        cursor: pointer;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
      }

      .options li:hover {
        background-color: #f2f2f2;
      }

      .option-label {
        display: inline-block;
        width: 30px;
        font-weight: bold;
      }

      .option-input {
        display: none;
      }

      #submit-button {
        margin-top: 5px;
        background-color: #2f5eff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
      }

      .selected {
        background-color: #72a5ee !important;
      }

      .result-label {
        margin-top: 10px;
        font-weight: bold;
      }

      .correct {
        color: #008000;
      }

      .incorrect {
        color: #ff0000;
      }

      .qno {
        margin: 0px;
        font-size: 13px;
        margin-bottom: 3px;
      }

      #frame h1 {
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
      }

      .sub {
        margin-bottom: 4px;
        text-align: center;
      }

      #progress-window {
        position: fixed;
        top: 114px;
        right: 0;
        width: 150px;
        height: 150px;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 0px 0px 10px 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        text-align: center;
      }
      #pw {
        z-index: 2;
        position: fixed;
        top: 84px;
        right: 0;
        width: 150px;
        height: 30px;
        padding: 8px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px 10px 0px 0px;
        text-align: center;
      }
      #progress-meter {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient( #37ade0 0%, #39c3ff var(--percentage), #f2f2f2 var(--percentage), #f2f2f2 100% );
        transition: all 0.5s ease;
      }

      #progress-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
        font-weight: bold;
        color: #333;
        transition: color 0.5s ease; /* Add transition for the text color change */
      }
      #myModal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        height: 70%;
        width: 70%;
        z-index: 10;
        top: 15%;
        left: 15%;
        background-image: url('https://img.freepik.com/free-vector/realistic-golden-confetti-background_52683-26885.jpg?w=1800&t=st=1700126733~exp=1700127333~hmac=d96cdba910fcd667d988d33ad566e601b3bc39280bd6a56be369c31eba16fead ');
        border: 2px double black;
        border-radius: 10px;
      }
      .close {
        font-size: larger;
        font-weight: bolder;
        float: right;
        padding: 10px;
        cursor: pointer;
        transition: 0.3s ease all;
      }
      #totalMarksContent1 {
        font-size: 35px;
        font-weight: bold;
        text-align: center;
        margin: auto;
      }
      #totalMarksContent {
        font-size: 50px;
        font-weight: bold;
        text-align: center;
        margin: auto;
        padding: 20px;
      }
    </style>
  </head>

  <body>
    <nav id="navBar">
      <div class="head">
      <a href="home.php"><img id="logo" src="logo.png" alt="logo" /></a>
            <!-- <h1 >QuizAura</h1> -->
      </div>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li class="notHome"><a href="subject.html">Quizes</a></li>
        <li class="notHome"><a href="contactUs.html">Contact Us</a></li>
        <li class="notHome"><a href="signup.php">Login</a></li>
        <li class="notHome"><a href="help.html">Help</a></li>
        <li class="hamBurger">
          <a href="javascript:void(0)" onclick="toggleNav()">&#9776;</a>
        </li>
      </ul>
    </nav>

    <div id="frame">
    <h1>
    <?php
    echo "Welcome ".$_COOKIE['userid'];
    ?>
    </h1>
    <div class="sub" style="font-size: 19px">Subject - Artificial Intelligence</div>
    </div>

    <div id="pw">
      <b>Progress Meter</b>
    </div>
    <div id="progress-window">
      <div id="progress-meter"></div>
      <div id="progress-text">0%</div>
    </div>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">X</span>
        <p id="totalMarksContent1">Congratulations for completing the Quiz</p>
        <p id="totalMarksContent"></p>
      </div>
    </div>

    <script>
      //total marks

      function showTotalMarks() {
        const totalCorrectAnswers = quizSubmitted.reduce(
          (total, submitted, index) => {
            if (submitted) {
              const selectedAnswer = document.querySelector(
                `#quiz-${index + 1} input[name="answer${index + 1}"]:checked`
              );
              const correctAnswer = getCorrectAnswer(index + 1);
              if (selectedAnswer && selectedAnswer.value === correctAnswer) {
                return total + 1;
              }
            }
            return total;
          },
          0
        );

        const totalMarks = totalCorrectAnswers * 20; // Assuming each question carries 20 marks
        const subName = xmlDoc.querySelector('quiz').getAttribute('subName');

        fetch('insert.php?action=insert_score', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `subName=${subName}&score=${totalMarks}`,
          })
            .then(response => response.text())
            .then(data => {
              // Handle the response from the PHP file
              console.log(data);
            })
            .catch(error => {
              console.error('Error:', error);
            });
        const totalMarksContent = document.getElementById("totalMarksContent");
        totalMarksContent.textContent = `Total Marks: ${totalMarks} / 100`;
        const modal = document.getElementById("myModal");
        modal.style.display = "block";
      }
      function closeModal() {
        const modal = document.getElementById("myModal");
        modal.style.display = "none";
      }

      //meter  -------------

      const totalQuestions = 5;
      let questionsAttempted = 0;

      function updateProgressWindow() {
        const progressMeter = document.getElementById("progress-meter");
        const progressText = document.getElementById("progress-text");

        const percentage = (questionsAttempted / totalQuestions) * 100;
        progressMeter.style.setProperty("--percentage", `${percentage}%`);
        progressText.textContent = `${questionsAttempted} / ${totalQuestions}`;
      }

      // Add an array to track whether each question has been submitted
      let quizSubmitted = [];

      function selectOption(questionNumber, option) {
        if (!quizSubmitted[questionNumber - 1]) {
          const options = document.querySelectorAll(
            `#quiz-${questionNumber} .options li`
          );
          options.forEach((opt) => {
            opt.classList.remove("selected");
          });

          const selectedOption = document.querySelector(
            `#quiz-${questionNumber} input[value="${option}"]`
          );
          if (selectedOption) {
            selectedOption.checked = true;
            selectedOption.parentElement.parentElement.classList.add(
              "selected"
            );
          }
        }
      }

      function checkAnswer(questionNumber) {
        if (!quizSubmitted[questionNumber - 1]) {
          const selectedAnswer = document.querySelector(
            `#quiz-${questionNumber} input[name="answer${questionNumber}"]:checked`
          );
          const resultLabel = document.getElementById(
            `result-label${questionNumber}`
          );
          const options = document.querySelectorAll(
            `#quiz-${questionNumber} .options li`
          );
          const submitButton = document.getElementById("submit-button");

          questionsAttempted++;
          updateProgressWindow();

          if (questionsAttempted === totalQuestions) {
            showTotalMarks();
          }

          if (selectedAnswer) {
            const userAnswer = selectedAnswer.value;
            const correctAnswer = getCorrectAnswer(questionNumber);

            if (userAnswer === correctAnswer) {
              resultLabel.textContent = `Correct! ${correctAnswer} is the correct answer.`;
              resultLabel.classList.remove("correct", "incorrect");
              resultLabel.classList.add("correct");
            } else {
              resultLabel.textContent = `Incorrect. The correct answer is ${correctAnswer}.`;
              resultLabel.classList.remove("correct", "incorrect");
              resultLabel.classList.add("incorrect");
            }

            // Disable options and the submit button after submission for the current question
            options.forEach((opt) => {
              opt.classList.add("disabled");
            });
            submitButton.disabled = true;

            // Update the quizSubmitted array for the current question
            quizSubmitted[questionNumber - 1] = true;
          } else {
            resultLabel.textContent = "Please select an answer.";
            resultLabel.classList.remove("correct", "incorrect");
          }
          if (questionsAttempted === totalQuestions) {
            showTotalMarks();
          }
        }
      }

      // Rest of your code...

    function getCorrectAnswer(questionNumber) {
        // Select the correct option from the XML data
        const correctOption = xmlDoc.querySelector(`question:nth-child(${questionNumber}) option[correct="true"]`);

        // Return the value of the correct option (e.g., "a", "b", "c", etc.)
        return correctOption.getAttribute("alpha");
    }

      const xmlString = `
      <quiz subName="Artificial Intelligence">
    <question text="What is the primary goal of Artificial Intelligence?">
        <option alpha="a" text="To develop intelligent robots" correct="false" />
        <option alpha="b" text="To mimic human behavior in machines" correct="false" />
        <option alpha="c" text="To create systems that can perform tasks that would normally require human intelligence" correct="true" />
        <option alpha="d" text="To automate routine tasks in daily life" correct="false" />
    </question>
    <question text="What is the Turing Test in the context of AI?">
        <option alpha="a" text="A test to evaluate the speed of an AI system" correct="false" />
        <option alpha="b" text="A test to measure the memory capacity of an AI system" correct="false" />
        <option alpha="c" text="A test to determine if a machine can exhibit intelligent behavior indistinguishable from that of a human" correct="true" />
        <option alpha="d" text="A test to assess the creativity of an AI system" correct="false" />
    </question>
    <question text="What is machine learning in the context of AI?">
        <option alpha="a" text="A system that can understand and interpret human languages" correct="false" />
        <option alpha="b" text="A type of AI that focuses on mimicking human emotions" correct="false" />
        <option alpha="c" text="A subset of AI that involves the development of algorithms allowing machines to learn patterns from data" correct="true" />
        <option alpha="d" text="A type of AI that can understand visual information" correct="false" />
    </question>
    <question text="What is natural language processing (NLP) in AI?">
        <option alpha="a" text="A system that can understand and interpret human languages" correct="true" />
        <option alpha="b" text="A type of AI that focuses on mimicking human emotions" correct="false" />
        <option alpha="c" text="A subset of AI that involves the development of algorithms allowing machines to learn patterns from data" correct="false" />
        <option alpha="d" text="A type of AI that can understand visual information" correct="false" />
    </question>
    <question text="What is the difference between narrow AI and general AI?">
        <option alpha="a" text="Narrow AI is focused on specific tasks, while general AI can perform any intellectual task that a human can" correct="true" />
        <option alpha="b" text="Narrow AI and general AI are synonymous terms" correct="false" />
        <option alpha="c" text="General AI is focused on specific tasks, while narrow AI can perform any intellectual task that a human can" correct="false" />
        <option alpha="d" text="Narrow AI and general AI both refer to the same level of AI capabilities" correct="false" />
    </question>
</quiz>



        `;
      // Fetch and parse XML file
      const parser = new DOMParser();
      const xmlDoc = parser.parseFromString(xmlString, "text/xml");
      const questions = xmlDoc.querySelectorAll("question");

      questions.forEach((question, index) => {
        const questionNumber = index + 1;
        const questionText = question.getAttribute("text");
        const options = question.querySelectorAll("option");

        const quizContainer = document.createElement("div");
        quizContainer.className = "quiz-container";
        quizContainer.id = `quiz-${questionNumber}`;

        const questionElement = document.createElement("div");
        questionElement.className = "question";
        questionElement.innerHTML = `<p class="qno">Question ${questionNumber}</p>${questionText}`;

        const optionsList = document.createElement("ul");
        optionsList.className = "options";
        options.forEach((option, optionIndex) => {
          const optionText = option.getAttribute("text");
          const optionLetter = String.fromCharCode(97 + optionIndex);
          const optionElement = document.createElement("li");
          optionElement.innerHTML = `<label class="option-label"><input type="radio" name="answer${questionNumber}" value="${optionLetter}" class="option-input" />${optionLetter}</label>${optionText}`;
          optionElement.onclick = () =>
            selectOption(questionNumber, optionLetter);
          optionsList.appendChild(optionElement);
        });

        const submitButton = document.createElement("button");
        submitButton.id = "submit-button";
        submitButton.textContent = "Submit";
        submitButton.onclick = () => checkAnswer(questionNumber);

        const resultLabel = document.createElement("div");
        resultLabel.className = "result-label";
        resultLabel.id = `result-label${questionNumber}`;

        quizContainer.appendChild(questionElement);
        quizContainer.appendChild(optionsList);
        quizContainer.appendChild(submitButton);
        quizContainer.appendChild(resultLabel);

        document.getElementById("frame").appendChild(quizContainer);
      });
    </script>
  </body>
</html>