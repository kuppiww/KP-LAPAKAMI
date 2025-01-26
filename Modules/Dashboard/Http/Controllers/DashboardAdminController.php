<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

use Modules\Request\Repositories\RequestRepository;


class DashboardAdminController extends Controller
{
    protected $_requestRepository;
    protected $module;

    public function __construct()
    {
        // Require Login
        $this->middleware('auth:admin');

        $this->_requestRepository   = new RequestRepository;

        $this->module  = "Dashboard";
    }

    public function admin()
    {

        $user = Auth::guard('admin')->user();

        $filter['requests.request_status_id'] = 'SUBMITED';

        $requests  = $this->_requestRepository->getSomeByParams(10, $filter);

        $filter['requests.request_status_id'] = 'SUBMITED';
        $counts['submitted'] = $this->_requestRepository->countByParams($filter);

        $filter['requests.request_status_id'] = 'VERIFIED';
        $counts['verified'] = $this->_requestRepository->countByParams($filter);

        $filter['requests.request_status_id'] = 'PROCCESS';
        $counts['proccess'] = $this->_requestRepository->countByParams($filter);

        $filter['requests.request_status_id'] = 'APPROVED';
        $counts['approved'] = $this->_requestRepository->countByParams($filter);

        return view('dashboard::admin', compact('requests', 'user', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
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
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
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
