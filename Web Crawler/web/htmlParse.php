<!DOCTYPE html>
<html lang="en">

<head>
    <title>test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">CS355</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Course<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="https://learn.zybooks.com/zybook/CUNYCSCI355TeitelmanSpring2019">Zybook</a></li>
                            <li><a href="http://mhhe.com/engcs/compsci/forouzan/">Textbook</a></li>
                            <li><a href="https://tinyurl.com/csci355-drive">Class Notes</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="fixed-list.html">Fixed-List</a></li>
                            <li><a href="from-file.html">From File</a></li>
                            <li><a href="Google_API.html">Google API</a></li>
                            <li><a href="my-search.php">My Search</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Browser<span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="window.html">Window</a></li>
                            <li><a href="screen.html">Screen</a></li>
                            <li><a href="location.html">Location</a></li>
                            <li><a href="navigation.html">Navigation</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">About<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="yassine.html">Yassine</a></li>
                            <li><a href="albert.html">Albert</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="banner">
        
     <?php 
       include('connect-mysql.php');
       include('simple_html_dom.php');
       $urll = $_GET["term"]; 
       $html = file_get_html($urll);
       $title = $html->find('title',0)->plaintext;
       $desc = $html->find('meta[name="description"]',0)->content;
       if (!$dbcon) {
        die("Connection failed: " . mysqli_connect_error());
       }
       $sql = "INSERT INTO `roal9338`.`page` (`urll`, `title`, `description`) VALUES ('$urll', '$title', '$desc')";
       if (mysqli_query($dbcon, $sql)) {
           echo "New record created successfully";
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($dbcon);
       }
       mysqli_close($dbcon);
       //gets current pageId
       $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);    
        if (!$dbcon) {
            die("Connection failed: " . mysqli_connect_error());
        }
       $sql = "SELECT pageId FROM `roal9338`.`page` WHERE urll = '$urll'";
       $result = mysqli_query($dbcon,$sql);
       mysqli_close($dbcon);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $pageId = $row["pageId"];
            }
        } 
        else {
            
        }
        echo $pageId;
        echo "<br>";
        $innerText = file_get_html($urll)->plaintext; 
        $data = preg_split('/\s+/', $innerText);
        $trimmed = array();
        $size=count($data);
        for($i=0; $i<$size; $i++){
            $trimmed[$i]=trim($data[$i],'?"()][><., ');
        }
        for($i=0; $i<$size; $i++){  
            $word = $trimmed[$i];
            if(ctype_alpha($word)){
                echo $word;
                echo "<br>";
                //adds word to word table if doesnt exist 
                $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);    
                if (!$dbcon) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "INSERT INTO `roal9338`.`word` (`wordName`) SELECT * FROM (SELECT '$word') AS tmp WHERE NOT EXISTS ( SELECT wordName FROM `roal9338`.`word` WHERE wordName = '$word') LIMIT 1";
                if (mysqli_query($dbcon, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($dbcon);
                }
                mysqli_close($dbcon);
                //gets current wordId from word table
                $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);    
                if (!$dbcon) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "SELECT wordId FROM `roal9338`.`word` WHERE wordName = '$word'";
                $result = mysqli_query($dbcon,$sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $wordId = $row["wordId"];
                    }
                } 
                else {
                    echo "0 results";
                }              
                mysqli_close($dbcon);
                echo $wordId;
                echo "<br>";             
                //check page_word table to see if tuple of pageid and wordid exists
                $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);    
                if (!$dbcon) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "SELECT pageWordId FROM `roal9338`.`page_word` WHERE pageId = '$pageId' AND wordId='$wordId'";
                $result = mysqli_query($dbcon,$sql);
                mysqli_close($dbcon);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $pageWordId = $row["pageWordId"];
                    }
                    $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);    
                    if (!$dbcon) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql =  "UPDATE page_word SET freq = freq+1 WHERE pageWordId = '$pageWordId'";
                    mysqli_query($dbcon,$sql);
                    mysqli_close($dbcon);
                } 
                else {
                    $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME); 
                    if (!$dbcon) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "INSERT INTO `roal9338`.`page_word` (`pageId`, `wordId`, `freq`) VALUES ('$pageId', '$wordId', '1')";
                    mysqli_query($dbcon,$sql);
                    mysqli_close($dbcon);
                    echo $pageId;
                    echo "<br>";
                    echo $wordId;
                    echo "<br>";  
                }              
            }
       }
        echo "<br>";
        echo "<br>";
        echo $pageId;
    ?>

    </div>
</body>
</html>