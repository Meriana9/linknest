<?php
// app/Imports/ContactsImport.php

// app/Imports/ContactsImport.php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date_format:Y-m-d',
        ]);
        $existingContact = Contact::where('user_id', Auth::id())
        ->where(function($query) use ($row) {
            $query->where('email', $row['email'])
                  ->orWhere('phone', $row['phone']);
        })
        ->first();

        if ($existingContact) {
            return null;
        }
        return new Contact([
            'user_id' => Auth::id(),
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'company' => $row['company'],
            'date_of_birth' => $row['date_of_birth'],
        ]);
    }
}
