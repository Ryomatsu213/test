<html>
<head>
<meta charset="UTF-8">
<title>members_add</title>
</head>
<body>

<form action="members_edit.php" method="post">
<div><input type="submit" value="戻る"></div>
</form>

<form action="members_edit.php" method="post">
<input type="hidden" name="command" value="insert">
<div>名前 <input type="text" name="name"></div>
<div>性別<input type="radio" name="sex" value="男">男
<input type="radio" name="sex" value="女">女
<input type="radio" name="sex" value="答えない">答えない</div>
<div>誕生日 <input type="text" name="dob"></div>
<div>身長 <input type="text" name="height"></div>
<div><input type="submit" value="追加"></div>
</form>

</body>
</html>