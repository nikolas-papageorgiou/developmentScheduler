<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php';

?>

        <!--Main Body Section-->
        <div id="main-body" >
          <div class="boxes">
            <div class="box-list">
              <h2>Λίστα Εργασιών 1</h2>
              <ul>
              <li>Εργασία 1</li>
              <li>Εργασιά 2</li>
              <li>Εργασιά 3</li>
            </ul>
          </div>
            <div class="box-list">
              <h2>Λίστα Εργασιών 2</h2>
              <ul>
              <li>Εργασία 3</li>
              <li>Εργασία 4</li>
              <li>Εργασία 5</li>
            </ul>
          </div>
        </div>
        
        <div class="container mt-4">
          <form class="row">
            <div class="col-md-4 mb-2">
              <label for="textInput"></label>
              <input type="text" class="form-control" id="textInput" placeholder="Τίτλος Λίστας">
            </div>
            <div class="col-md-4 mb-2">
              <label for="dropdown"></label>
              <div class="custom-select-wrapper">
                <select class="form-select" aria-label="Default select example">
                  <option value="category1">Κατηγορία 1</option>
                  <option value="category2">Κατηγορία 2</option>
                  <option value="category3">Κατηγορία 3</option>
                  <option value="category4">Κατηγορία 4</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 mb-2">
              <label></label>
              <button type="submit" class="btn btn-success btn-block">Δημιουργία Λίστας</button>
            </div>
          </form>
        </div>
        </div>
        <!--Footer Section -->
        <?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/foot.php'?>
