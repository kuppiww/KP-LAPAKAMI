<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Repositories\ServiceRepository;
use Modules\Request\Repositories\RequestSqlServerRepository;
use Exception;


class VerifyController extends Controller
{

    public function __construct()
    {

        $this->_requestRepository = new RequestRepository;
        $this->_serviceRepositoryRepository = new ServiceRepository;
        $this->_requestSqlServerRepository = new RequestSqlServerRepository;

    }

    public function index()
    {

        return view('landing/verifydoc');

    }

    public function result(Request $request)
    {
        $requestExplode = explode("-", $request->input('key'));

        if (count($requestExplode) == 2) {
            $srvCode = $requestExplode[0];
            $key = $requestExplode[1];

            $serviceCode = $this->_serviceRepositoryRepository->getByParams(['service_code' => $srvCode]);

            if (empty($key)) {
                return redirect('/verifikasi-dokumen')->with('error', 'ID dokumen kosong');
            }

            if (isset($serviceCode->service_id)) {
                $getDoc = $this->_requestRepository->getByParams(['request_simkel_id' => $key, 'requests.service_id' => $serviceCode->service_id]);
                if (!$getDoc) {
                    //cek to slq srv
                    if ($serviceCode->simkel_table != null) {
                        $getSqlDoc = $this->_requestSqlServerRepository->getByParams(['id' => $key, 'table_name' => $serviceCode->simkel_table, 'is_kec' => $serviceCode->service_is_kec]);

                        if (isset($getSqlDoc->tte_file_kec) or isset($getSqlDoc->tte_file_kel)) {
                            if ($getSqlDoc->tte_file_kec != null or $getSqlDoc->tte_file_kel != null) {
                                $getDoc = $getSqlDoc;
                                $getDoc->service_name = $serviceCode->service_name;
                                $getDoc->service_is_kec = $serviceCode->service_is_kec;
                                $getDoc->slug_simkel = $serviceCode->slug_simkel;

                                if ($serviceCode->service_is_kec) {
                                    $getDoc->request_file = $getSqlDoc->tte_file_kec;
                                } else {
                                    $getDoc->request_file = $getSqlDoc->tte_file_kel;
                                }

                                return view('landing/verifydocresult', compact('getDoc'));
                            }


                        }

                    }
                    return redirect('/verifikasi-dokumen')->with('error', 'ID dokumen tidak ditemukan');
                }
                return view('landing/verifydocresult', compact('getDoc'));
            } else {
                return redirect('/verifikasi-dokumen')->with('error', 'ID dokumen tidak ditemukan');
            }
        } else {
            return redirect('/verifikasi-dokumen')->with('error', 'ID dokumen tidak ditemukan');
        }



    }

}