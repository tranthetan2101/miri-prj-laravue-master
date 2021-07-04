<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Coupon\StoreCouponRequest;
use App\Http\Requests\Backend\Coupon\UpdateCouponRequest;
use App\Models\Coupon;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;

/**
 * Class CouponController.
 */
class CouponController extends Controller
{
    /**
     * @var CouponRepository
     */
    protected $couponRepository;

    /**
     * CouponController constructor.
     *
     * @param CouponRepository $couponRepository
     */
    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.coupon.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.coupon.create');
    }

    /**
     * @param StoreCouponRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCouponRequest $request)
    {
        $this->couponRepository->create(
            $request->only(
                'code', 'price', 'name', 'period_start', 'period_end', 'open_time', 'used_num', 'used_num_unlimited'
            )
        );

        return redirect()->route('admin.coupon.index')->withFlashSuccess(__('The coupon was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Coupon $coupon
     *
     * @return mixed
     */
    public function edit(Request $request, Coupon $coupon)
    {
        return view('backend.coupon.edit')
            ->withCoupon($coupon);
    }

    /**
     * @param  UpdateCouponRequest  $request
     * @param  Coupon $coupon
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $this->couponRepository->update(
            $coupon,
            $request->only(
                'code', 'price', 'name', 'period_start', 'period_end', 'open_time', 'used_num', 'used_num_unlimited'
            )
        );

        return redirect()->route('admin.coupon.index')->withFlashSuccess(__('The coupon was successfully updated.'));

    }


    /**
     * @param $deletedCouponId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedCouponId)
    {
        $deletedCoupon= Coupon::findOrFail($deletedCouponId);
        $this->couponRepository->destroy($deletedCoupon);

        return redirect()->route('admin.coupon.index')->withFlashSuccess(__('The coupon was permanently deleted.'));
    }

}
