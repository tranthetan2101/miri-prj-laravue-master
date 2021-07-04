<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Order\StoreOrderRequest;
use App\Http\Requests\Backend\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

/**
 * Class OrderController.
 */
class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * OrderController constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.order.index');
    }

    /**
     * @param  Request  $request
     * @param  Order $order
     *
     * @return mixed
     */
    public function edit(Request $request, Order $order)
    {
        return view('backend.order.edit')
            ->withOrder($order);
    }

    /**
     * @param  UpdateOrderRequest  $request
     * @param  Order $order
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $this->orderRepository->update(
            $order,
            $request->only(
                'name',
                'email',
                'phone_number',
                'receive_phone_number',
                'addr_number',
                'addr_street',
                'city_id',
                'district_id',
                'ward_id',
                'note',
                'order_status'
            )
        );

        return redirect()->route('admin.order.index')->withFlashSuccess(__('The order was successfully updated.'));
    }


    /**
     * @param  Request  $request
     * @param  Order  $user
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(Request $request, Order $order, $status)
    {
        $this->orderRepository->mark($order, (int) $status);
        $route = 'admin.order.index';
        switch ((int) $status)
        {
            case 0:
                $route = 'admin.order.pending';
                break;
            case 1:
                $route = 'admin.order.paid';
                break;
            case 2:
                $route = 'admin.order.shipping';
                break;
            case 3:
                $route = 'admin.order.completed';
                break;
        }
        return redirect()->route(
            $route
        )->withFlashSuccess(__('The order was successfully updated.'));
    }

    public function deactivated()
    {
        return view('backend.order.deactivated');
    }
    public function pending()
    {
        return view('backend.order.pending');
    }
    public function paid()
    {
        return view('backend.order.paid');
    }
    public function shipping()
    {
        return view('backend.order.shipping');
    }
    public function completed()
    {
        return view('backend.order.completed');
    }
    /**
     * @param  Order  $order
     *
     * @return mixed
     */
    public function show(Order $order)
    {
        return view('backend.order.show')
            ->withOrder($order);
    }
}
