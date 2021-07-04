<?php

use App\Http\Controllers\Backend\ContactController;
use App\Models\Contact;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.Contact'.
Route::group([
    'prefix' => 'contact',
    'as' => 'contact.',
//    'middleware' => config('boilerplate.access.middleware.confirm'),
], function () {
    Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin').'|'.config('boilerplate.access.role.moderator').'|'.config('boilerplate.access.role.editor'),
    ], function () {
        Route::get('/', [ContactController::class, 'index'])
            ->name('index')
//            ->middleware('permission:admin.access.user.list|admin.access.user.deactivate|admin.access.user.clear-session|admin.access.user.impersonate|admin.access.user.change-password')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.dashboard')
                    ->push(__('Contact Management'), route('admin.contact.index'));
            });

        Route::get('create', [ContactController::class, 'create'])
            ->name('create')
            ->breadcrumbs(function (Trail $trail) {
                $trail->parent('admin.contact.index')
                    ->push(__('Create Contact'), route('admin.contact.create'));
            });

        Route::post('/', [ContactController::class, 'store'])->name('store');

        Route::group(['prefix' => '{deletedContactId}'], function () {
            Route::delete('permanently-delete', [ContactController::class, 'destroy'])->name('permanently-delete');
        });


        Route::group(['prefix' => '{contact}'], function () {
            Route::get('edit', [ContactController::class, 'edit'])
                ->name('edit')
                ->breadcrumbs(function (Trail $trail, Contact $contact) {
                    $trail->parent('admin.contact.index')
                        ->push($contact->address)
                        ->push(__('Edit'), route('admin.contact.edit', $contact));

                });

            Route::patch('/', [ContactController::class, 'update'])->name('update');
        });

    });
});
