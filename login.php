<?php
include_once("config.php");

checkLoggedIn("no");

$title="Страница авторизации";

if(isset($_POST["submit"])) {
  field_validator("login name", $_POST["login"], "alphanumeric", 4, 15);
  field_validator("password", $_POST["password"], "string", 4, 15);
  if($messages){
    doIndex();
    exit;
  }

    if( !($row = checkPass($_POST["login"], $_POST["password"])) ) {
        $messages[]="Incorrect login/password, try again";
    }

  if($messages){
    doIndex();
    exit;
  }

  cleanMemberSession($row["login"], $row["password"]);

  header("Location: index.html");
} else {
  doIndex();
}

function doIndex() {
  global $messages;
  global $title;
?>
<html>
<head>

<title><?php print $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h1><?php print $title; ?></h1>
<?php
if($messages) { displayErrors($messages); }
?>
<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="POST">
<table>
  <div class="login">
  <div class="login-triangle"></div>
  <form class="login-container">
<p><input type="login" placeholder="Логин" name="login"
value="<?php print isset($_POST["login"]) ? $_POST["login"] : "" ; ?>"
maxlength="15"></p>
<p><input type="password" placeholder="Пароль" name="password" value="" maxlength="15"></p>
<p><input type="submit" name="submit" value="Войти"></p>
<p><input type="button" onclick="location.href='join.php';" value="Вернуться на страницу регистрации" /></p>
  </form>

</table>
</form>
</body>
</html>
<?php
}
?>
