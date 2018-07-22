<?php
function update elevatorNetwork(int $node ID, int $new status = 1): void {
  $db = new PD0(
    'mysql:host=127.0.0.l;dbname=elevator', // Data Source Name
    'root',	//	Username
    ''	//	Password
  );
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PD0::FETCH_ASSOC);
  $db->beginTransaction();	// START TRANSACTION
  try {
    // Change elevatorNetwork
    $query = 'UPDATE elevatorNetwork SET status = :stat WHERE nodelD = :id';
    $statement = $db->prepare($query);
    $statement->bindValue('stat', $new status);
    $statement->bindValue('id', $node ID);
    if (!$statement->execute()) {
      throw new Exception('Error - exception thrown in try block');
    }
    $db->commit();	// COMMIT (if no exception in try
  } catch (Exception $e) {
    $db->rollBack();	// ROLL BACK (if exception in try
  }
}
update_elevatorNetwork(2, 25); // Change status of nodeID=2 to 25 - OK
update_elevatorNetwork(100, 5); // Should throw an exception and ROLL BACK
?>
