<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Banner;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class BannerRepository.
 */
class BannerRepository extends BaseRepository
{
    /**
     * BannerRepository constructor.
     *
     * @param  Banner  $model
     */
    public function __construct(Banner $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     *
     * @return Banner
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data, $image = false): Banner
    {
        return DB::transaction(
            function () use ($data, $image) {
                $picture = null;
                if ($image) {
                    $picture = Storage::put('banner', $image);
                }
                $banner = $this->model::create(
                    [
                        'url' => $data['url'],
                        'name' => $picture
                    ]
                );

                if ($banner) {
                    return $banner;
                }

                throw new GeneralException(__('exceptions.backend.banner.create_error'));
            }
        );
    }

    public function update(Banner $banner, array $data, $image = false)
    {
        return DB::transaction(
            function () use ($banner, $data, $image) {
                $picture = $banner->name;
                if ($image) {
                    $picture = Storage::put('banner', $image);
                    // remove old avatar if there is new avatar uploaded
                    Storage::delete($banner->name);
                }
                if ($banner->update(
                    [
                        'url' => $data['url'],
                        'name' => $picture
                    ]
                )) {
                    return $banner;
                }

                throw new GeneralException(__('Update Banner Error'));
            }
        );
    }

    /**
     * @param Banner $banner
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Banner $banner): bool
    {
        if ($banner->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this banner. Please try again.'));
    }
}
