<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
$user = $_POST['user'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$name= $_POST['name'];
$bio = $_POST['bio'];
$likes = $_POST['likes'];
$dislikes = $_POST['dislikes'];
$allergies = $_POST['allergies'];


echo '<title>Registeration Success</title> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/registerfinish.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/style.css">';
echo '<header>
        <div class="container">
            <div id="logo" class="container">
                <div class="col-xs-12">
                    <h1 class="title">iPicky</h1>
                </div>
            </div>
        </div>
        <div class="navbar navbar-default">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div>
    </header>';
if($user != null && $pw != null && $pw2 != null && $pw == $pw2)//checking is there empty field and is the password the same
{
        
    $sql = "INSERT INTO Account (username, accPass) VALUES ('$user', '$pw');";

    if(mysql_query($sql))
    {
        $userID = '';
        // retreive user id
        $sql = "SELECT a.accNo
                FROM Account a
                WHERE a.username IN ('$user');";
    
        $result = mysql_query($sql);
        while($row = mysql_fetch_row($result)) {
            $userID = $row[0];
        }
        
        // add the details
        $sql = "INSERT INTO details VALUES ($userID, '$name', '$bio', 'unknown');";
        mysql_query($sql);
        
        
        // add the food
        $sql = "INSERT INTO Preference VALUES ($userID, '$likes', 'like');";
        mysql_query($sql);
        $sql = "INSERT INTO Preference VALUES ($userID, '$dislikes', 'dislike');";
        mysql_query($sql);
        $sql = "INSERT INTO Preference VALUES ($userID, '$allergies', 'allergies');";
        mysql_query($sql);

        echo '<main>
                <div class="register">
                    Registration Success!
                </div> 
              </main>';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
    }
    else
    {
        echo '<main>
                  <div class="failed">
                      Registration failed! Account already exists!
                  </div>
              </main>';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=register.php>';
    }
}
else
{
    echo '<main>
              <div class="failed">
                  Registration failed. The passwords are different 
                  or there are empty fields.
              </div>
          </main>';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=register.php>';
}
?>