<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Repositories\EmployeeRepository;
use App\Repositories\AuthRepository;
use App\Repositories\ExportImportRepository;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $authModel;
    protected $excelModel;

    public function __construct(User $employee){
        $this->model = new EmployeeRepository($employee);
        $this->authModel = new AuthRepository($employee);
        $this->excelModel = new ExportImportRepository($employee);
    }

}
