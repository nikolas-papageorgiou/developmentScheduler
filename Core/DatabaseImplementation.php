<?php 

require_once '/Programs/xampp/htdocs/developmentScheduler/Core/DatabaseInterface.php';
require_once '/Programs/xampp/htdocs/developmentScheduler/Core/Database.php';

class DatabaseImplementation implements DatabaseInterface{

  /**Όλοι οι χρήστες */


          /**
           * Καταχώρηση Χρήστη στην Βάση Δεδομένων
           */
    public static function registerNewUser($fullName,$email,$username,$password){
      /**
       * Σύνδεση με την Βάση Δεδομένων. Έχει υλοποιηθεί με Singleton Design Pattern.
       */
      $db = Database::getInstance();
      $connection = $db->getConnection();

      $role = FALSE;
      $statement = $connection->prepare("INSERT INTO `users`(`user_id`, `full_name`, `email`, `username`, `password`, `role`) VALUES ('',\"{$fullName}\",\"{$email}\",\"{$username}\",\"{$password}\",\"{$role}\") ");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
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

     function showTaskLists(){}

    /**Επεξεργασία Λίστας Εργασιών: θα υπάρχει η δυνατότητα επεξεργασίας των στοιχείων της
     * λίστας εργασιών, καθώς και η διαγραφή της. Ενδεικτικά, μπορεί να υπάρχουν αντίστοιχα
     * κουμπιά δίπλα από τον τίτλο της. */
    function deleteTaskList(){}
    function updateTaskList(){}
    /**Προβολή Εργασιών: κάτω από τα στοιχεία κάθε λίστας εργασιών θα εμφανίζονται οι
     * αντίστοιχες εργασίες της με αλφαβητική σειρά. */
    function showTasks(){}
    /**Διαγραφή Εργασίας: θα είναι δυνατή μόνο η διαγραφή μίας εργασίας (δεν απαιτείται
     * λειτουργία επεξεργασία της), ενδεικτικά μπορεί να υπάρχει ένα αντίστοιχο κουμπί δίπλα
     * στον τίτλο μίας εργασίας.
     * Προσθήκη Εργασίας: θα είναι δυνατή η προσθήκη μίας εργασίας σε μία λίστα εργασιών με
     * την ύπαρξη σχετικού κουμπιού κάτω από την τελευταία εργασία. */
    function deleteTask(){}
    function addTask(){}
    /**Δημιουργία Λίστας Εργασιών: θα είναι δυνατή η προσθήκη μίας νέας λίστας εργασιών,
     * όπου στη φόρμα αρκεί να δηλώνεται ο τίτλος της λίστας εργασιών και η κατηγορία της,
     * καθώς η κατάστασή της θα είναι προκαθορισμένη ως «Νέα». Ενδεικτικά, αυτή η
     * δυνατότητα/φόρμα μπορεί να είναι διαθέσιμη στο κάτω μέρος της σελίδας, όπως
     * αναπαρίσταται στην 2η ΓΕ */
    function createTaskList(){}


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
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $statement = $connection->prepare("SELECT username FROM users");
      $statement->execute();
      $usernames = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $usernames; 
    }
    function showUserIdRole($username){
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $statement = $connection->prepare("SELECT user_id,role FROM users WHERE username = \"{$username}\"");
      $statement->execute();
      $userIdRole = $statement->fetch(PDO::FETCH_ASSOC);
      return $userIdRole; 
    }
    function isCredentialsCorrect($username,$password){
      $db = Database::getInstance();
      $connection = $db->getConnection();
      $results = FALSE;

      $statement = $connection->prepare("SELECT * FROM users ");
      $statement->execute();
      $usersInfo = $statement->fetchAll(PDO::FETCH_ASSOC);

      foreach($usersInfo as $key=>$value){
        if($value['username']===$username&&$value['password']===$password){
          $results=TRUE;
        }
      }
      return $results;
    }
}