<?php

namespace App\Http\Controllers;

use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use App\Models\Category;
use App\Models\Contact;
use App\Models\InteractionLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;



class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->contacts()->orderBy('created_at', 'DESC');

        if ($request->filled('company')) {
            $query->where('company', 'like', '%' . $request->input('company') . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->input('city') . '%');
        }

        if ($request->filled('date_of_birth')) {
            $query->whereDate('date_of_birth', $request->input('date_of_birth'));
        }

        $contacts = $query->paginate(9);
        $categoriesWithContacts = Category::with('contacts')->get();

        return view('contacts.index', compact('contacts', 'categoriesWithContacts'));
    }
    public function create()
{
    $categories = Category::all();
    return view('contacts.create', compact('categories'));
    }
    public function show(Contact $contact)
    {
        // Log interaction for viewing the contact
        $this->logInteraction($contact->id, 'view');
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $categories = Category::all();
        $contactCategories = $contact->categories->pluck('id')->toArray();
        return view('contacts.edit', compact('contact', 'categories', 'contactCategories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:contacts',
        'phone' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'notes' => 'nullable|string',
        'profile_image' => 'nullable|string|max:255',
        'last_contacted_at' => 'nullable|date',
        'categories' => 'array',
        'categories.*' => 'exists:categories,id',
    ]);

    // Créer une nouvelle instance de contact
    $contact = new Contact($request->all());
 /*    $contact->first_name = $validatedData['first_name'];
    $contact->last_name = $validatedData['last_name'];
    $contact->email = $validatedData['email'];
    $contact->phone = $validatedData['phone'];
    $contact->address = $validatedData['address'];
    $contact->city = $validatedData['city'];
    $contact->company = $validatedData['company'];
    $contact->date_of_birth = $validatedData['date_of_birth'];
    $contact->notes = $validatedData['notes'];
    $contact->profile_image = $validatedData['profile_image'];
    $contact->last_contacted_at = $validatedData['last_contacted_at']; */

    // Liaison du contact à l'utilisateur actuellement authentifié
    $contact->user_id = Auth::id();

    // Enregistrer le contact dans la base de données
    $contact->save();

    // Associer les catégories au contact
    if ($request->has('categories')) {
        $contact->categories()->sync($request->categories);
    }

    return redirect()->route('contacts.index')->with('success', 'Contact ajouté avec succès!');
    }

public function update(Request $request, Contact $contact)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:contacts,email,' . $contact->id,
        'phone' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
        'notes' => 'nullable|string',
        'profile_image' => 'nullable|string|max:255',
        'last_contacted_at' => 'nullable|date',
        'categories' => 'array',
        'categories.*' => 'exists:categories,id',
    ]);

    $contact->update($validatedData);
    if ($request->has('categories')) {
        $contact->categories()->sync($request->categories);
    }

    return redirect()->route('contacts.index')->with('success', 'Contact modifié avec succès!');
}
    public function destroy(Contact $contact)
    {

        if ($contact->user_id !== Auth::id()) {
          abort(403, 'Unauthorized action.');
      }else{

          $contact->delete();
      }

      return redirect()->route('contacts.index')->with('success', 'Contact supprimé avec succès!');
    }

    public function search(Request $request)
    {
        $query = $request->query('search');

        $contacts = Contact::where('user_id', Auth::id())
                            ->where(function ($queryBuilder) use ($query) {
                                $queryBuilder->where('first_name', 'LIKE', "%{$query}%")
                                ->orWhere('last_name', 'LIKE', "%{$query}%")
                                ->orWhere('email', 'LIKE', "%{$query}%")
                                ->orWhere('phone', 'LIKE', "%{$query}%")
                                ->orWhere('address', 'LIKE', "%{$query}%");
                            })
                            ->get();

        // Log interaction for each contact found
        foreach ($contacts as $contact) {
            $this->logInteraction($contact->id, 'search');
        }
        $contactsCount = $contacts->count();

        return view('contacts.search', [
            'contacts' => $contacts,
            'contactsCount' => $contactsCount,
            'query' => $query,
        ]);
    }


    public function favorite(Contact $contact)
    {
        $user = Auth::user();
        if (!$user->favorites->contains($contact->id)) {
            $user->favorites()->attach($contact->id);
            $isFavorite = true;
        } else {
            $user->favorites()->detach($contact->id);
            $isFavorite = false;
        }

        return response()->json(['is_favorite' => $isFavorite]);
    }


    public function unfavorite(Contact $contact)
    {
        Auth::user()->favorites()->detach($contact->id);
        return redirect()->back()->with('success', 'Contact retiré des favoris.');
    }
    public function filterByCategory(Category $category)
    {
        $user = Auth::user();
        $contacts = $category->contacts()->where('user_id', $user->id)->paginate(9);
        return view('contacts.index', compact('contacts'));
    }

    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }
    public function showImportForm()
    {
        return view('contacts.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new ContactsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Contacts imported successfully');
    }
    // Générer un rapport PDF
    public function generatePdfReport()
    {
        $contacts = Contact::where('user_id', auth()->id())->get();

        $pdf = PDF::loadView('reports.contacts_pdf', compact('contacts'));
        return $pdf->download('contacts_report.pdf');
    }

    // Générer un rapport Excel
    public function generateExcelReport()
    {
        return Excel::download(new ContactsExport, 'contacts_report.xlsx');
    }

    public function logInteraction($contactId, $type)
    {
        InteractionLog::create([
            'user_id' => auth()->id(),
            'contact_id' => $contactId,
            'type' => $type,
            'interaction_date' => Carbon::now(),
        ]);
    }
}
