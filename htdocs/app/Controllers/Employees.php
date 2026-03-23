<?php namespace App\Controllers; 

use CodeIgniter\RESTful\ResourceController; 

class Employees extends ResourceController { 
    
    protected $modelName = 'App\Models\Employees'; 
    protected $format    = 'json';  

    // GET /employees
    public function index() { 
        return $this->respond($this->model->findAll()); 
    } 

    // GET /employees/{id}
    public function show($id = null) { 
        return $this->respond($this->model->find($id));
    }

    // DELETE /employees/{id}
    public function delete($id = null) { 
        return $this->respond($this->model->delete($id));
    }

    // POST /employees
    public function create() { 
        return $this->respond($this->model->insert($this->request->getJSON(true)));
    }

    // PUT /employees/{id}
    public function update($id = null) {
        return $this->respond($this->model->update($id, $this->request->getJSON(true)));
    } 
}