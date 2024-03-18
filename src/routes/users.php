<?php
// use Namespaces for HTTP request
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// create new Slim instance
$app = new \Slim\App;

//get all data
$app->get('/api/all', function(Request $request, Response $response)
{
  // echo 'Welcome to ------------------------------------>>>>>>>>>>djvgfbgf0eaipfkfs';

  $sql = "SELECT * FROM first";

try {
    $db = new Db();
    $conn = $db->getConnection();

    $result = $conn->query($sql);

    if ($result) {
        $users = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($users);
    } else {
        echo '{"error": {"msg": "' . $conn->error . '"}';
    }
} catch (Exception $e) {
    echo '{"error": {"msg": "' . $e->getMessage() . '"}';
}

});
///////////////  PDO //////////////;
  // $sql = "SELECT * FROM first";

  // try {
  //   $db = new db();

  //   $db = $db->connect();

  //   $stmt = $db->query( $sql );
  //   $users = $stmt->fetchAll( PDO::FETCH_OBJ );
  //   $db = null;

  //   echo json_encode($users);    

  // } 
  // catch( PDOException $e ) {

  //   echo '{"error": {"msg": ' . $e->getMessage() . '}';
  // }

// by id
$app->get('/api/all/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
  
    $sql = "SELECT * FROM first WHERE id = $id";
    try {
      $db = new Db();
      $conn = $db->getConnection();
  
      $result = $conn->query($sql);
  
      if ($result) {
          $users = $result->fetch_all(MYSQLI_ASSOC);
          $response->getBody()->write(json_encode($users));
      } 
      else {
          echo '{"error": {"msg": "' . $conn->error . '"}';
      }
  } catch (Exception $e) {
      echo '{"error": {"msg": "' . $e->getMessage() . '"}';
  }
  });

  
  // POST method to add a new record
  $app->post('/api/all/add', function(Request $request, Response $response) 
  {
    $id = $request->getParam('id');
    $name = $request->getParam('Name');
    $age = $request->getParam('Age');
    $gender = $request->getParam('Gender');

    $sql = "INSERT INTO first (id, Name, Age, Gender) VALUES (?, ?, ?, ?)";

    try {
        $db = new Db();
        $mysqli = $db->getConnection();

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("isis", $id, $name, $age, $gender);

        $stmt->execute();

        echo json_encode(['message' => 'added successfully']);
    } catch (Exception $e)
     {

      echo json_encode(['error' => ['message' => $e->getMessage()]]);
    }
});

//update data -PUT
$app->put('/api/all/update/{id}', function(Request $request,Response $response) {

  $id = $request->getAttribute('id');

  $name = $request->getParam('Name');
  $age = $request->getParam('Age');
  $gender = $request->getParam('Gender');

  $sql = "UPDATE first SET name = ?, age = ?, gender = ? WHERE id = $id";

  try {
      $db = new Db();
      $mysqli = $db->getConnection();

      $stmt = $mysqli->prepare($sql);

      $stmt->bind_param("sis", $name, $age, $gender);

      $stmt->execute();

      $response->getBody()->write(json_encode(['message' => 'updated successfully']));
     
  } catch (Exception $e) {
      $response->getBody()->write(json_encode(['error' => ['message' => $e->getMessage()]]));
  }

  return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/api/all/delete/{id}', function(Request $request, Response $response) 
{
  $id = $request->getAttribute('id');

  $a_search = "SELECT id FROM first WHERE id = $id";
  $b_delete = "DELETE FROM first WHERE id = $id";

  try {
      $db = new Db();
      $mysqli = $db->getConnection();

      $checkStmt = $mysqli->prepare($a_search);                  // Check if the ID exists in the database

      $checkStmt->execute();
      $result = $checkStmt->fetch();

      if ($result)
       {
          $deleteStmt = $mysqli->prepare($b_delete);          // ID exists, proceed with deletion

          $deleteStmt->execute();
          echo json_encode(['message' => 'Deleted successfully']);
      } else {
          echo json_encode(['message' => 'Id not present in table']);
      }
  } catch (Exception $e) {
      echo '{"error": {"msg": "' . $e->getMessage() . '"}';
  }
});
