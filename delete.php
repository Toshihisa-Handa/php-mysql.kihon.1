<?php
//記述のベースはupdate.phpをコピペで作成


//1.GETでidを取得（この項目はコピペから修正する）
$id   = $_GET["id"];


//2. DB接続します(ここはupdate.phpのまるコピ)
try {
  //localhostの時はこれ。さくらの場合さくらのデータベースをいれる
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {//$eにエラー内容が入っている。
  exit('データベースに接続できませんでした'.$e->getMessage());//ここのDBConnectErrorはエラー時の文字表示の為、ここはなんでも良い。この項目２は基本idとpass以外コピペで覚えればOK
}


//3.データ登録SQL作成
//3-1: sql消す処理
//基本の書き方：DELETE FROM テーブル名;
$sql = 'DELETE FROM gs_an_table WHERE id =:id';//削除の時はid指定でOK

//3-2: sql文をstmtに渡す処理
$stmt = $pdo->prepare($sql); //上で定義した変数 ＄sqlをここで関数prepareへ渡している

//3-3: 関連付けをして、idを3-1の同じ文字に紐付ける
$stmt->bindValue(':id', $id, PDO::PARAM_INT);//ここの：idは3-1の:idと同じ

//3-4: 最後に実行する
$status = $stmt->execute();//このexecuteで上で処理した内容を実行している


//4.データ登録処理後（基本コピペで動くと覚えればOK)今回はelse以下の遷移先URLのみselect.phpとしておけばOK
if($status == false){//エラーの時の処理
  $error =$stmt->errorInfo();
  exit('QueryError:'.error[2]);
//項目4はここより上は修正不要↑

}else{//エラーがなければこちらの処理が実行される
  //5. select.phpへリダイレクト
  header('Location: select.php');//処理が終わったら指定URLへ移動する(必ずindex.php出なくても良い）。Location:の「:」の後ろには必ず半角スペースをいれる
  exit;
  //このdelete.phpが表示されるのはエラーの時のみ。更新が順調に完了した場合select.phpへ移動する

}


?>
