<?php
require_once '/Programs/xampp/htdocs/developmentScheduler/Core/DatabaseImplementation.php';



/*Δημιουργούμε κλάση dbclass που κατασκευάζει συνδέσεις με την Βάση Δεδομένων
   * Για να αλλάξουμε υλοποίηση αρκεί να παρέχουμε μια νέα υλοποίηση σύνδεσης με την ΒΔ 
   * η οποία όμως επεκτείνει την κλάση DatabaseImplementation. Συνεπώς, μπορούμε να
   * προσθέσουμε μελλοντικά περισσότερη λειτουργικότητα ανάλογα με τις ανάγκες μας 
   * βάζοντας στην θέση του new DatabaseImplementation στην γραμμή 27 μια νέα 
   * υλοποίηση
   */
  class dbclass{
    
    private $Database;
    public function __construct(DatabaseInterface $db){
        $this->Database=$db;
    }
    public function getDatabase(){
      return $this->Database;
    }
  }
 
  $Database = new dbclass(new DatabaseImplementation);
  $db = $Database->getDatabase();  
?>
