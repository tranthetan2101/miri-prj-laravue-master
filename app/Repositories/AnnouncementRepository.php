<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
//use App\Domains\Announcement\Models\Announcement;
use App\Models\Announcement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class AnnouncementRepository.
 */
class AnnouncementRepository extends BaseRepository
{
    /**
     * AnnouncementRepository constructor.
     *
     * @param  Announcement  $model
     */
    public function __construct(Announcement $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Announcement
    {
        return DB::transaction(
            function () use ($data) {
                $announcement = $this->model::create(
                    [
                        'message' => $data['message'],
                        'starts_at' => timezone()->convertFromLocal($data['starts_at']),
                        'ends_at' => timezone()->convertFromLocal($data['ends_at']),
                        'enabled' => isset($data['enabled']) && $data['enabled'] == 1,
                    ]
                );
                return $announcement;
            }
        );
    }

    public function update(Announcement $announcement, array $data)
    {
        return DB::transaction(
            function () use ($announcement, $data) {
                if ($announcement->update(
                    [
                            'message' => $data['message'],
                            'starts_at' => timezone()->convertFromLocal($data['starts_at']),
                            'ends_at' => timezone()->convertFromLocal($data['ends_at']),
                            'enabled' => isset($data['enabled']) && $data['enabled'] == 1,
                    ]
                )) {
                    return $announcement;
                }

                throw new GeneralException(__('Update Announcement Error'));
            }
        );
    }

    /**
     * @param Announcement $announcement
     * @return Announcement
     * @throws GeneralException
     */
    public function delete(Announcement $announcement): Announcement
    {
        if ($this->deleteById($announcement->id)) {
            return $announcement;
        }

        throw new GeneralException('There was a problem deleting this announcement. Please try again.');
    }

    /**
     * @param Announcement $announcement
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Announcement $announcement): bool
    {
        if ($announcement->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this announcement. Please try again.'));
    }


    /**
     * @param  Announcement $announcement
     *
     * @throws GeneralException
     * @return  Announcement
     */
    public function restore( Announcement $announcement):  Announcement
    {
        if ($announcement->restore()) {
            return $announcement;
        }

        throw new GeneralException(__('There was a problem restoring this announcement. Please try again.'));
    }

    public function mark(Announcement $announcement, $status): Announcement
    {
        $announcement->enabled = $status;
        if ($announcement->save()) {
            return $announcement;
        }
        throw new GeneralException(__('There was a problem updating this announcement. Please try again.'));
    }
}
