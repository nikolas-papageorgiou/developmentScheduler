<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php'?>
        <!--Main Body Section-->
        <div id="main-body">
          
          <form id="login-form" style="height: 500px;">
            <div class="form-group"  >
              <label for="username">Όνoμα Χρήστη:</label>
              <input type="username" class="form-control" id="username" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Email:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                
              </div>
            
            <div class="form-group">
              <label for="password">Κωδικός Πρόσβασης:</label>
              <input type="password" class="form-control" id="password" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Επιβεβαίωση Κωδικού:</label>
                <input type="password" class="form-control" id="password" placeholder="">
              </div>
            <button type="submit" class="btn btn-primary login-btn">Είσοδος</button>
            
          </form>
          
        </div>
        <!--Footer Section-->
        <?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/foot.php'?>
