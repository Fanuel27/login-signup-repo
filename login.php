<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = trim($_POST["username"]); // This could be username or email
    $password = trim($_POST["password"]);

    $found = false;

    if (file_exists("users.txt")) {
        $lines = file("users.txt");
        foreach ($lines as $line) {
            list($user, $email, $pass) = explode(" | ", trim($line));
            if (($user === $input || $email === $input) && $pass === $password) {
                $found = true;
                break;
            }
        }
    }

    if ($found) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
          <meta charset='UTF-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1' />
          <title>Login Success</title>
          <link rel='stylesheet' href='style.css' />
        </head>
        <body>
          <div class='container' style='justify-content:center;'>
            <div class='form-box'>
              <h2>Login successful!</h2>
              <p>Welcome, <strong>" . htmlspecialchars($input) . "</strong>.</p>
              <a href='login.html' class='btn' style='text-align:center; display:block; margin-top:1rem;'>Log out</a>
            </div>
          </div>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
          <meta charset='UTF-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1' />
          <title>Login Failed</title>
          <link rel='stylesheet' href='style.css' />
        </head>
        <body>
          <div class='container' style='justify-content:center;'>
            <div class='form-box'>
              <h2>Invalid username or password.</h2>
              <a href='login.html' class='btn' style='text-align:center; display:block; margin-top:1rem;'>Try Again</a>
            </div>
          </div>
        </body>
        </html>";
    }
} else {
    header("Location: login.html");
    exit();
}
?>
