    @if ($logged_in_user->hasAllAccess())
        <x-utils.view-button :href="route('admin.quiz.show', $quiz)" />
    @endif



    @if ($logged_in_user->hasAllAccess())
        <x-utils.delete-button
            :href="route('admin.quiz.permanently-delete', $quiz)"
            :text="__('Delete')" />
    @endif
