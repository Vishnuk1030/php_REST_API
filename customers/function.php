<?php

require'../inc/dbcon.php';

function error422($message){
    $data =[
        'status' =>422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function storeCustomer($customerInput){
    global $connection;

    $name = mysqli_real_escape_string($connection, $customerInput['name']);
    $email = mysqli_real_escape_string($connection, $customerInput['email']);
    $phone = mysqli_real_escape_string($connection, $customerInput['phone']);

    if(empty(trim($name))){

        return error422('Enter your name');

    }elseif(empty(trim($email))){

        return error422('Enter your email');

    }elseif(empty(trim($phone))){

        return error422('Enter your phone number');
    }
    else{
        $query = "INSERT INTO customers (name, email, phone) VALUES ('$name','$email','$phone')";
        $result = mysqli_query($connection,$query);

        if($result){
            $data =[
                'status' =>201,
                'message' => 'Customer Created successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);

        }else{
            $data =[
                'status' =>500,
                'message' => 'Internal Server Error'
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

function getCustomerList(){

    global $connection;

    $query = "SELECT * FROM customers";
    $query_run = mysqli_query($connection,$query);


    if($query_run){
        if (mysqli_num_rows($query_run)>0){

            $response =  mysqli_fetch_all($query_run,MYSQLI_ASSOC);

            $data =[
                'status' => 200,
                'message' => 'Customer List Fetched Successfully',
                'data'=> $response
            ];
            header("HTTP/1.0 200 ok");
            return json_encode($data);


        }
        else{
            $data =[
                'status' =>404,
                'message' => 'No Customer Found',
            ];
            header("HTTP/1.0 404 No Customer Found");
            return json_encode($data);
        }


    }
    else{
        $data =[
            'status' =>500,
            'message' => 'Internal Server Error'
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }

    function deleteCustomer($customerParans){

        global $connection;
        
    }
    
}
?>