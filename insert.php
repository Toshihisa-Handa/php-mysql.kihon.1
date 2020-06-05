<?php 
//issert.phpはmysqlに情報を追加するため記述をしている


//受信チェック(おまじない。入力の頭にこれをいれる)
if(
  !isset($_POST['name']) || $_POST['name'] == ''||
  !isset($_POST['email']) || $_POST['email'] == ''||
  !isset($_POST['naiyou']) || $_POST['naiyou'] == ''
){
 exit('ParamError');
};

//1.postデータ登録
 $name=$_POST['name'];
 $email=$_POST['email'];
 $naiyou=$_POST['naiyou'];


//2.DB接続します（エラー処理追加） DB接続の時はこれをそのまま使う
try {//tryとcatchでエラーを検出しているとひとまず覚える。ここはおまじない。
   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root','root');//この1行でDB接続してる。localhostの部分はサーバーにあげる時はさくらのIPアドレスをいれる。rootとはIDのことxampだと最初mysqlのIDにrootが設定されていてパスワードはなし。''はパスワード。xampでは最初パスワードがないため空文字にしている。さくらのサーバーにあげる時はさくらから送られたIDとパスワードに変更する。
   //→つまり:localhost, root, '', はさくらの内容にサーバーあげる時変更が必要！
   //MAMPはid:root, pass:rootだった！
} catch (PDOException $e){
  exit('DbConnectError:'.$e->getMessage());//エラーが出た時にこの行が表示される。
}



//3.データ登録SQL作成
//3-1: sql作る処理
$sql = 'INSERT INTO gs_an_table(id, name, email, naiyou,
indate)VALUES(NULL, :a1, :a2, :a3, sysdate())';//ここの:a1,:a2,:a3下の記述とリンクしている。idと日時はidがオートインクリメントで自動生成になっていることと、日時はsysdateで自動でpostされた時間を取るためここでの記述のみで項目3-2以降で記述不要となっている。


//3-2: sql文をstmtに渡す処理
$stmt = $pdo->prepare($sql); //上で定義した変数 ＄sqlをここで関数prepareへ渡している

//3-3: 関連付けをして、a1などが入っていれば3-1の同じ文字に紐付ける
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);//文字列の場合は左の様に書く。 Integer：数値の場合は(PDO::PARAM_INT)と書く
$stmt->bindValue(':a2', $email, PDO::PARAM_STR);
$stmt->bindValue(':a3', $naiyou, PDO::PARAM_STR);
// $stmt->bindValue(':a4', $test, PDO::PARAM_INT);←数値の場合はこの様に書く

//3-4: 最後に実行する
$status = $stmt->execute();//このexecuteで上で処理した内容を実行している


//4.データ登録処理後（基本コピペで動くと覚えればOK)
if($status == false){//エラーの時の処理
  $error =$stmt->errorInfo();
  exit('QueryError:'.error[2]);

}else{//エラーがなければこちらの処理が実行される
  //5. index.phpへリダイレクト
  header('Location: index.php');//処理が終わったら指定URLへ移動する(必ずindex.php出なくても良い）。Location:の「:」の後ろには必ず半角スペースをいれる
}exit;


?>