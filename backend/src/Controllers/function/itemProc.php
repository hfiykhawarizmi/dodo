<?php 
//get all ITEM
function getAllitem($db) {

    
    $sql = 'Select * FROM item'; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get ITEM by id 
function getitem($db, $itemId) {

    $sql = 'Select o.itemID, o.itemName, o.itemPrice, FROM item o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $itemId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new ITEM 
function createitem($db, $form_data) { 
    //stop at sisni
    $sql = 'Insert into item(itemID, itemName, itemPrice)'; 
    $sql .= 'values (:itemID, :itemName, :itemPrice)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':itemID', $form_data['itemID']);    
    $stmt->bindParam(':itemName', ($form_data['itemName']));
    $stmt->bindParam(':itemPrice', ($form_data['itemPrice']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete ITEM by id 
function deleteitem($db,$itemId) { 

    $sql = ' Delete from item where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$itemId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update ITEM by id 
function updateitem($db,$form_dat,$itemId) { 

    
    $sql = 'UPDATE item SET itemID = :itemID, itemName = :itemName , itemPrice = :itemPrice'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$itemId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':itemID', $form_dat['itemID']);    
    $stmt->bindParam(':itemName', ($form_dat['itemName']));
    $stmt->bindParam(':itemPrice', ($form_dat['itemPrice']));
    $stmt->execute(); 
}
