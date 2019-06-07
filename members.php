<html>
<head>
<meta charset="UTF-8">
<title>members</title>
</head>
<body>

<form action="members_edit.php" method="post">
<div><input type="submit" value="メンバー編集"></div>
</form>

<table border='1'>
<tr><th>メンバーID</th><th>名前</th><th>性別</th><th>誕生日</th><th>身長</th></tr>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=data;charset=utf8', 
	'user', 'password');
	
foreach ($pdo->query('select * from member') as $row) {
?>
<tr>
<th><?php echo $row['id'] ?></th>
<th><?php echo $row['name'] ?></th>
<th><?php echo $row['sex'] ?></th>
<th><?php echo $row['dob'] ?></th>
<th><?php echo $row['height'] ?></th></tr>
<?php
}
?>

</table>
</body>
</html>