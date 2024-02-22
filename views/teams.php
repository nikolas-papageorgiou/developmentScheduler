<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php';


?>

        <!--Main Body Section-->
        <div id="main-body">
          <div style="border: 1px solid black;height: 350px;margin: 0px 10px ;position: relative;top: 10px;" >
            <div style=" position: relative; top: 10px; margin: 0% 10px;">
                <h1 style="display: flex; justify-content: center; color: black;">Ομάδα Α</h1>
                <div style="display: flex; justify-content: space-evenly;align-items: center; color: black; position: relative; top: 60px;">
                  <span id="member">Μέλος 1</span>
                  <span id="member">Μέλος 2</span>
                  <span id="member">Mέλος 3</span>
                </div>
                
            </div>
            <!--Add member section-->
            <div class="container mt-4" style="position: relative; top: 60px;left: 200px;">
              <form class="row">
                <div class="col-md-4 mb-2">
                  <label for="textInput"></label>
                  <input type="text" class="form-control" id="textInput" placeholder="Όνομα μέλους">
                </div>
                
                <div class="col-md-4 mb-2">
                  <label></label>
                  <button type="submit" class="btn btn-success btn-block">Προσθήκη Μέλους</button>
                </div>
              </form>
            </div>
            <!--Task assigment section-->
            <div class="container mt-4"style="position: relative; top: 60px;left: 0px;">
              <form class="row">
                <div class="col-md-4 mb-2">
                  <label for="dropdown"></label>
                  <div class="custom-select-wrapper">
                    <select class="form-select" aria-label="Default select example">
                      <option value="task1">Εργασία 1</option>
                      <option value="task2">Εργασία 2</option>
                      <option value="task3">Εργασία 3</option>
                      <option value="task4">Εργασία 4</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 mb-2">
                  <label for="dropdown"></label>
                  <div class="custom-select-wrapper">
                    <select class="form-select" aria-label="Default select example">
                      <option value="member1">Μέλος 1</option>
                      <option value="member2">Μέλος 2</option>
                      <option value="member3">Μέλος 3</option>
                      <option value="member4">Μέλος 4</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 mb-2">
                  <label></label>
                  <button type="submit" class="btn btn-primary btn-block">Δημιουργία Λίστας</button>
                </div>
              </form>
            </div>
          </div>
          <!--Team creation section-->
          <div class="container mt-4" style="position: relative; top: 60px;left: 200px;">
            <form class="row">
              <div class="col-md-4 mb-2">
                <label for="textInput"></label>
                <input type="text" class="form-control" id="textInput" placeholder="Όνομα Ομάδας">
              </div>
              
              <div class="col-md-4 mb-2">
                <label></label>
                <button type="submit" class="btn btn-success btn-block">Δημιουργία Ομάδας</button>
              </div>
            </form>
          </div>
        </div>
        <!--Footer Section-->
        <?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/foot.php'?>
