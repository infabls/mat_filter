<?php 
  session_start();

  if (!empty($_POST["m"])) {
    $_SESSION["m"] = clean_data($_POST["m"]);
    $m=$_SESSION["m"];
    header("Location: ".$_SERVER["REQUEST_URI"]);
    exit;
  }
 ?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Мат фильтр версия 0.1.0</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
	<div id="wrapper" class="container text-center ">
		<h1>Мат фильтр версия 0.1.0</h1>
	<form action="index.php" method="POST">
		<input type="text" name='m' required placeholder="Введи свой мат">
		<input type="submit">
	</form>
<div class="row justify-content-center"><?php if (isset($_SESSION["m"])) echo "<div class='bg-danger h2 text-light col-md-4 col-md-offset-6'>Ваше сообщение: ".$_SESSION["m"]. '</div><br>'; ?></div>


<?php 
include_once 'example.php';
reset($mat);
echo "Список имеющихся матов: <br>";
while (list($key, $val) = each($mat))
  {
  echo "$val, ";
  }
?>

	</div>
</body>
</html>


<?php 

function clean_data ($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = mat_filter($data);
	return $data;
}
function mat_filter($data){
	if (file_exists('example.php')) {
		include_once 'example.php'; 
		$data = str_replace($mat, "цензура", $data);
		return $data;
	} else echo "Нет словаря матов"; exit;
}

 ?>