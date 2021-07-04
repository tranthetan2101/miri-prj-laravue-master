<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Announcement\UpdateAnnouncementRequest;
use App\Http\Requests\Backend\Announcement\StoreAnnouncementRequest;
use App\Models\Announcement;
//use App\Domains\Announcement\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use Illuminate\Http\Request;

/**
 * Class AnnouncementController.
 */
class AnnouncementController extends Controller
{
    /**
     * @var AnnouncementRepository
     */
    protected $announcementRepository;

    /**
     * AnnouncementController constructor.
     *
     * @param AnnouncementRepository $announcementRepository
     */
    public function __construct(AnnouncementRepository $announcementRepository)
    {
        $this->announcementRepository = $announcementRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.announcement.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.announcement.create');
    }

    /**
     * @param StoreAnnouncementRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $this->announcementRepository->create(
            $request->only(
                'message',
                'starts_at',
                'ends_at',
                'enabled'
            )
        );

        return redirect()->route('admin.announcement.index')->withFlashSuccess(__('The announcement was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Announcement $announcement
     *
     * @return mixed
     */
    public function edit(Request $request, Announcement $announcement)
    {
        return view('backend.announcement.edit')
            ->withTheAnnouncement($announcement);
    }

    /**
     * @param  UpdateAnnouncementRequest  $request
     * @param  Announcement $announcement
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $this->announcementRepository->update(
            $announcement,
            $request->only(
                'message',
                'starts_at',
                'ends_at',
                'enabled'
            )
        );

        return redirect()->route('admin.announcement.index')->withFlashSuccess(__('The announcement was successfully updated.'));

//        return redirect()->route('admin.announcement.show', $announcement)->withFlashSuccess(__('The announcement was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Announcement $announcement
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Request $request, Announcement $announcement)
    {
        $this->announcementRepository->delete($announcement);

        return redirect()->route('admin.announcement.index')->withFlashSuccess(__('The announcement was successfully deleted.'));
    }

    public function mark(Request $request, Announcement $announcement, $status)
    {
        $this->announcementRepository->mark($announcement, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
                'admin.announcement.index' :
                'admin.announcement.deactivated'
        )->withFlashSuccess(__('The announcement was successfully updated.'));
    }

    public function deactivated()
    {
        return view('backend.announcement.deactivated');
    }
}
