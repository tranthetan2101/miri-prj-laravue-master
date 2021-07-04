<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class CategoryController.
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.category.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * @param StoreCategoryRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->create(
            $request->only(
                'name',
                'slug',
                'visible'
            ),
            $request->has('icon') ? $request->file('icon') : false,
            $request->has('image') ? $request->file('image') : false
        );

        return redirect()->route('admin.category.index')->withFlashSuccess(__('alerts.backend.category.created'));
    }

    /**
     * @param  Request  $request
     * @param  Category $category
     *
     * @return mixed
     */
    public function edit(Request $request, Category $category)
    {
        return view('backend.category.edit')
            ->withCategory($category);
    }

    /**
     * @param  UpdateCategoryRequest  $request
     * @param  Category $category
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryRepository->update(
            $category,
            $request->only(
                'name',
                'slug',
                'visible'
            ),
            $request->has('icon') ? $request->file('icon') : false,
            $request->has('image') ? $request->file('image') : false
        );

        return redirect()->route('admin.category.index')->withFlashSuccess(__('The category was successfully updated.'));

//        return redirect()->route('admin.category.show', $category)->withFlashSuccess(__('The category was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Category $category
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Request $request, Category $category)
    {
        $this->categoryRepository->delete($category);

        return redirect()->route('admin.category.deleted')->withFlashSuccess(__('The category was successfully deleted.'));
    }

    /**
     * @param $deletedCategoryId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedCategoryId)
    {
        $deletedCategory= Category::withTrashed()->findOrFail($deletedCategoryId);
        $this->categoryRepository->destroy($deletedCategory);

        return redirect()->route('admin.category.deleted')->withFlashSuccess(__('The category was permanently deleted.'));
    }

    public function deleted()
    {
        return view('backend.category.deleted');
    }

    /**
     * @param  Request  $request
     * @param  Category  $user
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(Request $request, Category $category, $status)
    {
        $this->categoryRepository->mark($category, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
                'admin.category.index' :
                'admin.category.deactivated'
        )->withFlashSuccess(__('The category was successfully updated.'));
    }

    public function deactivated()
    {
        return view('backend.category.deactivated');
    }

    /**
     * @param $deletedCategoryId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore($deletedCategoryId)
    {
        $deletedCategory= Category::withTrashed()->findOrFail($deletedCategoryId);
        $this->categoryRepository->restore($deletedCategory);

        return redirect()->route('admin.category.index')->withFlashSuccess(__('The category was successfully restored.'));
    }
}
