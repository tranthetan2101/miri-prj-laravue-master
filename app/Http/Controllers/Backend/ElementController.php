<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Element\StoreElementRequest;
use App\Http\Requests\Backend\Element\UpdateElementRequest;
use App\Models\Element;
use App\Repositories\ElementRepository;
use Illuminate\Http\Request;

/**
 * Class ElementController.
 */
class ElementController extends Controller
{
    /**
     * @var ElementRepository
     */
    protected $elementRepository;

    /**
     * ElementController constructor.
     *
     * @param ElementRepository $elementRepository
     */
    public function __construct(ElementRepository $elementRepository)
    {
        $this->elementRepository = $elementRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.element.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.element.create');
    }

    /**
     * @param StoreElementRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreElementRequest $request)
    {
        $this->elementRepository->create(
            $request->only(
                'name', 'image', 'description'
            )
        );

        return redirect()->route('admin.element.index')->withFlashSuccess(__('The element was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Element $element
     *
     * @return mixed
     */
    public function edit(Request $request, Element $element)
    {
        return view('backend.element.edit')
            ->withElement($element);
    }

    /**
     * @param  UpdateElementRequest  $request
     * @param  Element $element
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateElementRequest $request, Element $element)
    {
        $this->elementRepository->update(
            $element,
            $request->only(
                'image','name','description'
            )
        );

        return redirect()->route('admin.element.index')->withFlashSuccess(__('The element was successfully updated.'));

    }


    /**
     * @param $deletedElementId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedElementId)
    {
        $deletedElement= Element::findOrFail($deletedElementId);
        $this->elementRepository->destroy($deletedElement);

        return redirect()->route('admin.element.index')->withFlashSuccess(__('The element was permanently deleted.'));
    }

}
