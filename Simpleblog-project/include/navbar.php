<style>
    .english{
        font-family:Cambria;
        font-size:18px;
    }
    .hey{
        border-bottom-left-radius: 0px;
        border-top-left-radius: 0px;
    }
    .hey1{
        border-bottom-right-radius: 0px;
        border-top-right-radius: 0px;
    }
    .hey{
        font-family:Cambria;
        font-size:20px;
    }
    .photocut{
        width:210px;
        height:120px;
    }
     body{
         background:url("img/bg2.jpg");
         -webkit-background-size: cover;
     }
</style>

<!--Navbar is start-->
<div class="container-fluid m-0 p-0">
    <div class="navbar bg-light navbar-expand-lg navbar-light">
        <div class="navbar-brand fa fa-arrow-circle-up fa-2x">TechCoder</div>

        <div class="navbar-toggler">
            <span class="navbar-toggler-icon" data-toggle="collapse" data-target="#abc"></span>
        </div>
        <div class="collapse navbar-collapse offset-lg-1 offset-sm-1" id="abc">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link text-dark english">Home</a>
                </li>
                <li class="nav-item">
                    <a href="filternews.php?pid=1" class="nav-link text-dark english">Celebrity</a>
                </li>
                <li class="nav-item">
                    <a href="filternews.php?pid=2" class="nav-link text-dark english">Healthy</a>
                </li>
                <li class="nav-item">
                    <a href="filternews.php?pid=3" class="nav-link text-dark english">IT News</a>
                </li>
                <li class="nav-item">
                    <a href="filternews.php?pid=4" class="nav-link text-dark english">Coding</a>
                </li>
                <li class="nav-item dropdown">

                    <?php
                     if(MySession::checkSession("username")){
                         switch(MySession::adminGetSession("email")){
                             case "futurenetzenye@gmail.com":
                                 echo '<a href="#" class="nav-link text-dark english dropdown-toggle" data-toggle="dropdown">'.MySession::getSession("username").'</a>
                                       <div class="dropdown-menu">
                                       <a href="admin.php" class="dropdown-item">Admin Panel</a>
                                        <a href="#" class="dropdown-item">My Profile</a>
                                       <a href="logout.php" class="dropdown-item">Logout</a>
                                       </div>';
                                 break;
                             default;
                                 echo '<a href="#" class="nav-link text-dark english dropdown-toggle" data-toggle="dropdown">'.MySession::getSession("username").'</a>
                                      <div class="dropdown-menu">
                                      <a href="#" class="dropdown-item">My Profile</a>
                                      <a href="logout.php" class="dropdown-item">Logout</a>
                                        </div>';

                                       }

                     } else{
                         echo '<a href="#" class="nav-link text-dark english dropdown-toggle" data-toggle="dropdown">Member</a>
                    <div class="dropdown-menu">
                        <a href="login.php" class="dropdown-item">Login</a>
                        <a href="register.php" class="dropdown-item">Register</a>
                    </div>';
                     }
                    ?>

                </li>
            </ul>
            <form action="<?php $_PHP_SELF ?>" method="post">
                <div class="row col-md-12 col-xs-12 offset-lg-6">
                    <input type="text" class="form-control col-md-8 col-xs-8 hey1" placeholder="Search Keywords" name="keyword">
                    <button class="btn btn-outline-primary hey" style="width:80px;">Search</button>
            </form>
        </div>
    </div></div>
<br>
<!--Navbar is End-->