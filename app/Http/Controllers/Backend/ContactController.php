<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Contact\StoreContactRequest;
use App\Http\Requests\Backend\Contact\UpdateContactRequest;
use App\Models\Contact;
use App\Repositories\ContactRepositoy;
use Illuminate\Http\Request;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    /**
     * @var ContactRepositoy
     */
    protected $contactRepository;

    /**
     * ContactController constructor.
     *
     * @param ContactRepositoy $contactRepository
     */
    public function __construct(ContactRepositoy $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.contact.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.contact.create');
    }

    /**
     * @param StoreContactRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreContactRequest $request)
    {
        $this->contactRepository->create(
            $request->only(
                'address', 'email', 'phone_number', 'link', 'image', 'open_time', 'close_time', 'address_building','hotline','name','description'
            ),
            $request->has('image') ? $request->file('image') : false
        );

        return redirect()->route('admin.contact.index')->withFlashSuccess(__('The contact was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Contact $contact
     *
     * @return mixed
     */
    public function edit(Request $request, Contact $contact)
    {
        return view('backend.contact.edit')
            ->withContact($contact);
    }

    /**
     * @param  UpdateElementRequest  $request
     * @param  Contact $contact
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $this->contactRepository->update(
            $contact,
            $request->only(
                'address', 'email', 'phone_number', 'link', 'image', 'open_time', 'close_time', 'address_building','hotline','name','description'
            ),
            $request->has('image') ? $request->file('image') : false
        );

        return redirect()->route('admin.contact.index')->withFlashSuccess(__('The contact was successfully updated.'));

    }


    /**
     * @param $deletedContactId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedContactId)
    {
        $deletedContact= Contact::findOrFail($deletedContactId);
        $this->contactRepository->destroy($deletedContact);

        return redirect()->route('admin.contact.index')->withFlashSuccess(__('The contact was permanently deleted.'));
    }

}
