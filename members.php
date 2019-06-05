<html>
<head>
<meta charset="UTF-8">
<title>members</title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="th0">メンバーID</div>


<form action="members.php" method="post">
<input type="hidden" name="command" value="insert">
<div class="td0"></div>
<div class="td1">名前 <input type="text" name="name"></div>
<div class="td1">性別<input type="radio" name="sex" value="男">男
						<input type="radio" name="sex" value="女">女
						<input type="radio" name="sex" value="答えない">答えない</div>
<div class="td1">誕生日 <input type="text" name="dob"></div>
<div class="td1">身長 <input type="text" name="height"></div>
<div class="td2"><input type="submit" value="追加"></div>
</form>


<?php
$pdo=new PDO('mysql:host=localhost;dbname=data;charset=utf8', 
	'user', 'password');
if (isset($_REQUEST['command'])) {
	switch ($_REQUEST['command']) {
	case 'insert':
		if (empty($_REQUEST['name'])) break;
		$sql=$pdo->prepare('insert into member values(null,?,?,?,?)');
		$sql->execute(
			[htmlspecialchars($_REQUEST['name']), $_POST['sex']
			, $_REQUEST['dob'], $_REQUEST['height']]
			);
		break;
	case 'update':
		if (empty($_REQUEST['name'])) break;
		$sql=$pdo->prepare(
			'update member set name=?, sex=?, dob=?, height=? where id=?');
		$sql->execute(
			[htmlspecialchars($_REQUEST['name']), $_REQUEST['sex'],
			$_REQUEST['dob'], $_REQUEST['height'],
			$_REQUEST['id']]);
		break;
	case 'delete':
		$sql=$pdo->prepare('delete from member where id=?');
		$sql->execute([$_REQUEST['id']]);
		break;
	}
}
foreach ($pdo->query('select * from member') as $row) {
	echo '<form class="ib" action="members.php" method="post">';
	echo '<input type="hidden" name="command" value="update">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<div class="td0">';
	echo $row['id'];
	echo '</div> ';
	echo '<div class="td1">';
	echo '<input type="text" name="name" value="', $row['name'], '">';
	echo '</div> ';
	echo '<div class="td1">';
	
	echo '<input type="text" name="sex" value="', $row['sex'], '">';
	echo '</div> ';
	echo '<div class="td2">';
	echo '<input type="text" name="dob" value="', $row['dob'], '">';
	echo '</div> ';
	echo '<div class="td2">';
	echo '<input type="text" name="height" value="', $row['height'], '">';
	echo '</div> ';
	echo '<div class="td2">';
	
	echo '<input type="submit" value="更新">';
	//echo '</div> ';
	echo '</form> ';
	echo '<form class="ib" action="members.php" method="post">';
	echo '<input type="hidden" name="command" value="delete">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="submit" value="削除">';
	echo '</form>';
	echo "\n";
}
?>




</body>
</html>
