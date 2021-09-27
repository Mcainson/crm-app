<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyCreated;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company)
    {
        Mail::to($company)->send(new CompanyCreated($company));
    }

}
