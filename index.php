<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<!-- <div><a href="select.php">データ一覧</a></div> -->
<div><a href="select.php">データ一覧</a></div>

<form action="insert.php" method='post'>
 <fieldset>
   <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name='name'></label><br>
     <label>Email：<input type="text" name='email'></label><br>
     <label>内容：<textarea name="naiyou" cols="40" rows="4"></textarea></label><br>
     <input type="submit" value='送信'>     
 </fieldset>
</form>  
</body>
</html>