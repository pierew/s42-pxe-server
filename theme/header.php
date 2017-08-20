<html>
    <head>
        <title>PXE Server</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="theme/img/sysadmin42-logo.png" width="40px" align="left" style="margin-top:-5px;padding-right:10px;"> PXE Server</a>
                </div>
                <?php
                echo '<ul class="nav navbar-nav">';
                if ($_SESSION['login'] == true) {

                    if ($_GET['view'] == "overview") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="?view=overview">Overview</a></li>';

                    if ($_GET['view'] == "images") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="?view=images">Images</a></li>';

                    if ($_GET['view'] == "browse") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="?view=browse">Browse</a></li>';

                    if ($_GET['view'] == "config") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="?view=config">Configuration</a></li>';

                    if ($_GET['view'] == "about") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="?view=about">About</a></li>';
                } else {
                    if ($_GET['view'] == "") {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    echo '<a href="?">Login</a></li>';
                }
                if ($_GET['view'] == "help") {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo '<a href="?view=help">Help</a></li>';
                echo '</ul>';
                if ($_SESSION['login'] == true) {
                    echo '<ul class="nav navbar-nav navbar-right">';
                    echo '<li><p class="navbar-text">Signed in as Admin</p></li>';
                    echo '<li><a title="Refresh" href="javascript:window.location.reload(true)"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a></li>';
                    echo '<li><a title="Logout" href="?view=logout" ><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>';
                    echo '<li><a title="Reboot" href="?view=system&action=reboot" ><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a></li>';
                    echo '<li><a title="Shutdown" href="?view=system&action=shutdown"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>';
                    echo '</ul>';
                }
                ?>
            </div>
        </nav>
