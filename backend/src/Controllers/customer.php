<?php 

use Slim\Http\Request; //namespace 
use Slim\Http\Response; //namespace 

//include adminProc.php file 
include __DIR__ .'/function/customerProc.php';
include __DIR__ .'/function/itemProc.php';


//alow cors
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
//end

// FOR Customer

//read table cust 
$app->get('/customer', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table cust 
$app->get('/allcustomer',function (Request $request, Response $response,  array $arg) { 

    $data = getAllcustomer($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table order by condition (cust id) 
$app->get('/customer/[{id}]', function ($request, $response, $args){   
    $customerId = $args['id']; 
    if (!is_numeric($customerId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getcustomer($this->db, $customerId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method cust
$app->post('/customer/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createcustomer($this->db, $form_data); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 


//delete row cust
$app->delete('/customer/del/[{id}]', function ($request, $response, $args){   
    $customerId = $args['id']; 
    
   if (!is_numeric($customerId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deletecustomer($this->db,$customerId); 
       if (empty($data)) { 

           return $this->response->withJson(array($customerId=> 'is successfully deleted'), 202);}; }); 
 

   
//put table cust 
$app->put('/customer/put/[{id}]', function ($request, $response, $args){
    $customerId = $args['id']; 
    
    if (!is_numeric($customerId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updatecustomer($this->db,$form_dat,$customerId); 
        if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});


// FOR ITEM

//read table item 
$app->get('/item', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// read all data from table item 
$app->get('/allitem',function (Request $request, Response $response,  array $arg) { 

    $data = getAllitem($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

//request table order by condition (item id) 
$app->get('/item/[{id}]', function ($request, $response, $args){   
    $itemId = $args['id']; 
    if (!is_numeric($itemId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getitem($this->db, $itemId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

//post method order
$app->post('/item/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createitem($this->db, $form_data); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 


//delete row Order
$app->delete('/item/del/[{id}]', function ($request, $response, $args){   
    $itemId = $args['id']; 
    
   if (!is_numeric($itemId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deleteitem($this->db,$itemId); 
       if (empty($data)) { 

           return $this->response->withJson(array($itemId=> 'is successfully deleted'), 202);}; }); 
 

   
//put table order 
$app->put('/item/put/[{id}]', function ($request, $response, $args){
    $itemId = $args['id']; 
    
    if (!is_numeric($itemId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updateitem($this->db,$form_dat,$itemId); 
        if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});
   