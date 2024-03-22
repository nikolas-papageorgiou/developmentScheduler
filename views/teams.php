<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/functions.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/Core/db.php';

if(key_exists('createNewTeam',$_POST)){
  $errorTeamName = $db->createTeam($_POST['teamName']);
}

if(key_exists('addNewMember',$_POST)){

  $errorTeamName = $db->addMemberToTeam($_POST['teamName'],$_POST['user_id']);
}
if(key_exists('delegateTaskListToMember',$_POST)){
  $errorTeamName = $db->delegateTaskListToUser($_POST['task_list_id'],$_POST['user_id']);
}
$users = $db->showUsers();
$allTeams = $db->showTeams();
$memberPerTeam = $db->showMemberPerTeam();
$allTaskLists = $db->showAllTaskLists();
$taskListMember = $db->taskListMember();
$taskListPerMemberPerTeam=[];


// Iterate over each team in $allTeams
foreach ($allTeams as $team => $name) {
  
  // Initialize an array to store tasks for members of this team
  $taskListPerMemberPerTeam[$name['team_name']] = [];

  // Iterate over each member in $memberPerTeam
  foreach ($memberPerTeam as $teams => $member) {
    
    // Check if the member's team matches the current team being processed
    if ($member['team_name'] === $name['team_name']) {
      
      // Add the member's full name to the task list for this team
      $taskListPerMemberPerTeam[$name['team_name']][$member['full_name']]=[] ;

      // Iterate over each task in $taskListMember
      foreach ($taskListMember as $key => $memberTasks) {
        
        // Check if the task belongs to the current member
        if ($memberTasks['fullName'] === $member['full_name']) {
          
          // Add the task title to the task list for this member within this team
          $taskListPerMemberPerTeam[$name['team_name']][$member['full_name']][] = $memberTasks['title'];
        }
      }
    }
  }
}


?>

        <!--Main Body Section-->
        <div id="main-body">
        <?php foreach($taskListPerMemberPerTeam AS $teamName=>$tasksMember) :?>
          <div style="border: 1px solid black;height: 400px;margin: 0px 10px ;position: relative;top: 10px;" >
            
            <div style=" position: relative; top: 10px; margin: 0% 10px;">
                <h1 style="display: flex; justify-content: center; color: black;"><?=$teamName?></h1>
                <div style="display: flex; justify-content: space-evenly;align-items: center; color: black; position: relative; top: 60px;">
                
                <?php foreach ($tasksMember as $memberName => $memberList): ?>
                  <table>
                     <tr>
                         <th><?= htmlspecialchars($memberName) ?></th>
                     </tr>
                          <?php foreach ($memberList as $key => $value): ?>
                                      <tr><td> <?= htmlspecialchars($value) ?></td></tr>
                          <?php endforeach; ?>        
                    </table>
                  <?php endforeach; ?>
                  
                 
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
                <input type = "hidden" name="teamName" value="<?= $teamName?>">
                <input type = "hidden" name="addNewMember" value="addNewMember">
                <div class="col-md-4 mb-2">
                  <label></label>
                  <button type="submit" class="btn btn-success btn-block">Προσθήκη Μέλους</button>
                </div>
              </form>
            </div>
            <!--Task assigment section-->
            <div class="container mt-4"style="position: relative; top: 60px;left: 0px;">
              <form class="row" method="POST" action="./teams.php">
                <div class="col-md-4 mb-2">
                  <label for="dropdown"></label>
                  <div class="custom-select-wrapper">
                    <select class="form-select" aria-label="Default select example" name="task_list_id">
                    <?php foreach($allTaskLists AS $taskLists=>$taskList):?>
                      <option value=<?= $taskList['task_list_id']?>><?= $taskList['title']?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
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
                <input type = "hidden" name="team_id" value=<?= $teamName?>>

                <input type = "hidden" name="delegateTaskListToMember" value="delegateTaskListToMember">
                <div class="col-md-4 mb-2">
                  <label></label>
                  <button type="submit" class="btn btn-success btn-block">Ανάθεση Εργασίας</button>
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
