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

     function showTaskLists(){
      try {
          // Database connection
          $db = Database::getInstance();
          $connection = $db->getConnection();
          
          // Prepare and execute the SQL query
          $statement = $connection->prepare("SELECT * FROM task_lists ORDER BY state");
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
    function addTask($task_list_id, $task_title){
      $db = Database::getInstance();
      $connection = $db->getConnection();
  
      try {
          // Insert the new task into the task table
          $statement = $connection->prepare("INSERT INTO `task`(`task_id`, `title`) VALUES ('', :task_title)");
          $statement->bindParam(':task_title', $task_title);
          $statement->execute();
          
          // Retrieve the last inserted task_id
          $last_task_id = $connection->lastInsertId();
     
          // Insert the task into the task_lists_tasks table
          $statement = $connection->prepare("INSERT INTO `task_lists_tasks`(`task_id`, `task_list_id`) VALUES (:task_id, :task_list_id)");
          $statement->bindParam(':task_id', $last_task_id);
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
    function createTaskList($title, $category, $state){
      // Database connection
      $db = Database::getInstance();
      $connection = $db->getConnection();
  
      // Check if the title is already taken
      $statement = $connection->prepare("SELECT title FROM task_lists WHERE title = :title");
      $statement->bindParam(':title', $title);
      $statement->execute();
      $existingTitle = $statement->fetch(PDO::FETCH_ASSOC);
  
      if($existingTitle){
          // Title already taken, return error message
          return 'Ο Τίτλος Λίστας Εργασιών που επιλέξατε υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο τίτλο.';
      } else {
          // Title is available, insert the new task list
          $statement = $connection->prepare("INSERT INTO task_lists (`title`, `category`, `state`) VALUES (:title, :category, :state)");
          $statement->bindParam(':title', $title);
          $statement->bindParam(':category', $category);
          $statement->bindParam(':state', $state);
          $statement->execute();
  
          // Return success message or indicator
          return 'Η Λίστα Εργασιών δημιουργήθηκε με επιτυχία.';
      }
  }
  


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
    function showTeams(){}

    /**                     * Μόνο ο διαχειριστής              */
    function addMemberToTeam(){}
    function delegateTaskListToUser(){}
    function createTeam(){}


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

}