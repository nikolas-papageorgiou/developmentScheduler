<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php'?>
        <!--Main Body Section-->
        <div id="main-body">
          
          <form id="login-form" >
            <div class="form-group" >
              <label for="username">Όνoμα Χρήστη:</label>
              <input type="username" class="form-control" id="username" placeholder="">
            </div>
            <div class="form-group">
              <label for="password">Κωδικός Πρόσβασης:</label>
              <input type="password" class="form-control" id="password" placeholder="">
            </div>
            
            <button type="submit" class="btn btn-primary login-btn">Είσοδος</button>
            <div id="sign-up-link"><a href="./sign-up-form.php">Εγγραφή νέου χρήστη</a></div>
          </form>
          
        </div>
        <!--Footer Section-->
        <?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/foot.php'?>
