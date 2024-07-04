<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\CmsService\Repositories\CmsServiceRepository;
use Modules\CmsService\Repositories\CmsServiceRequirementRepository;

class ServiceController extends Controller
{

    public function __construct(){

        $this->_serviceRepository               = new CmsServiceRepository;
        $this->_serviceRequirementRepository    = new CmsServiceRequirementRepository;

    }

    public function index(){

        $services        = $this->_serviceRepository->getAllByParams(['is_show_front' => true]);

        return view('landing/service', compact('services'));

    }

    public function show($slug){

        $service        = $this->_serviceRepository->getByParams(['slug' => $slug]);
        $requirements   = $this->_serviceRequirementRepository->getAllByParams(['service_id' => $service->service_id]);
        $services       = $this->_serviceRepository->getAllByParams(['is_show_front' => true]);

        return view('landing/servicedetail', compact('service', 'requirements', 'services'));

    }   

}