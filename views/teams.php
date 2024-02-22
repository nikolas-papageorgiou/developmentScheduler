<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/functions.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/Core/db.php';

if(key_exists('createNewTeam',$_POST)){
  $errorTeamName = $db->createTeam($_POST['teamName']);
}

if(key_exists('addNewMember',$_POST)){
  $errorTeamName = $db->addMemberToTeam($_POST['team_id'],$_POST['user_id']);
}
$users = $db->showUsers();
$allTeams = $db->showTeams();
dd($_POST);
?>

        <!--Main Body Section-->
        <div id="main-body">
        <?php foreach($allTeams AS $teams=>$team) :?>
          <div style="border: 1px solid black;height: 350px;margin: 0px 10px ;position: relative;top: 10px;" >
            
            <div style=" position: relative; top: 10px; margin: 0% 10px;">
                <h1 style="display: flex; justify-content: center; color: black;"><?=$team['team_name']?></h1>
                <div style="display: flex; justify-content: space-evenly;align-items: center; color: black; position: relative; top: 60px;">
                  <span id="member">Μέλος 1</span>
                  <!-- To do: display the members -->
                </div>
                
            </div>
            <!--Add member section-->
            <div class="container mt-4" style="position: relative; top: 60px;left: 200px;">
              <form class="row" method="POST" action="./teams.php">
                <div class="col-md-4 mb-2">
                
                  <label for="dropdown"></label>
                  
                  <div class="custom-select-wrapper">
                  
                    <select class="form-select" aria-label="Default select example" name="user_id">
                    <?php foreach($users AS $usrs=>$user):?>
                      <option value=<?= $user['user_id']?>><?= $user['username']?></option>
                      <?php endforeach;?>
                    </select>
                    
                  </div>
                  
                </div>
                <input type = "hidden" name="team_id" value=<?= $team['team_id']?>>

                <input type = "hidden" name="addNewMember" value="addNeaMember">
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
              
              </form>
            </div>
            

          </div>
          <?php endforeach;?>
          <!--Team creation section-->
          <div class="container mt-4" style="position: relative; top: 60px;left: 200px;">
            <form class="row" method="POST" action="./teams.php">
              <div class="col-md-4 mb-2">
                <label for="textInput"></label>
                <input type="text" class="form-control" id="textInput" placeholder="Όνομα Ομάδας" name ="teamName">
              </div>
              
              <div class="col-md-4 mb-2">

              <input type = "hidden" name="createNewTeam" value="createNewTeam">
                <label></label>
                <button type="submit" class="btn btn-success btn-block">Δημιουργία Ομάδας</button>
              </div>
            </form>
          </div>
        </div>
        <!--Footer Section-->
        <?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/foot.php'?>
