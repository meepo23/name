<?php
include_once("config.php");

checkLoggedIn("no");

$title="Регистрация";

if(isset($_POST["submit"])){
  field_validator("login name", $_POST["login"], "alphanumeric", 4, 15);
  field_validator("password", $_POST["password"], "string", 4, 15);
  field_validator("confirmation password", $_POST["password2"], "string", 4, 15);

  if(strcmp($_POST["password"], $_POST["password2"])) {

    $messages[]="Ваши пароли не совпадают";
  }
 
  $query="SELECT login FROM users WHERE login='".$_POST["login"]."'";

  $result=mysql_query($query, $link) or die("MySQL query $query failed.  Error if any: ".mysql_error());

  if( ($row=mysql_fetch_array($result)) ){
    $messages[]="Логин \"".$_POST["login"]."\" уже занят, попробуйте другой.";
  }

  if(empty($messages)) {
    newUser($_POST["login"], $_POST["password"]);

    cleanMemberSession($_POST["login"], $_POST["password"]);

    header("Location: index.html");

  }
}
?>
<html>
<head>
  <html>
<head>
<title><?php print $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8">
<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
<h1><?php print $title; ?></h1>
<?php
if(!empty($messages)){
  displayErrors($messages);
}
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
<p><input type="password2" placeholder="Подтвердите пароль" name="password2" value="" maxlength="15"></p>
<p><input type="submit" name="submit" value="Войти"></p>
<p><input type="button" onclick="location.href='login.php';" value="Уже есть аккаунт?" /></p>
 </form>
</table>
</form>
</body>
</html>

