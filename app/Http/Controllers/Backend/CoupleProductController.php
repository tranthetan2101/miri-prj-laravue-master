<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CoupleProduct\StoreCoupleProductRequest;
use App\Http\Requests\Backend\CoupleProduct\UpdateCoupleProductRequest;
use App\Models\CoupleProduct;
use App\Repositories\CoupleProductRepository;
use Illuminate\Http\Request;

/**
 * Class CoupleProductController.
 */
class CoupleProductController extends Controller
{
    /**
     * @var CoupleProductRepository
     */
    protected $coupleProductRepository;

    /**
     * CoupleProductController constructor.
     *
     * @param CoupleProductRepository $coupleProductRepository
     */
    public function __construct(CoupleProductRepository $coupleProductRepository)
    {
        $this->coupleProductRepository = $coupleProductRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.couple_product.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.couple_product.create');
    }

    /**
     * @param StoreCoupleProductRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCoupleProductRequest $request)
    {
        $this->coupleProductRepository->create(
            $request->only(
                'product1_id', 'product2_id'
            )
        );

        return redirect()->route('admin.couple_product.index')->withFlashSuccess(__('The couple product was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  CoupleProduct $couple_product
     *
     * @return mixed
     */
    public function edit(Request $request, CoupleProduct $couple_product)
    {
        return view('backend.couple_product.edit')
            ->withCoupleProduct($couple_product);
    }

    /**
     * @param  UpdateCoupleProductRequest  $request
     * @param  CoupleProduct $couple_product
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateCoupleProductRequest $request, CoupleProduct $couple_product)
    {
        $this->coupleProductRepository->update(
            $couple_product,
            $request->only(
                'product1_id', 'product2_id'
            )
        );

        return redirect()->route('admin.couple_product.index')->withFlashSuccess(__('The couple product was successfully updated.'));

    }


    /**
     * @param $deletedCoupleProductId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedCoupleProductId)
    {
        $deletedCoupleProduct= CoupleProduct::findOrFail($deletedCoupleProductId);
        $this->coupleProductRepository->destroy($deletedCoupleProduct);

        return redirect()->route('admin.couple_product.index')->withFlashSuccess(__('The couple product was permanently deleted.'));
    }

}
