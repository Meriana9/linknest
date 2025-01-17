<?php
// app/Exports/ContactsExport.php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContactsExport implements FromView
{
    public function view(): View
    {
        return view('exports.contacts', [
            'contacts' => Contact::where('user_id', auth()->id())->get()
        ]);
    }
}
