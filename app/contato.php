<?php

use App\controller\ContatoController;
use App\model\Contato;

require_once __DIR__ . '../../vendor/autoload.php';


$contact = new ContatoController;



/**
 * @delete = index.php?id=10
 */

if ($_SERVER['REQUEST_METHOD'] == 'GET' &&  isset($_GET['id'])) {

    $id = $_GET['id'];
    $contact->delete($id);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' &&  isset($_GET['show'])) {

    $id = $_GET['show'];

    echo  $contact->ContactById($id);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['show'])) {

    echo $contact->fetchAll();
    exit;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['id'])) {
    $data = $_POST;
    $id = $data['id'];
    $contact->update($id, $data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    $contact->insert($data);
    echo "post";
    exit;
}
