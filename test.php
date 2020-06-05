
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<form method='post'>
    あなたは学生ですか?<br>
    <input type="radio" name="student" value="学生です">はい
    <input type="radio" name="student" value="学生ではありません">いいえ
    <br>
    <input type="submit">
</form>
<?php
    $value = $_POST['student'];
    if ($value) {
        echo "私は". $value;
    }
?>



</body>
</html>
