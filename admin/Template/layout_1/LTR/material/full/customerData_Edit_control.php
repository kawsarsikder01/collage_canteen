<?php include_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'config.php');

$customersJson = file_get_contents($adminSources.'customers.json');
$customers = json_decode($customersJson);

$id = $_POST['id'];
foreach($customers as $key=> $customer){
    if($customer->id == $id){
        break;
    }
}
$fileName =uniqid().'_'. $_FILES['img']['name'];
$target = $_FILES['img']['tmp_name'];
$destination = $upload.$fileName;
$img;
if(move_uploaded_file($target,$destination)){
$img = $fileName;
}


$data = [
    "id"=>$id,
    "name"=>$_POST['name'],
    "phone"=>$_POST['phone'],
    "email"=>$_POST['email'],
    "age"=>$_POST['age'],
    "address"=>$_POST['address'],
    "img"=>$img,
    "passwoard"=>$_POST['passwoard'],
    "username"=>$_POST['username']
];

$customers[$key] = (object) $data;
$customersDataEncode = json_encode($customers);
if(file_exists($adminSources.'customers.json')){
    $result = file_put_contents($adminSources.'customers.json',$customersDataEncode);
    if($result){
        location('customers.php');
    }
}