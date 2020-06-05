<?php
//updateはupdate_viewで修正した内容に更新させるための記述（insert.phpを修正して作る）

//1.POSTでid,name,email,naiyouを取得
$id         = $_POST["id"];
$name       = $_POST['name'];
$email       = $_POST['email'];
$naiyou     = $_POST['naiyou'];






//2. DB接続します(ここはselect.phpのまるコピ)
try {
  //localhostの時はこれ。さくらの場合さくらのデータベースをいれる
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {//$eにエラー内容が入っている。
  exit('DBConnectError:'.$e->getMessage());//ここのDBConnectErrorはエラー時の文字表示の為、ここはなんでも良い。この項目２は基本idとpass以外コピペで覚えればOK
}


//3.データ登録SQL作成
//3-1: sql更新する処理
$sql = 'UPDATE gs_an_table SET name=:name,email=:email,naiyou=:naiyou WHERE id=:id';

//3-2: sql文をstmtに渡す処理
$stmt = $pdo->prepare($sql); //上で定義した変数 ＄sqlをここで関数prepareへ渡している

//3-3: 関連付けをして、nameやemailを3-1の同じ文字に紐付ける(ここはinsert.phpから修正している)
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);//文字列の場合は左の様に書く。 Integer：数値の場合は(PDO::PARAM_INT)と書く
$stmt->bindValue(':email',  $email,  PDO::PARAM_STR);
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);

//3-4: 最後に実行する
$status = $stmt->execute();//このexecuteで上で処理した内容を実行している


//4.データ登録処理後（基本コピペで動くと覚えればOK)(ここはinsert.phpをコピペし修正している)
if($status == false){//エラーの時の処理
  $error =$stmt->errorInfo();
  exit('QueryError:'.error[2]);

}else{//エラーがなければこちらの処理が実行される
  //5. select.phpへリダイレクト
  header('Location: select.php');//処理が終わったら指定URLへ移動する(必ずindex.php出なくても良い）。Location:の「:」の後ろには必ず半角スペースをいれる
  exit;
  //このupdate.phpが表示されるのはエラーの時のみ。更新が順調に完了した場合select.phpへ移動する

}


?>
