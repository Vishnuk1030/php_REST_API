<?php

header('Accesss-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Header, Authorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){
    if(isset($_GET['id'])){
        $customer=getCustomer($_GET);
        echo $customer;
    }
    else{
        $CustomerList=getCustomerList();
        echo $CustomerList;
    }

    $CustomerList = getCustomerList();
    echo $CustomerList;
}
else{
    $data =[
        'status' =>405,
        'message' => $requestMethod. 'Metod Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>