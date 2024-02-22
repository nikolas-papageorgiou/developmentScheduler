<?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/head.php';
require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/nav.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/functions.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/Core/db.php';

$errorTitleAlreadyExists= '';
if(key_exists('createNewTaskList',$_POST)){
  
   $errorTitleAlreadyExists = $db->createTaskList($_POST['title'],$_POST['category'],$_POST['state']);
}


if(key_exists('updateTaskList',$_POST)){
  $db->updateTaskList($_POST['task_list_id'],$_POST['state'],$_POST['category']);
}

if(key_exists('deleteTaskList',$_POST)){
  $db->deleteTaskList($_POST['task_list_id']);
}

if(key_exists('createNewTask',$_POST)){
  $db->addTask($_POST['task_list_id'],$_POST['task_title']);
}

if(key_exists('deleteTask',$_POST)){
  $db->deleteTask($_POST['task_id']);

}

$taskLists = $db->showTaskLists();
$tasksPerList = $db->showTasksPerList();

?>
        <!--Main Body Section-->
        <div id="main-body" >
          <div class="boxes">
          <?php foreach($taskLists AS $key1=>$value1)  : ?>
            <div class="box-list">
            
                <div class="col-md-4 mb-2"style="position: absolute;margin-left:100px;text-align:center" >
                  <span><?=htmlspecialchars( $value1['title']." ".$value1['category']." ". $value1['state'])?></span>
                </div>
                <div style="position: relative; margin-top: 50px; text-align: center; width: 100%;">


                <div style="position: relative; margin-top: 50px; text-align: center; width: 100%;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
                <!-- Form content for updateTaskList goes here -->
                <form class="row" method="POST" action="task-lists.php">
        <input type="hidden" name="updateTaskList" value="updateTaskList">
        <input type="hidden" name="task_list_id" value="<?= htmlspecialchars($value1['task_list_id']) ?>">
        <div class="col-md-4 mb-2">
            <div class="custom-select-wrapper">
                <select class="form-select" aria-label="Default select example" name="category">
                    <option value='ΕΡΓΑΣΙΑ'>ΕΡΓΑΣΙΑ</option>
                    <option value='ΠΡΟΣΩΠΙΚΟ'>ΠΡΟΣΩΠΙΚΟ</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="custom-select-wrapper">
                <select class="form-select" aria-label="Default select example" name="state">
                    <option value='ΝΕΑ'>ΝΕΑ</option>
                    <option value='ΣΕ ΕΞΕΛΙΞΗ'>ΣΕ ΕΞΕΛΙΞΗ</option>
                    <option value='ΟΛΟΚΛΗΡΩΜΕΝΗ'>ΟΛΟΚΛΗΡΩΜΕΝΗ</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <button type="submit" class="btn btn-success btn-block">Ενημέρωση</button>
        </div>
    </form>
           
        </div>
        <div class="col-md-4">
            
                        <!-- Form content for deleteTaskList goes here -->
                        <form class="col-lg-4 mb-2" method="POST" action="task-lists.php">
                          <input type="hidden" name="deleteTaskList" value="deleteTaskList">
                          <input type="hidden" name="task_list_id" value="<?= $value1['task_list_id'] ?>">
                          <button type="submit" class="btn btn-danger btn-block">Διαγραφή Λίστας</button>
                      </form>
                    
                </div>
            </div>
        </div>



                        
    
   
    </div>
    <div class="col-sm-3 mb-2" style="position: relative; margin-left: 100px; text-align: center;">
    <ul>
        <?php foreach($tasksPerList as $key2 => $value2):?>
            <li>
                <div class="d-flex align-items-center justify-content-between">
                    <span><?php echo $value2['task_title']; ?></span>
                    <form class="col-lg-4 mb-2" method="POST" action="task-lists.php">
                        <input type="hidden" name="deleteTask" value="deleteTask">
                        <input type="hidden" name="task_id" value="<?php echo $value2['task_id']; ?>">
                        <button type="submit" class="btn btn-danger">Διαγραφή Εργασίας</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

              
              
            </div>
              
           

            <?php endforeach;?>
           </div>
        <!--Create task list section -->
        <div class="container mt-4" style=" position: relative; left: auto" >
        <form class="row" method = 'POST' action = 'task-lists.php'>
            <div class="col-md-4 mb-2">
              <label for="textInput"></label>
              <input type="text" class="form-control" id="textInput" placeholder="Τίτλος Λίστας" name="title">
            </div>
            
            <div class="col-md-4 mb-2">
              <label for="dropdown"></label>
              <div class="custom-select-wrapper">
                <select class="form-select" aria-label="Default select example" name="category">
                  <option value="ΕΡΓΑΣΙΑ">ΕΡΓΑΣΙΑ</option>
                  <option value="ΠΡΟΣΩΠΙΚΟ">ΠΡΟΣΩΠΙΚΟ</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 mb-2" >
              <label></label>
              <button type="submit" class="btn btn-success btn-block" >Δημιουργία Λίστας</button>
            </div>
            <div >
            <input type ="hidden" name="state" value="ΝΕΑ">
            </div >
            <div >
            <input type ="hidden" name="createNewTaskList" value="createNewTaskList">
            </div >
            
            <div><p style="color: red;"><?= $errorTitleAlreadyExists ?></p></div>
          </form>
          </div>
          <!--Create task section -->
          <div class="container mt-4" style="position: relative;margin-left: auto;">
              <form class="row" method = 'POST' action = 'task-lists.php'>
              <div class="col-md-1 mb-2">
              <div >
                <input type ="hidden" name="createNewTask" value="createNewTask">
              </div >
             
              <div class="custom-select-wrapper">
                <select class="form-select" aria-label="Default select example" name="task_list_id">
                <?php foreach($taskLists AS $key=>$value) : ?>
                  <option value=<?=htmlspecialchars($value['task_list_id']) ?> > <?=htmlspecialchars( $value['title'])?></option>
                  <?php endforeach;?>
                </select>
              </div>
             
                </div>
                <div class="col-md-4 mb-2" style='position:relative;width:500px;'>
                  <label for="textInput"></label>
                  <input type="text" name='task_title' class="form-control" id="textInput" placeholder="Τίτλος Εργασίας">
                
                  </div>
                <div class="col-md-4 mb-2" style='position:relative;width:500px;'>
                  <label></label>
                  <button type="submit" class="btn btn-primary btn-block" >Δημιουργία Εργασίας</button>
                </div>
              </form>
            </div>
        </div>
        <!--Footer Section -->
        <?php require '/Programs/xampp/htdocs/developmentScheduler/views/Partials/foot.php'?>


