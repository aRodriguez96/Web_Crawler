<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Search</title>
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
        <div class="centered">
            <h1>Custom Search Engine</h1>
        </div>
        <div class="centered">
            <input type="text" id="searchBox" required="true" >
        </div>
        <div class="centered">
            <form>
                <input type="submit" value="Search" id="myButton"/>
            </form>
        </div>
        <div class="centered">  
            <form action="admin.php">
                <input type="submit" id="switch" value='To Admin' class="btn btn-primary">
            </form>
        </div>
    </div>
  
    
</body>
</html>
