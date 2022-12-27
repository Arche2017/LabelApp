<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Company;
use App\Models\Site;
use App\Models\Label;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\CompanyOrSiteOrUserNotFoundException;

class LabelController extends Controller
{
    public function __construct(User $user, Company $company, Site $site, Label $label)
    {
        $this->user=$user;
        $this->company=$company;
        $this->site=$site;
        $this->label=$label;
    }
//показ всех лейблов из таблицы
    public function index()
    {
        return $this->label->all();
    }
//добавление лейблов
    public function addLabel(Request $request)
    {
        $data=$request->except('_token','method','label');
        if($request->label) $labels=explode(',',$request->label);
        if(count($labels))
        {
            foreach($labels as $val)
            {
                $data['label']=$val;
                $this->label->create($data);
            }
            return 'Лейблы успешно добавлены';
        }
        return 'Операция неудалась';
    }
    public function findUserLabels(Request $request)
    {
        try {
            return $this->user->where('email',$request->email)->firstOrFail()->label;
        } catch (ModelNotFoundException $e) {
              throw new CompanyOrSiteOrUserNotFoundException($e);
        }
    }
    //найти компанию по имени и ее лейблы
    public function findCompanyLabels(Request $request)
    {
        try {
            return $this->company->where('name',$request->company_name)->firstOrFail()->label;
        } catch (ModelNotFoundException $e) {
              throw new CompanyOrSiteOrUserNotFoundException($e);
        }
        
    }
    //найти сайт по имени и его лейблы
    public function findSiteLabels(Request $request)
    {
        try {
            return $this->site->where('name',$request->site_name)->firstOrFail()->label;
        } catch (ModelNotFoundException $e) {
              throw new CompanyOrSiteOrUserNotFoundException($e);
        }
    }

}
