<?php namespace App\Controllers; 
use CodeIgniter\RESTful\ResourceController; 
class Employees extends ResourceController { 
protected $modelName = 'App\Models\Employees'; 
protected $format    
= 'json';  
public function index(){ 
return $this->respond($this->model->findAll()); 
} 
}