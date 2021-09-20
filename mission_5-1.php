<!DOCHTYPE html>
 <html lang="ja">
     <head>
        <meta charset="utf-8">
        <title>mission_5-1</title>
     </head>
    <?php
    // DB接続設定、テーブルの作成
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = "CREATE TABLE IF NOT EXISTS tbtest_text"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"
    ."name char(32),"
    ."comment TEXT,"
    ."date DATETIME,"
    ."pass TEXT"
    .");";
    $stmt = $pdo -> query($sql);
    
    //投稿機能
    if(!empty($_POST["name"]) && !empty($_POST["comment"] && empty($_POST["edit_number"]))){
      $name = $_POST["name"];
      $comment = $_POST["comment"];
      $date = date('Y/m/d H:i:s');
      $pass = $_POST["pass"];
      $sql = $pdo -> prepare("INSERT INTO tbtest_text (name, comment, date, pass) VALUES (:name, :comment, :date, :pass)");
      $sql -> bindParam(':name', $name, PDO::PARAM_STR);
      $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
      $sql -> bindParam(':date', $date, PDO::PARAM_STR);
      $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
      $sql -> execute();
    }
    //表示
    $sql = 'SELECT * FROM tbtest_text';
    $stmt = $pdo -> query($sql);
    $results = $stmt -> fetchAll();
      foreach ($results as $row){
        $row['id'].',';
        $row['name'].',';
        $row['comment'].',';
        $row['date'].'<br>';
    //編集
    if(!empty($_POST["edit_number"]) && !empty($_POST["name"]) && !empty($_POST["comment"])){
        $id = $_POST["edit_number"];
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $sql = 'UPDATE tbtest_text SET name=:name,comment=:comment WHERE id=:id';
        $stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
        $stmt -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();  
       }
     }
        
        
    //削除機能
    if(!empty($_POST["delete"]) && $_POST["deletepass"] === $row['pass']){
      $id = $_POST["delete"];
      $sql = 'delete from tbtest_text where id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
    }
    
    //編集機能
    if(!empty($_POST["number"]) && ($_POST["editpass"]) === $row['pass']){
        //編集番号が送信されたら名前とコメントを取得する
        $id = $_POST["number"]; 
        $sql = 'SELECT * FROM tbtest_text WHERE id=:id';
        $stmt = $pdo -> prepare($sql);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute(); 
        $results = $stmt -> fetchAll(); 
          foreach ($results as $row){
            $edit_num = $row['id'];
            $edit_name = $row['name'];
            $edit_comment = $row['comment'];
          }
    }
    ?>
         
     <body>
         <h1>おすすめの映画・ドラマ教えてください</h1>
         <form action="" method="post">
           名前:<input type="text" name="name" value = "<?php if(!empty($edit_name)){echo $edit_name;} ?>"  placeholder = "名前"><br>
           コメント:<input type="text" name="comment" value = "<?php if(!empty($edit_comment)){echo $edit_comment;} ?>"  placeholder = "コメント"><br>
           <input type="hidden" name="edit_number" value = "<?php if(!empty($edit_num)){echo $edit_num;} ?>">
           パスワード:<input type="text" name="pass" value = ""  placeholder = "パスワード"><br>
           <input type="submit" name="submit" value="送信">
         </form>
         <form action="" method="post">
           削除:<input type="number" name="delete"><br>
           パスワード:<input type="text" name="deletepass"><br>
           <input type="submit" name="deletesubmit" value="削除">
         </form>
         <form action="" method="post">
           編集:<input type="number" name="number"><br>
           パスワード:<input type="text" name="editpass"><br>
           <input type="submit" name="edit" value="編集">
         </form>
         <h2>-----------------------------------</h2>
         <?php
         //表示
         $sql = 'SELECT * FROM tbtest_text';
         $stmt = $pdo -> query($sql);
         $results = $stmt -> fetchAll();
         foreach ($results as $row){
         //配列の中で使うのはテーブルのカラム名のもの
           echo $row['id'].',';
           echo $row['name'].',';
           echo $row['comment'].',';
           echo $row['date'].',';
           echo "<hr>";
        }
         ?>        
    </body>
</html>