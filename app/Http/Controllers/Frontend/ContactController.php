<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Mail\Frontend\Contact\SendContact;
use App\Repositories\ContactRepository;
use Illuminate\Support\Facades\Mail;

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
     * @param  ContactRepositoy  $userService
     */
    public function __construct(ContactRepository  $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }
    
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contacts = $this->contactRepository->all();
        return view('frontend.contact.index', compact('contacts'));
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(SendContactRequest $request)
    {
        Mail::send(new SendContact($request));

        return redirect()->back()->withFlashSuccess(__('alerts.frontend.contact.sent'));
    }
}