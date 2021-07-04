<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DeliveryFee\StoreDeliveryFeeRequest;
use App\Http\Requests\Backend\DeliveryFee\UpdateDeliveryFeeRequest;
use App\Models\DeliveryFee;
use App\Repositories\CityRepository;
use App\Repositories\DeliveryFeeRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\WardRepository;
use Illuminate\Http\Request;

/**
 * Class DeliveryFeeController.
 */
class DeliveryFeeController extends Controller
{
    /**
     * @var DeliveryFeeRepository
     */
    protected $deliveryFeeRepository;
    protected $cityRepository;
    protected $districtRepository;
    protected $wardRepository;

    /**
     * DeliveryFeeController constructor.
     *
     * @param DeliveryFeeRepository $deliveryFeeRepository
     */
    public function __construct(DeliveryFeeRepository $deliveryFeeRepository, CityRepository $cityRepository, DistrictRepository $districtRepository, WardRepository $wardRepository)
    {
        $this->deliveryFeeRepository = $deliveryFeeRepository;
        $this->cityRepository = $cityRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.delivery_fee.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.delivery_fee.create');
    }

    /**
     * @param StoreDeliveryFeeRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreDeliveryFeeRequest $request)
    {
        $this->deliveryFeeRepository->create(
            $request->only(
                'city_id', 'district_id', 'ward_id', 'fee'
            )
        );

        return redirect()->route('admin.delivery_fee.index')->withFlashSuccess(__('The delivery fee was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  DeliveryFee $delivery_fee
     *
     * @return mixed
     */
    public function edit(Request $request, DeliveryFee $delivery_fee)
    {
        return view('backend.delivery_fee.edit')
            ->withDeliveryFee($delivery_fee);
    }

    /**
     * @param  UpdateDeliveryFeeRequest  $request
     * @param  DeliveryFee $delivery_fee
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateDeliveryFeeRequest $request, DeliveryFee $delivery_fee)
    {
        $this->deliveryFeeRepository->update(
            $delivery_fee,
            $request->only(
                'city_id', 'district_id', 'ward_id', 'fee'
            )
        );

        return redirect()->route('admin.delivery_fee.index')->withFlashSuccess(__('The delivery fee was successfully updated.'));

    }


    /**
     * @param $deletedDeliveryFeeId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedDeliveryFeeId)
    {
        $deletedDeliveryFee= DeliveryFee::findOrFail($deletedDeliveryFeeId);
        $this->deliveryFeeRepository->destroy($deletedDeliveryFee);

        return redirect()->route('admin.delivery_fee.index')->withFlashSuccess(__('The delivery fee was permanently deleted.'));
    }

    public function ajaxLocations(Request $request)
    {
        $repo =  $request->get('type','city').'Repository';
        return response()->json($this->{$repo}->getPaginated(10,
            'id',
            'desc',
            $request->get('parent'),
            $request->get('q')));
    }

}
