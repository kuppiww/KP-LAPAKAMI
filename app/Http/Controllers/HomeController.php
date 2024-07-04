<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\CmsService\Repositories\CmsServiceRepository;
use Modules\CmsService\Repositories\CmsServiceRequirementRepository;

class HomeController extends Controller
{

    public function __construct(){

        $this->_serviceRepository               = new CmsServiceRepository;
        $this->_serviceRequirementRepository    = new CmsServiceRequirementRepository;

    }

    public function index(){

        $services = $this->_serviceRepository->getAllByParams(['is_show_front' => true]);

        return view('landing/home', compact('services'));

    }   

}