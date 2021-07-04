<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Combo\UpdateComboRequest;
use App\Http\Requests\Backend\Combo\StoreComboRequest;
use App\Models\Combo;
use App\Repositories\ComboRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class ComboController.
 */
class ComboController extends Controller
{
    /**
     * @var ComboRepository
     */
    protected $comboRepository;
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * ComboController constructor.
     *
     * @param ComboRepository $comboRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ComboRepository $comboRepository, CategoryRepository $categoryRepository)
    {
        $this->comboRepository = $comboRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.combo.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.combo.create')->withCategories($this->categoryRepository->all());
    }

    /**
     * @param StoreComboRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreComboRequest $request)
    {
        $this->comboRepository->create(
            $request->only(
                'name',
                'slug',
                'description',
                'category_id',
                'sku',
                'stock',
                'price',
                'product_id',
                'image',
                'discount_price'
            )
        );

        return redirect()->route('admin.combo.index')->withFlashSuccess(__('The combo was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Combo $combo
     *
     * @return mixed
     */
    public function edit(Request $request, Combo $combo)
    {
        return view('backend.combo.edit')
            ->withCombo($combo)->withCategories($this->categoryRepository->all());
    }

    /**
     * @param  UpdateComboRequest  $request
     * @param  Combo $combo
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateComboRequest $request, Combo $combo)
    {
        $this->comboRepository->update(
            $combo,
            $request->only(
                'name',
                'slug',
                'description',
                'category_id',
                'sku',
                'stock',
                'image',
                'price',
                'product_id',
                'discount_price'
            )
        );

        return redirect()->route('admin.combo.index')->withFlashSuccess(__('The combo was successfully updated.'));

//        return redirect()->route('admin.combo.show', $combo)->withFlashSuccess(__('The combo was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Combo $combo
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Request $request, Combo $combo)
    {
        $this->comboRepository->delete($combo);

        return redirect()->route('admin.combo.index')->withFlashSuccess(__('The combo was successfully deleted.'));
    }
}
