<?php

namespace Modules\CmsService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Helpers\DataHelper;
use DB;

use Modules\CmsService\Repositories\CmsServiceRepository;
use Modules\CmsService\Repositories\CmsServiceRequirementRepository;
use Modules\Request\Repositories\RequestRepository;

class CmsServiceController extends Controller
{
    public function __construct()
    {
        $this->_monitoring = new RequestRepository;
        $this->_serviceRepository               = new CmsServiceRepository;
        $this->_serviceRequirementRepository    = new CmsServiceRequirementRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $services = $this->_serviceRepository->getAll();

        return view('cmsservice::index', compact('services'));
    }

    public function monitoringlayanan()
    {
        $services = $this->_monitoring->getAllWithOutParams();

        return view('cmsservice::monitoring', compact('services'));
    }

    public function monitoringlayanansuccess()
    {
        $services = $this->_monitoring->getAllWithOutParams();

        return view('cmsservice::monitoringsuccess', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cmsservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        // Upload Icon
        if ($request->file('icon')) {
            $fileName = md5(time() . rand()) .'.'. $request->icon->extension();  
            $request->file("icon")->storeAs('images/service', $fileName, 'public');
            $request['service_icon'] = $fileName;   
        }

        DB::beginTransaction();
        $this->_serviceRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        DB::commit();

        return redirect('cms/layanan')->with('message', 'Layanan berhasil ditambahkan');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cmsservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cmsservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Check detail to db
        $detail  = $this->_serviceRepository->getById($id);

        if (!$detail) {
            return redirect('cms/layanan');
        }

        // Upload Icon
        if ($request->file('icon')) {
            $fileName = md5(time() . rand()) .'.'. $request->icon->extension();  
            $request->file("icon")->storeAs('images/service', $fileName, 'public');
            $request['service_icon'] = $fileName;   
        }

        DB::beginTransaction();
        $this->_serviceRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        DB::commit();

        return redirect('cms/layanan')->with('message', 'Layanan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // Check detail to db
        $detail  = $this->_serviceRepository->getById($id);

        if (!$detail) {
            return redirect('cms/layanan');
        }

        DB::beginTransaction();
        $this->_serviceRepository->delete($id);
        DB::commit();

        return redirect('cms/layanan')->with('message', 'Layanan berhasil dihapus');
    }

    /**
     * Get detail data.
     * @param int $id
     * @return Renderable
     */
    public function detail($id){

        // Check detail to db
        $detail  = $this->_serviceRepository->getById($id);

        if (!$detail) {
            return redirect('cms/layanan');
        }

        $requirements = $this->_serviceRequirementRepository->getAllByParams(['service_id' => $id]);

        return view('cmsservice::show', compact('detail', 'requirements'));

    }

    /**
     * Get data the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id){

        $response   = array('status' => 0, 'result' => array()); 
        $getDetail  = $this->_serviceRepository->getById($id);

        if ($getDetail) {
            $response['status'] = 1;
            $response['result'] = $getDetail;
        }

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store_requirement(Request $request)
    {

        // Upload Icon
        if ($request->file('example')) {
            $fileName = $request->input('service_requirement_name') .'_'. md5(time() . rand()) .'.'. $request->example->extension();  
            $request->file("example")->storeAs('files/service', $fileName, 'public');
            $request['example_file'] = $fileName;   
        }

        DB::beginTransaction();
        $this->_serviceRequirementRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        DB::commit();

        return redirect('cms/layanan/detail/'. $request->input('service_id'))->with('message', 'Persyaratan berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update_requirement(Request $request, $id)
    {
        // Check detail to db
        $detail  = $this->_serviceRequirementRepository->getById($id);

        if (!$detail) {
            return redirect('cms/layanan/detail'. $request->input('service_id'));
        }

        // Upload Icon
        if ($request->file('example')) {
            $fileName = $request->input('service_requirement_name') .'_'. md5(time() . rand()) .'.'. $request->example->extension();  
            $request->file("example")->storeAs('files/service', $fileName, 'public');
            $request['example_file'] = $fileName;   
        }

        DB::beginTransaction();
        $this->_serviceRequirementRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        DB::commit();

        return redirect('cms/layanan/detail/'. $request->input('service_id'))->with('message', 'Persyaratan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy_requirement($id)
    {
        // Check detail to db
        $detail  = $this->_serviceRequirementRepository->getById($id);

        if (!$detail) {
            return redirect('cms/layanan/detail/'. $detail->service_id);
        }

        DB::beginTransaction();
        $this->_serviceRequirementRepository->delete($id);
        DB::commit();

        return redirect('cms/layanan/detail/'. $detail->service_id)->with('message', 'Persyaratan berhasil dihapus');
    }

    /**
     * Get data the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function getdata_requirement($id){

        $response   = array('status' => 0, 'result' => array()); 
        $getDetail  = $this->_serviceRequirementRepository->getById($id);

        if ($getDetail) {
            $response['status'] = 1;
            $response['result'] = $getDetail;
        }

        return $response;
    }
}
