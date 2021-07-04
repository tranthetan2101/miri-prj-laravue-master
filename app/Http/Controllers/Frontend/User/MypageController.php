<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAddrRequest;
use App\Repositories\CustomerAddrRepository;
use App\Repositories\CustomerDetailRepository;
use App\Repositories\OrderRepository;
use Auth;
use Illuminate\Http\Request;

/**
 * Class MypageController.
 */
class MypageController extends Controller
{
    /**
     * @var CustomerDetailRepository
     */
    protected $customerDetailRepository;

    /**
     * @var CustomerAddrRepository
     */
    protected $customerAddrRepository;

    /**
     * MypageController constructor.
     *
     * @param  CustomerDetailRepository  $customerDetailRepository
     * @param  CustomerAddrRepository    $customerAddrRepository
     */
    public function __construct(
        CustomerDetailRepository $customerDetailRepository,
        CustomerAddrRepository $customerAddrRepository,
        OrderRepository $orderRepository
    ) {

        $this->customerDetailRepository = $customerDetailRepository;
        $this->customerAddrRepository = $customerAddrRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * MypageController index
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (auth()->user()->isAdmin()) {
            return redirect('admin/dashboard');
        }
        $user = $this->customerDetailRepository->getByUser();
        $addres = $this->customerAddrRepository->getByUser();
        $orders = $this->orderRepository->getHistoryOrder();
        return view('frontend.mypage.index', compact('user', 'addres', 'orders'));
    }

    /**
     * MypageController update info customer
     *
     * @param Request $request
     * @return void
     */
    public function updateInfo(Request $request)
    {
        return $this->customerDetailRepository->updateInfo($request->all());
    }

    /**
     * MypageController update addr info customer
     *
     * @param Request $request
     * @return void
     */
    public function updateInfoAddr(Request $request)
    {
        $request->flash();
        $params = $request->all();
        $params['name'] = 'addr';
        unset($params['mode']);
        $this->customerDetailRepository->updateInfo($params);
        return redirect()->back();
    }

    /**
     * MypageController updateAddr ajax
     *
     * @param CustomerAddrRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateAddr(CustomerAddrRequest $request)
    {
        $request->flash();
        $params = $request->parameters();
        unset($params['mode']);
        ($params['id'] != '') ? $this->customerAddrRepository->update($params) : $this->customerAddrRepository->create($params);

        return redirect()->back();
    }

    public function cancelOrder(Request $request)
    {
        $order = $this->orderRepository->cancelOrder($request->id);
        // if ($order->payment_method != 'COD') {
        //     $response = \MoMoAIO::refund([
        //         'orderId' => '123',
        //         'requestId' => '999',
        //         'transId' => 321,
        //         'amount' => 50000,
        //     ])->send();
        // }
        return redirect()->back();
    }
}
