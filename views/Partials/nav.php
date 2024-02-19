<?php require '../functions.php';
dd(parse_url($_SERVER['REQUEST_URI'])['path']);
dd($_POST);


?>
<body>
    <div id=container>
        <!--Header & Navigation Bar Section-->
        <header id="header">
               <h1>Πλατφόρμα Διαχείρηση Εργασιών</h1>
               <div class="container">
                    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 0%;">
                        <div class="container-fluid" >
                            <a href="./home.php"><img src="../assets/output-onlinepngtools.png" width="110"/></a>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <ul>
                                   <li><a class="nav-link active" aria-current="page" href="./home.php" style="<?= (parse_url($_SERVER['REQUEST_URI'])['path']==="/developmentScheduler/views/home.php") ?'background-color:#3398db;':''?> color: white;font-size:large; " >Αρχική</a>
                                   </li> 
                                   <li><a class="nav-link active" aria-current="page" href="./task-lists.php" style="<?= (parse_url($_SERVER['REQUEST_URI'])['path']==="/developmentScheduler/views/task-lists.php") ?'background-color:#3398db;':''?> color: white;font-size:large; " >Λίστες Εργασιών</a>
                                   </li> 
                                   <li><a class="nav-link active" aria-current="page" href="./teams.php" style="<?= (parse_url($_SERVER['REQUEST_URI'])['path']==="/developmentScheduler/views/teams.php") ?'background-color:#3398db;':''?> color: white;font-size:large; " >Ομάδες</a>
                                   </li> 
                                   <li><a class="nav-link active" aria-current="page" href="./login.php" style="<?= (parse_url($_SERVER['REQUEST_URI'])['path']==="/developmentScheduler/views/login.php") ?'background-color:#3398db;':''?> color: white;font-size:large; " >Είσοδος</a>
                                   </li> 
                                   <li><a class="nav-link active" aria-current="page" href="./logout.php" style="<?= (parse_url($_SERVER['REQUEST_URI'])['path']==="/developmentScheduler/views/logout.php") ?'background-color:#3398db;':''?> color: white;font-size:large; " >Αποσύνδεση</a>
                                   </li> 



                                </ul>
                              
                            </div>
                          </div>
                  </div>
                </nav>
              </div>  
        </header>