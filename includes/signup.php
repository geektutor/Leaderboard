<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/css/signup.css">
    <title>Leaderboard  - Sign Up</title>
</head>
<body>
    <div class="contact-us">
        <form id="login" action="#">
          <input placeholder="Name" required="" type="text" />
          <input name="email" placeholder="Email" type="email" />
          <input name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone" type="tel" />
          <button type="submit">SIGN UP</button><br><br>
          <p>Already a user ? <a href="login.php"> Login here </a></p>
        </form>
      </div>
      <script src="../public/js/jquery-2.2.3.min.js"></script>
</body>
</html>