<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use PDF;
class ReportController extends Controller
{
    public function generatePdfReport()
    {
        $contacts = Contact::where('user_id', auth()->id())->get();

        $pdf = PDF::loadView('reports.contacts_pdf', compact('contacts'));
        return $pdf->download('contacts_report.pdf');
    }
}
