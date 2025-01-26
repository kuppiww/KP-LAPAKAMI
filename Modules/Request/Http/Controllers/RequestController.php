<?php

namespace Modules\Request\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Repositories\RequestLogRepository;
use Modules\Request\Repositories\RequestAttachmentRepository;
use Modules\Request\Repositories\ServiceRepository;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use DB;

class RequestController extends Controller
{

    public function __construct()
    {

        // Require Login
        $this->middleware('auth');

        $this->_requestRepository               = new RequestRepository;
        $this->_requestLogRepository            = new RequestLogRepository;
        $this->_requestAttachmentRepository     = new RequestAttachmentRepository;
        $this->_serviceRepository               = new ServiceRepository;

        $this->module      = "Request";
        $this->_logHelper  = new LogHelper;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $filter['requests.created_by'] = $user->user_id;

        $services = $this->_serviceRepository->getAllByParams(['is_select' => true]);

        $requests  = $this->_requestRepository->getAllByParams($filter);

        return view('request::index', compact('requests', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {

        $user = Auth::user();

        // Validation for user profile and email verification
        if (!$user->user_is_comp_profile) {
            return redirect('user/profil')->with('error', 'Profil pengguna belum dilengkapi');
        }

        if ($user->user_email_is_change) {
            return redirect('user/profil')->with('error', 'Email pengguna telah berubah, harap melalukan verifikasi email');
        }

        // Get slug for routing
        $service = $this->_serviceRepository->getById($request->service_id);

        $service_slug = $service->slug;

        return redirect('/user/layanan/' . $service_slug . '/buat');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id, $service_id)
    {

        $service = $this->_serviceRepository->getById($service_id);

        $service_slug = $service->slug;

        // echo '/user/layanan/'.$service_slug.'/lihat/'.$id; exit;

        return redirect('/user/layanan/' . $service_slug . '/lihat/' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('request::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
