<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()->paginate(9);
        return view('favorites.index', compact('favorites'));
    }

    public function add(Contact $contact)
{
    $user = Auth::user();

    // Vérifier si le contact est déjà dans la liste des favoris de l'utilisateur
    if (!$user->favorites->contains($contact->id)) {
        // Ajouter le contact aux favoris de l'utilisateur
        $user->favorites()->attach($contact->id);
        return back()->with('success', 'Contact ajouté aux favoris.');
    }

    // Retourner un message d'info si le contact est déjà dans les favoris
    return back()->with('info', 'Ce contact est déjà dans vos favoris.');
}


    public function remove(Contact $contact)
    {
        Auth::user()->favorites()->detach($contact->id);
        return back()->with('success', 'Contact retiré des favoris.');
    }
}
