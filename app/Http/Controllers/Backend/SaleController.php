<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Sale\UpdateSaleRequest;
use App\Http\Requests\Backend\Sale\StoreSaleRequest;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

/**
 * Class SaleController.
 */
class SaleController extends Controller
{
    /**
     * @var SaleRepository
     */
    protected $saleRepository;

    /**
     * SaleController constructor.
     *
     * @param SaleRepository $saleRepository
     */
    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.sale.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.sale.create');
    }

    /**
     * @param StoreSaleRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreSaleRequest $request)
    {
        $this->saleRepository->create(
            $request->only(
                'name',
                'period_start',
                'period_end',
                'sale_amount',
                'sale_items',
                'type'
            )
        );

        return redirect()->route('admin.sale.index')->withFlashSuccess(__('The sale was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Sale $sale
     *
     * @return mixed
     */
    public function edit(Request $request, Sale $sale)
    {
        return view('backend.sale.edit')
            ->withSale($sale);
    }

    /**
     * @param  UpdateSaleRequest  $request
     * @param  Sale $sale
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $this->saleRepository->update(
            $sale,
            $request->only(
                'name',
                'period_start',
                'period_end',
                'sale_amount',
                'sale_items',
                'type'
            )
        );

        return redirect()->route('admin.sale.index')->withFlashSuccess(__('The sale was successfully updated.'));

//        return redirect()->route('admin.sale.show', $sale)->withFlashSuccess(__('The sale was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Sale $sale
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Request $request, Sale $sale)
    {
        $this->saleRepository->delete($sale);

        return redirect()->route('admin.sale.deleted')->withFlashSuccess(__('The sale was successfully deleted.'));
    }

    /**
     * @param $deletedSaleId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedSaleId)
    {
        $deletedSale= Sale::withTrashed()->findOrFail($deletedSaleId);
        $this->saleRepository->destroy($deletedSale);

        return redirect()->route('admin.sale.deleted')->withFlashSuccess(__('The sale was permanently deleted.'));
    }

    public function deleted()
    {
        return view('backend.sale.deleted');
    }

    /**
     * @param $deletedSaleId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore($deletedSaleId)
    {
        $deletedSale= Sale::withTrashed()->findOrFail($deletedSaleId);
        $this->saleRepository->restore($deletedSale);

        return redirect()->route('admin.sale.index')->withFlashSuccess(__('The sale was successfully restored.'));
    }

}
