<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;
use DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Nombre total de contacts
        $totalContacts = Contact::where('user_id', $userId)->count();

        // Contacts ajoutés par mois
        $contactsByMonth = Contact::where('user_id', $userId)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->get();

        // Contacts les plus fréquemment contactés (par exemple, basés sur une table de logs d'interactions)
        $frequentlyContacted = DB::table('interaction_logs')
            ->join('contacts', 'interaction_logs.contact_id', '=', 'contacts.id')
            ->select('contacts.first_name', 'contacts.last_name', DB::raw('count(interaction_logs.id) as interactions'))
            ->where('interaction_logs.user_id', $userId)
            ->groupBy('contacts.first_name', 'contacts.last_name')
            ->orderBy('interactions', 'desc')
            ->take(5)
            ->get();

        // Préparer les données pour les graphiques
        $contactsByMonthLabels = $contactsByMonth->pluck('month');
        $contactsByMonthData = $contactsByMonth->pluck('count');

        $frequentlyContactedLabels = $frequentlyContacted->map(function($contact) {
            return $contact->first_name . ' ' . $contact->last_name;
        });
        $frequentlyContactedData = $frequentlyContacted->pluck('interactions');

        return view('analytics.index', compact(
            'totalContacts',
            'contactsByMonthLabels',
            'contactsByMonthData',
            'frequentlyContactedLabels',
            'frequentlyContactedData'
        ));
    }

}
