<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Banner\StoreBannerRequest;
use App\Http\Requests\Backend\Banner\UpdateBannerRequest;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;

/**
 * Class BannerController.
 */
class BannerController extends Controller
{
    /**
     * @var BannerRepository
     */
    protected $bannerRepository;

    /**
     * BannerController constructor.
     *
     * @param BannerRepository $bannerRepository
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.banner.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * @param StoreBannerRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreBannerRequest $request)
    {
        $this->bannerRepository->create(
            $request->only(
                'url'
            ),
            $request->has('name') ? $request->file('name') : false
        );

        return redirect()->route('admin.banner.index')->withFlashSuccess(__('The banner was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Banner $banner
     *
     * @return mixed
     */
    public function edit(Request $request, Banner $banner)
    {
        return view('backend.banner.edit')
            ->withBanner($banner);
    }

    /**
     * @param  UpdateBannerRequest  $request
     * @param  Banner $banner
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $this->bannerRepository->update(
            $banner,
            $request->only(
                'url'
            ),
            $request->has('name') ? $request->file('name') : false
        );

        return redirect()->route('admin.banner.index')->withFlashSuccess(__('The banner was successfully updated.'));

    }


    /**
     * @param $deletedBannerId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedBannerId)
    {
        $deletedBanner= Banner::findOrFail($deletedBannerId);
        $this->bannerRepository->destroy($deletedBanner);

        return redirect()->route('admin.banner.index')->withFlashSuccess(__('The banner was permanently deleted.'));
    }

}
