<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php'?>


<!--XSS. Δεν χρειάζεται διαχείριση επειδή δεν εμφανίζω σε κάποιο σημείο τις εισαγωγές των στοιχείων που θα κάνει.
Χρειάζονται διαχείριση τα υλόποιπα δεδομένα που θα εισάγει όπως, ονόματα λιστών, εργασιών, ονόματα ομάδων. -->
        <!--Main Body Section-->
        <div id="main-body"  >
          
          <form id="login-form" style="height: 700px ;width:50vh ;" method='POST' action='./sign-up-form.php'>
          <div class="form-group"  >
              <label for="fullName">Όνομα - Επίθετο </label>
              <input type="username" class="form-control" id="fullName" name = "fullName">
              <p id='errorFullName' style="color: red;"></p>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                <p id='errorEmail' style="color: red;"></p>
              </div>
              <div class="form-group"  >
              <label for="username">Username</label>
              <input type="username" class="form-control" id="username" name="username" >
              <p id='errorUsername' style="color: red;"></p>
            </div>
            <div class="form-group">
              <label for="password">Κωδικός Πρόσβασης:</label>
              <input type="password" class="form-control" id="password" name="password">
              <p id='errorPassword' style="color: red;"></p>
            </div>
            <div class="form-group">
                <label for="cpassword">Επιβεβαίωση Κωδικού:</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <p id='errorcPassword' style="color: red;"></p>
              </div>
            <button type="submit" class="btn btn-primary login-btn" form="login-form" style="margin-left: 200px;">Είσοδος</button>
            
          </form>
          
        </div>
        <script defer src="validationForm.js"></script> 

        <!--Footer Section-->
        <?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/foot.php'?>
