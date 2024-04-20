<?php 
//get all CUSTOMER
function getAllcustomer($db) {

    
    $sql = 'Select * FROM customer'; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get CUSTOMER by id 
function getcustomer($db, $customerId) {

    $sql = 'Select o.customerID, o.custName, o.custPhone, o.custAddress FROM customer o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $customerId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new CUSTOMER 
function createcustomer($db, $form_data) { 
    //stop at sisni
    $sql = 'Insert into customer(customerID, custName, custPhone, custAddress)'; 
    $sql .= 'values (:customerID, :custName, :custPhone, :custAddress)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':customerID', $form_data['customerID']);    
    $stmt->bindParam(':custName', ($form_data['custName']));
    $stmt->bindParam(':custPhone', ($form_data['custPhone']));
    $stmt->bindParam(':custAddress', ($form_data['custAddress']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete CUSTOMER by id 
function deletecustomer($db,$customerId) { 

    $sql = ' Delete from customer where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$customerId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update CUSTOMER by id 
function updatecustomer($db,$form_dat,$customerId) { 

    
    $sql = 'UPDATE customer SET customerID = :customerID, custName = :custName , custPhone = :custPhone , custAddress = :custAddress'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$customerId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':customerID', $form_dat['customerID']);    
    $stmt->bindParam(':custName', ($form_dat['custName']));
    $stmt->bindParam(':custPhone', ($form_dat['custPhone']));
    $stmt->bindParam(':custAddress', ($form_dat['custAddress']));
    $stmt->execute(); 
}
