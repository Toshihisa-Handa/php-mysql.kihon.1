<?php
//u_view.phpはselect.phpで表示したtableの登録一覧からリンクで行ける個別のデータの登録情報を表示するページ
//このファイルで表示したデータを変更したらupdate.phpへ遷移する様コードをかく


//1.getでidを取得
$id = $_GET['id'];
// echo $id;
// exit;


//2. DB接続します (ここコピペでOK。select.phpの時と記載同じ)
try {
  //localhostの時はこれ。さくらの場合さくらのデータベースをいれる
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {//$eにエラー内容が入っている。
  exit('DBConnectError:'.$e->getMessage());//ここのDBConnectErrorはエラー時の文字表示の為、ここはなんでも良い。この項目２は基本idとpass以外コピペで覚えればOK
}


//3．SELECT * FROM gs_an_table WHERE id=:id;
//データ登録SQL作成
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$sql = "SELECT* FROM gs_an_table WHERE id=:id";//(ここはselect.phpにない記述)
$stmt = $pdo->prepare($sql);
$stmt->bindValue('id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//4．データ表示
$view='';
if($status==false){
  //execute SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);//エラーが起きたらエラーの2番目の配列から取ります。ここは考えず、これを使えばOK
                             // SQLEErrorの部分はエラー時出てくる文なのでなんでもOK
}else{
 //1データのみ抽出の場合はwhileループで取り出さない
 $row = $stmt->fetch();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form action="update.php" method='post'>
 <fieldset>
   <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name='name' value="<?=$row["name"]?>"></label><br>
     <label>Email：<input type="text" name='email' value='<?=$row["email"]?>'></label><br>
     <label>内容：<textarea name="naiyou" cols="40" rows="4" ><?=$row["naiyou"]?></textarea></label><br>
     <input type="hidden" name='id' value="<?=$row["id"]?>"> 
     <input type="submit" value='送信'> 

 </fieldset>
</form>  
</body>
</html>