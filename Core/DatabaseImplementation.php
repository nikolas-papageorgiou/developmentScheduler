<?php 

require_once '/Programs/xampp/htdocs/developmentScheduler/Core/DatabaseInterface.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/Core/Database.php';

class DatabaseImplementation implements DatabaseInterface{

  /**Όλοι οι χρήστες */


          /**
           * Καταχώρηση Χρήστη στην Βάση Δεδομένων
           */
          public static function registerNewUser($fullName, $email, $username, $password){
            try {
                // Get the database instance and connection
                $db = Database::getInstance();
                $connection = $db->getConnection();
        
                // Set the default role to FALSE
                $role = FALSE;
        
                // Prepare the SQL insert statement
                $statement = $connection->prepare("INSERT INTO `users`(`full_name`, `email`, `username`, `password`, `role`) VALUES (:full_name, :email, :username, :password, :role)");
        
                // Bind parameter values
                $statement->bindParam(':full_name', $fullName);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':username', $username);
                $statement->bindParam(':password', $password);
                $statement->bindParam(':role', $role);
        
                // Execute the insert query
                $statement->execute();
        
                // Return true if the user was successfully registered
                return true;
            } catch (PDOException $e) {
                // Handle database errors
                return "Database Error: " . $e->getMessage();
            }
        }
        
    
  /**Προβολή Λίστας Εργασιών: θα εμφανίζονται όλες οι λίστες εργασιών η μία δίπλα στην άλλη.
     * Για κάθε λίστα εργασιών θα εμφανίζεται ο τίτλος, η κατηγορία και η κατάστασή της. Κάτω
     * από τα στοιχεία της λίστας εργασιών θα εμφανίζονται οι τίτλοι των αντίστοιχων εργασιών
     * τους. Σημείωση: ένας εγγεγραμμένος χρήστης θα μπορεί να δει τις λίστες εργασιών που
     * έχει δημιουργήσει ο ίδιος και τις λίστες εργασιών που του έχουν ανατεθεί από τον
     * διαχειριστή, χωρίς να υπάρχει κάποια διαφοροποίηση στον τρόπο προβολής τους. Δε θα
     * μπορεί να δει τις υπόλοιπες λίστες εργασιών.Σειρά Εμφάνισης Λιστών Εργασιών: θα καθορίζεται από την κατάστασή τους, συγκεκριμένα
     * πρώτα θα εμφανίζονται οι «Νέες» λίστες, μετά αυτές που βρίσκονται «Σε εξέλιξη» και τέλος
     * οι «Ολοκληρωμένες». */

     function showTaskLists($user_id){
      try {
          // Database connection
          $db = Database::getInstance();
          $connection = $db->getConnection();
          
          // Prepare and execute the SQL query
          $statement = $connection->prepare("SELECT utl.user_id AS userID, utl.task_list_id AS task_list_id, u.user_id AS user_id, tl.title AS title,tl.category AS category, tl.state AS state
          FROM users_task_lists utl
              JOIN users u ON u.user_id = utl.user_id
              JOIN task_lists tl ON utl.task_list_id = tl.task_list_id
           WHERE utl.user_id = :user_id ORDER BY state");
          $statement->bindParam(':user_id',$user_id);
          $statement->execute();
          
          // Fetch all task lists as an associative array
          $taskLists = $statement->fetchAll(PDO::FETCH_ASSOC);
          
          // Return the array of task lists
          return $taskLists;
      } catch (PDOException $e) {
          // Handle database errors
          return "Database Error: " . $e->getMessage();
      }
  }
  
  function showAllTaskLists(){
    try {
      // Database connection
      $db = Database::getInstance();
      $connection = $db->getConnection();
      
      // Prepare and execute the SQL query
      $statement = $connection->prepare("SELECT *
      FROM users_task_lists utl
          JOIN users u ON u.user_id = utl.user_id
          JOIN task_lists tl ON utl.task_list_id = tl.task_list_id
     ORDER BY state");
      
      $statement->execute();
      
      // Fetch all task lists as an associative array
      $taskLists = $statement->fetchAll(PDO::FETCH_ASSOC);
      
      // Return the array of task lists
      return $taskLists;
  } catch (PDOException $e) {
      // Handle database errors
      return "Database Error: " . $e->getMessage();
  }
  }
    /**Επεξεργασία Λίστας Εργασιών: θα υπάρχει η δυνατότητα επεξεργασίας των στοιχείων της
     * λίστας εργασιών, καθώς και η διαγραφή της. Ενδεικτικά, μπορεί να υπάρχουν αντίστοιχα
     * κουμπιά δίπλα από τον τίτλο της. */
    function deleteTaskList($task_list_id){
      try {
          // Database connection
          $db = Database::getInstance();
          $connection = $db->getConnection();
          
          // Prepare the SQL query with a parameter placeholder
          $statement = $connection->prepare("DELETE FROM `task_lists` WHERE task_list_id = :task_list_id");
          
          // Bind the parameter value to the placeholder
          $statement->bindParam(':task_list_id', $task_list_id);
          
          // Execute the query
          $statement->execute();
      } catch (PDOException $e) {
          // Handle database errors
          return "Database Error: " . $e->getMessage();
      }
  }
  
    function updateTaskList($task_list_id, $newState, $newCategory){
      try {
          // Database connection
          $db = Database::getInstance();
          $connection = $db->getConnection();
          
          // Prepare the SQL query with parameter placeholders
          $statement = $connection->prepare("UPDATE `task_lists` SET `state` = :newState, `category` = :newCategory WHERE task_list_id = :task_list_id");
          
          // Bind the parameter values to the placeholders
          $statement->bindParam(':task_list_id', $task_list_id);
          $statement->bindParam(':newState', $newState);
          $statement->bindParam(':newCategory', $newCategory);
          
          // Execute the query
          $statement->execute();
      } catch (PDOException $e) {
          // Handle database errors
          return "Database Error: " . $e->getMessage();
      }
  }
  
    /**Προβολή Εργασιών: κάτω από τα στοιχεία κάθε λίστας εργασιών θα εμφανίζονται οι
     * αντίστοιχες εργασίες της με αλφαβητική σειρά. */
    function showTasksPerList(){
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $statement = $connection->prepare("SELECT tlt.task_id,tlt.task_list_id,tl.title AS task_list_title,category,state,t.title AS task_title 
      FROM `task_lists_tasks` tlt
      JOIN `task_lists` tl ON tlt.task_list_id = tl.task_list_id
      JOIN `task` t ON t.task_id = tlt.task_id");
      $statement->execute();
      $tasksPerList = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $tasksPerList;
    }


    /**Διαγραφή Εργασίας: θα είναι δυνατή μόνο η διαγραφή μίας εργασίας (δεν απαιτείται
     * λειτουργία επεξεργασία της), ενδεικτικά μπορεί να υπάρχει ένα αντίστοιχο κουμπί δίπλα
     * στον τίτλο μίας εργασίας.
     * Προσθήκη Εργασίας: θα είναι δυνατή η προσθήκη μίας εργασίας σε μία λίστα εργασιών με
     * την ύπαρξη σχετικού κουμπιού κάτω από την τελευταία εργασία. */
    function deleteTask($task_id){
      $db = Database::getInstance();
      $connection = $db->getConnection();
  
      try {
          // Insert the new task into the task table
          $statement = $connection->prepare("DELETE FROM `task` WHERE task_id = (:task_id)");
          $statement->bindParam(':task_id', $task_id);
          $statement->execute();
          return true; // Task added successfully
      } catch (PDOException $e) {
          // Handle database errors
          return "Database Error: " . $e->getMessage();
      }
    }
    function addTask($task_list_id, $task_id){
      $db = Database::getInstance();
      $connection = $db->getConnection();
  
      try {
        
          // Insert the task into the task_lists_tasks table
          $statement = $connection->prepare("INSERT INTO `task_lists_tasks`(`task_id`, `task_list_id`) VALUES (:task_id, :task_list_id)");
          $statement->bindParam(':task_id', $task_id);
          $statement->bindParam(':task_list_id', $task_list_id);
         
          $statement->execute();
  
          return true; // Task added successfully
      } catch (PDOException $e) {
          // Handle database errors
          return "Database Error: " . $e->getMessage();
      }
  }
  
    /**Δημιουργία Λίστας Εργασιών: θα είναι δυνατή η προσθήκη μίας νέας λίστας εργασιών,
     * όπου στη φόρμα αρκεί να δηλώνεται ο τίτλος της λίστας εργασιών και η κατηγορία της,
     * καθώς η κατάστασή της θα είναι προκαθορισμένη ως «Νέα». Ενδεικτικά, αυτή η
     * δυνατότητα/φόρμα μπορεί να είναι διαθέσιμη στο κάτω μέρος της σελίδας, όπως
     * αναπαρίσταται στην 2η ΓΕ */
    function createTaskList($title, $category, $state, $user_id){
      // Database connection
      $db = Database::getInstance();
      $connection = $db->getConnection();
          // Create new task list
          $statement = $connection->prepare("INSERT INTO task_lists (`title`, `category`, `state`) VALUES (:title, :category, :state)");
          $statement->bindParam(':title', $title);
          $statement->bindParam(':category', $category);
          $statement->bindParam(':state', $state);
          $statement->execute();
  
          //Connect user to task list
           // Retrieve the last inserted task_id
           $last_task_list_id = $connection->lastInsertId();

           $statement = $connection->prepare("INSERT INTO `users_task_lists`(`user_id`, `task_list_id`) VALUES (:user_id,:task_list_id)");
           $statement->bindParam(':user_id', $user_id);
          $statement->bindParam(':task_list_id', $last_task_list_id);
          $statement->execute();
  
          // Return success message or indicator
          return 'Η Λίστα Εργασιών δημιουργήθηκε με επιτυχία.';
    }

    function createTask($task_title){
        try {
            // Database connection
            $db = Database::getInstance();
            $connection = $db->getConnection();
    
            // Prepare and execute the SQL query
            $statement = $connection->prepare("INSERT INTO `task` (`task_id`,`title`) VALUES ('',:task_title)");
            $statement->bindParam(':task_title',$task_title);
            $statement->execute();
                     
        } catch (PDOException $e) {
            // Handle database errors
            return "Database Error: " . $e->getMessage();
        }
    }
  

    /**                     * Μόνο ο διαχειριστής              */

    /**Προβολή Ομάδων: θα εμφανίζονται όλες οι ομάδες, η μία κάτω από την άλλη. Για κάθε
     * ομάδα θα εμφανίζεται το όνομά της και τα μέλη της (username).
     * - Προσθήκη Μελών: θα υπάρχει η δυνατότητα προσθήκης ενός μέλους σε μία ομάδα.
     * Σημείωση: μόνο ήδη εγγεγραμμένοι χρήστες μπορούν να γίνουν μέλη σε μία ομάδα.
     * - Ανάθεση Λίστας Εργασιών: θα υπάρχει η δυνατότητα ανάθεσης μίας υπάρχουσας λίστας
     * εργασιών σε ένα μέλος της ομάδας. Σημείωση: για λόγους ευκολίας στο πλαίσιο της
     * άσκησης, ο διαχειριστής θα μπορεί να επιλέγει να αναθέσει μία υπάρχουσα λίστα εργασιών
     * από αυτές που έχει δημιουργήσει ο ίδιος από τη σελίδα «Λίστα Εργασιών». Η ίδια λίστα
     * εργασιών μπορεί να ανατεθεί σε περισσότερα από ένα μέλη μίας ομάδας.
     * - Δημιουργία Ομάδας: θα είναι η δυνατή η προσθήκη μίας νέας ομάδας λίστας εργασιών,
     * όπου στη φόρμα αρκεί να δηλώνεται το όνομα της ομάδας. Ενδεικτικά αυτή η
     * δυνατότητα/φόρμα μπορεί να είναι διαθέσιμη στο κάτω μέρος της σελίδας, όπως
     * αναπαρίσταται στην 2η ΓΕ. */
    function showTeams(){
      try {
        // Database connection
        $db = Database::getInstance();
        $connection = $db->getConnection();

        // Prepare and execute the SQL query
        $statement = $connection->prepare("SELECT*  FROM teams");
        $statement->execute();
        $allTeams = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $allTeams;

    
    } catch (PDOException $e) {
        // Handle database errors
        return "Database Error: " . $e->getMessage();
    }
    }

    function addMemberToTeam($team_id,$user_id){
      try {
        // Database connection
        $db = Database::getInstance();
        $connection = $db->getConnection();

        // Prepare and execute the SQL query
        $statement = $connection->prepare("INSERT INTO `users_teams`(`user_id`,`team_id`) VALUES(:user_id,:team_id)");
        $statement->bindParam(':user_id',$user_id);
        $statement->bindParam(':team_id',$team_id);
        $statement->execute();

    } catch (PDOException $e) {
        // Handle database errors
        return "Database Error: " . $e->getMessage();
    }
    }
    function delegateTaskListToUser($task_list_id,$user_id){
        try {
            // Database connection
            $db = Database::getInstance();
            $connection = $db->getConnection();
    
            // Prepare and execute the SQL query
            $statement = $connection->prepare("INSERT INTO `users_task_lists`(`user_id`,`task_list_id`) VALUES(:user_id,:task_list_id)");
            $statement->bindParam(':user_id',$user_id);
            $statement->bindParam(':task_list_id',$task_list_id);
            $statement->execute();
    
        } catch (PDOException $e) {
            // Handle database errors
            return "Database Error: " . $e->getMessage();
        }
    }

    function createTeam($teamName){
      try {
        // Database connection
        $db = Database::getInstance();
        $connection = $db->getConnection();

        // Prepare and execute the SQL query
        $statement = $connection->prepare("INSERT INTO `teams`(`team_id`,`team_name`) VALUES('',:team_name)");
        $statement->bindParam(':team_name',$teamName);
        $statement->execute();

    } catch (PDOException $e) {
        // Handle database errors
        return "Database Error: " . $e->getMessage();
    }
}


    /**Συμπληρωματικές συναρτήσεις */
    function showUsernames(){
      try {
          // Database connection
          $db = Database::getInstance();
          $connection = $db->getConnection();
  
          // Prepare and execute the SQL query
          $statement = $connection->prepare("SELECT username FROM users");
          $statement->execute();
  
          // Fetch all usernames as an associative array
          $usernames = $statement->fetchAll(PDO::FETCH_ASSOC);
  
          // Return the array of usernames
          return $usernames;
      } catch (PDOException $e) {
          // Handle database errors
          return "Database Error: " . $e->getMessage();
      }
  }
  
  function showUsers(){
    try {
      // Database connection
      $db = Database::getInstance();
      $connection = $db->getConnection();

      // Prepare and execute the SQL query
      $statement = $connection->prepare("SELECT * FROM users");
      $statement->execute();

      // Fetch all usernames as an associative array
      $users = $statement->fetchAll(PDO::FETCH_ASSOC);

      // Return the array of usernames
      return $users;
  } catch (PDOException $e) {
      // Handle database errors
      return "Database Error: " . $e->getMessage();
  }
  }
  function showUserIdRole($username){
    try {
        // Database connection
        $db = Database::getInstance();
        $connection = $db->getConnection();

        // Prepare the SQL query with a parameter placeholder
        $statement = $connection->prepare("SELECT user_id, role FROM users WHERE username = :username");

        // Bind the parameter value to the placeholder
        $statement->bindParam(':username', $username);

        // Execute the query
        $statement->execute();

        // Fetch the user ID and role as an associative array
        $userIdRole = $statement->fetch(PDO::FETCH_ASSOC);

        // Return the user ID and role
        return $userIdRole;
    } catch (PDOException $e) {
        // Handle database errors
        return "Database Error: " . $e->getMessage();
    }
}

function isCredentialsCorrect($username, $password){
  try {
      // Database connection
      $db = Database::getInstance();
      $connection = $db->getConnection();

      // Prepare the SQL query with parameter placeholders
      $statement = $connection->prepare("SELECT COUNT(*) as count FROM users WHERE username = :username AND password = :password");

      // Bind the parameter values to the placeholders
      $statement->bindParam(':username', $username);
      $statement->bindParam(':password', $password);

      // Execute the query
      $statement->execute();

      // Fetch the result
      $result = $statement->fetch(PDO::FETCH_ASSOC);

      // Return true if there's a matching user, false otherwise
      return $result['count'] > 0;
  } catch (PDOException $e) {
      // Handle database errors
      return false;
  }
}


    function showMemberPerTeam(){
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $statement = $connection->prepare("SELECT  ut.team_id AS team_id,ut.user_id AS user_id,u.full_name AS full_name,t.team_name AS team_name
        FROM users_teams ut
            JOIN teams t ON ut.team_id = t.team_id
            JOIN users u ON ut.user_id = u.user_id");
        $statement->execute();

        $memberPerTeam = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $memberPerTeam; 
    }

    function showTasks(){
        $db = Database::getInstance();
        $connection = $db->getConnection();
        $statement = $connection->prepare("SELECT *
        FROM task");
        $statement->execute();

        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $tasks; 
    }
}