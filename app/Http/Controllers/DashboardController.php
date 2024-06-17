<?php

// DashboardController.php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

        public function statistics()
        {
            $userId = Auth::id();

            // Récupérer les contacts par mois pour l'utilisateur authentifié
            $contactsPerMonth = Contact::where('user_id', $userId)
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->pluck('count', 'month');

            // Récupérer les contacts par catégorie pour l'utilisateur authentifié
            $contactsPerCategory = Contact::where('user_id', $userId)
                ->with('categories')
                ->get()
                ->flatMap->categories
                ->groupBy('name')
                ->map->count();

            return view('dashboard.statistics', compact('contactsPerMonth', 'contactsPerCategory'));
        }
}
