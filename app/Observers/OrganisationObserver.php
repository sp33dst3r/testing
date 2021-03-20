<?php

namespace App\Observers;

use App\Organisation;

use App\Mail\OrganisationHandler;
use Illuminate\Support\Facades\Mail;

class OrganisationObserver
{
    /**
     * Handle the organisation "created" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function created(Organisation $organisation)
    {
        try {
            Mail::to($organisation->owner->email)->send(new OrganisationHandler($organisation));
        } catch (\Exception $e) {
        }
    }
}
