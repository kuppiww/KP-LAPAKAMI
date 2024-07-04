<?php

namespace Modules\Notification\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Notification\Repositories\NotificationRepository;
use Modules\Request\Repositories\RequestRepository;
use Modules\Request\Repositories\ServiceRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use DB;
use URL;


class NotificationController extends Controller
{
    public function __construct(){

        // Require Login
        $this->middleware('auth');

        $this->_notificationRepository = new NotificationRepository;
        $this->_requestRepository = new RequestRepository;
        $this->_serviceRepository = new ServiceRepository;

        $this->module      = "Request";
        $this->_logHelper  = new LogHelper;

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $id   = $user->user_id;

        $filter['requests.created_by'] = $id;

        $paging     = $request->input('page');

        // Pagging 
        $page       = array('start' => 0, 'limit' => 5);

        if (!empty($paging)) {
            $page['start'] = ($paging - 1) * $page['limit'];
            $nextPage      = $paging + 1;
        }
        else{
            $nextPage      = 2;
        }


        $notificationAll = $this->_notificationRepository->getAllByParamsPage($filter);
        $notifications   = $this->_notificationRepository->getAllByParamsPage($filter, $page);
        $total           = count($notificationAll);
        $total_page      = $total > 0 ? ceil($total / $page['limit']) : 0;

        // Last page
        if ($paging == $total_page) {
            $nextPage = 1;
        }

        // Current URL  
        $urlFull= url()->full();
        $current= URL::current();
        $parsed = parse_url($urlFull);

        $url    = $current .'?';
        $nextUrl= $current .'?page='. $nextPage;

        if (!empty($parsed['query'])) {
            $query = $parsed['query'];

            // Parsed URL
            parse_str($query, $params);
            
            if (!empty($paging)) {
                unset($params['page']);
            }
            
            $string = http_build_query($params);

            if (strpos($urlFull, '?') !== false) {
                $url = $current .'?'. $string .'&';
                $nextUrl= $current .'?page='. $nextPage .'&'. $string;
            }
            
        }

        // dd($notifications);

        return view('notification::index', compact('notifications', 'paging', 'total_page', 'total', 'url', 'total_page', 'nextUrl', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('notification::create');
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
        return view('notification::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $request['notification_is_read'] = true;
        
        //update read
        $this->_notificationRepository->update(DataHelper::_normalizeParams($request, false, true), $id);

        //get id
        $requests= $this->_notificationRepository->getById($id);

        $service_id = $requests->service_id;
        $request_id   = $requests->request_id;

       //get slug
       $service = $this->_serviceRepository->getById($service_id);

       $service_slug = $service->slug;

       return redirect('/user/layanan/'.$service_slug.'/lihat/'.$request_id);
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
