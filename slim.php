<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$dbopts = parse_url(getenv('DATABASE_URL'));
$db = new PDO('pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"], $dbopts["user"], $dbopts["pass"]);

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ]
];
$app = new \Slim\App($config);

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/posts', function (Request $request, Response $response) use ($db) {
  $stmt = $db->query('SELECT * FROM posts');
  $rows = array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $row;
  }

  $response->getBody()->write(json_encode($rows));
  return $response;
});

$app->post('/post', function (Request $request, Response $response) use ($db) {
  $stmt = $db->prepare("INSERT INTO posts (content,p_user,timestamp) VALUES (?,?,?)");
  $params = $request->getParsedBody();
  $valuesArr = array($params['content'], $params['p_user'], round(microtime(true) * 1000));
  $resp = $stmt->execute($valuesArr);

  if($resp) {
    $response->getBody()->write(json_encode(array('content' => $valuesArr[0],
                                                  'p_user' => $valuesArr[1],
                                                  'timestamp' => $valuesArr[2]
                                                )));
  } else {
    $response->getBody()->write('0');
  }

  return $response;
});

$app->run();
