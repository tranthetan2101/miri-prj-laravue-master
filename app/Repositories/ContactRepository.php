<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class ContactRepository.
 */
class ContactRepository extends BaseRepository
{
    /**
     * ContactRepositoy constructor.
     *
     * @param  Contact  $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     *
     * @return Contact
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data, $image = false): Contact
    {
        return DB::transaction(
            function () use ($data, $image) {
                $picture = null;
                if ($image) {
                    $picture = Storage::put('contact', $image);
                }
                $contact = $this->model::create(
                    [
                        'address' => $data['address'],
                        'email' => $data['email'],
                        'phone_number' => $data['phone_number'],
                        'link' => $data['link'],
                        'open_time' => $data['open_time'],
                        'close_time' => $data['close_time'],
                        'image' => $picture,
                        'address_building' => $data['address_building'],
                        'hotline' => $data['hotline'],
                        'name' => $data['name'],
                        'description' => $data['description'],
                    ]
                );

                if ($contact) {
                    return $contact;
                }

                throw new GeneralException(__('exceptions.backend.contact.create_error'));
            }
        );
    }

    public function update(Contact $contact, array $data, $image = false)
    {
        return DB::transaction(
            function () use ($contact, $data, $image) {
                $picture = $contact->image;
                if ($image) {
                    $picture = Storage::put('contact', $image);
                    // remove old avatar if there is new avatar uploaded
                    Storage::delete($contact->image);
                }
                if ($contact->update(
                    [
                        'address' => $data['address'],
                        'email' => $data['email'],
                        'phone_number' => $data['phone_number'],
                        'link' => $data['link'],
                        'open_time' => $data['open_time'],
                        'close_time' => $data['close_time'],
                        'image' => $picture,
                        'address_building' => $data['address_building'],
                        'hotline' => $data['hotline'],
                        'name' => $data['name'],
                        'description' => $data['description'],
                    ]
                )) {
                    return $contact;
                }

                throw new GeneralException(__('Update Contact Error'));
            }
        );
    }

    /**
     * @param Contact $contact
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Contact $contact): bool
    {
        if ($contact->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this contact. Please try again.'));
    }

}