<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ReceiveInfosExport;
use App\Http\Controllers\Controller;
use App\Repositories\ReceiveInfoRepository;
use Excel;

//use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ReceiveInfoController.
 */
class ReceiveInfoController extends Controller
{
    /**
     * @var ReceiveInfoRepository
     */
    protected $receiveInfoRepository;

    /**
     * ReceiveInfoController constructor.
     *
     * @param ReceiveInfoRepository $receiveInfoRepository
     */
    public function __construct(ReceiveInfoRepository $receiveInfoRepository)
    {
        $this->receiveInfoRepository = $receiveInfoRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.receive_info.index');
    }

    public function export()
    {
        return Excel::download(new ReceiveInfosExport(), 'emails'.date("YmdHi").'.xlsx');
    }


}
