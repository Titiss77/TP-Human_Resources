<?php namespace App\Models; 
    use CodeIgniter\Model; 
    class Employees extends Model{ 
    protected $table      
    = 'employees'; 
    protected $primaryKey = 'employee_id'; 
    protected $allowedFields = ['first_name', 'last_name', 'email', 'phone_integer', 
    'hire_date', 'job_id', 'salary', 'commission_pct', 'manager_id', 'department_id'] ; 
    }