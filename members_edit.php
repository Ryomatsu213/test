<html>
<head>
<meta charset="UTF-8">
<title>members_edit</title>
</head>
<body>

<form action="members.php" method="post">
<div><input type="submit" value="一覧に戻る"></div>
</form>

<form action="members_add.php" method="post">
<div><input type="submit" value="メンバー追加"></div>
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
?>

<table border='1'>
<tr><th>メンバーID</th><th>名前</th><th>性別</th><th>誕生日</th><th>身長</th></tr>
</table>


<?php

foreach ($pdo->query('select * from member') as $row) {
	echo '<form action="members_edit.php" method="post">';
	echo '<input type="hidden" name="command" value="update">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo $row['id'];	
	echo '<input type="text" name="name" value="', $row['name'], '">';		
	echo '<input type="text" name="sex" value="', $row['sex'], '">';	
	echo '<input type="text" name="dob" value="', $row['dob'], '">';	
	echo '<input type="text" name="height" value="', $row['height'], '">';	
	echo '<input type="submit" value="更新">';
	echo '</form> ';
	
	echo '<form action="members_edit.php" method="post">';
	echo '<input type="hidden" name="command" value="delete">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="submit" value="削除">';
	echo '</form>';

}
?>

</body>
</html>
