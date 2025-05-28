<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($username === "" || $email === "" || $password === "") {
        echo "All fields are required.";
        exit;
    }
    $file = __DIR__ . "/users.txt";

    if (file_exists($file)) {
        $lines = file($file);
        foreach ($lines as $line) {
            list($user, $mail, $pass) = explode(" | ", trim($line));
            if ($user === $username || $mail === $email) {
                echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                  <meta charset='UTF-8' />
                  <meta name='viewport' content='width=device-width, initial-scale=1' />
                  <title>Signup Error</title>
                  <link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap' rel='stylesheet' />
                  <link rel='stylesheet' href='style.css' />
                </head>
                <body>
                  <div class='container' style='justify-content: center;'>
                    <div class='form-box'>
                      <h2>User or email already exists.</h2>
                      <a href='signup.html' class='btn' style='text-align:center; display:block; margin-top:1rem;'>Try Again</a>
                    </div>
                  </div>
                </body>
                </html>";
                exit;
            }
        }
    }

    $entry = "$username | $email | $password\n";
    file_put_contents("users.txt", $entry, FILE_APPEND);

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1' />
      <title>Signup Successful</title>
      <link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap' rel='stylesheet' />
      <link rel='stylesheet' href='style.css' />
    </head>
    <body>
      <div class='container' style='justify-content: center;'>
        <div class='form-box'>
          <h2>Signup successful!</h2>
          <a href='login.html' class='btn' style='text-align:center; display:block; margin-top:1rem;'>Login</a>
        </div>
      </div>
    </body>
    </html>";
} else {
    header("Location: signup.html");
    exit();
}
?>
