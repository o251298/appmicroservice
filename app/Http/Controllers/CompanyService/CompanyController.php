<?php

namespace App\Http\Controllers\CompanyService;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }


    public function create(Request $request)
    {
        Log::channel('http_request')->info($request);
        if(empty($request['title']) || empty($request['description']) || empty($request['phone'])) return false;
        $company = Company::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'phone' => $request['phone'],
        ]);
        UserCompany::create([
           'user_id' => $request['user'],
           'company_id' => $company->id
        ]);
        return $company;
    }
}
