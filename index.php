<?php
$myParam= $_GET['id'];

if(isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    }

    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header('Access-Control-Allow-Headers: Accept, Content-type, Content length,
        Accept-Encoding, X-CSRF-Token, Authorization');
    }
    exit(0);
}

$res= array('error' => false);
$action= '';

if(isset($_GET['action'])) {
    $action = $_GET['action'];
}

header("Content-type: JSON");

$conn = new mysqli("localhost", "root", "", "company");
if(!$conn) {
    echo "Error! Conection failed!";
}
$sql = "SELECT * FROM employees WHERE emp_id = '{$myParam}'";
$res = $conn->query($sql);
if($res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        echo json_encode($row, JSON_PRETTY_PRINT);
    }
}


/*
$name= 'Moj broj';
class MyData {
    public $str;
    public $id;

    public function __construct($str, $id) {
        $this->str = $str;
        $this->id = $id;
    }

    public function output() {
        echo $this->str . " : " . $this->id;
    }
}

$sent= new MyData($name, $myParam);
*/
?>