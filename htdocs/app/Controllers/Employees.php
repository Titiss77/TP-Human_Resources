<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Employees extends ResourceController
{
    protected $modelName = 'App\Models\Employees';
    protected $format = 'json';

    /*
     * (x-www-form-urlencoded) :
     *  first_name:Benoît
     *  last_name:Corcuff
     *  email:bcorcuff@gmail.com
     *  phone_integer:06 12 34 56 78
     *  hire_date:0001-08-01 BC
     *  job_id:SA_REP
     *  salary:90.00
     *  commission_pct:0.35
     *  manager_id:146
     *  department_id:80
     */

    // GET /employees
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // GET /employees/{id}
    public function show($id = null)
    {
        $employee = $this->model->find($id);

        if (!$employee) {
            return $this->failNotFound(sprintf('Employee with ID %s not found', $id));
        }

        return $this->respond($employee);
    }

    // DELETE /employees/{id}
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound(sprintf('Employee with ID %s not found', $id));
        }

        $this->model->delete($id);

        return $this->respondDeleted(['id' => $id, 'message' => 'Employee successfully deleted']);
    }

    // POST /employees
    public function create()
    {
        $data = $this->request->getPost();

        $insertId = $this->model->insert($data);

        if ($insertId === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated(['id' => $insertId, 'message' => 'Employee successfully created']);
    }

    // PUT /employees/{id}
    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound(sprintf('Employee with ID %s not found', $id));
        }

        $data = $this->request->getRawInput();

        if ($this->model->update($id, $data) === false) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond(['id' => $id, 'message' => 'Employee successfully updated']);
    }

    public function rowCount()
    {
        $builder = $this->model->builder();
        return $this->respond($builder->countAllResults());
    }

    // http://localhost/ws/employees/name/Corcuff
    public function findByName($name)
    {
        if (!$name) {
            return $this->failValidationErrors(['name' => 'Name is required']);
        }

        $builder = $this->model->builder();
        $builder->like('first_name', $name);
        $builder->orLike('last_name', $name);

        return $this->respond($builder->get()->getResult());
    }
}