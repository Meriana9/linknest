{{-- resources/views/contacts/index.blade.php --}}

@extends('templates.index')

@section('title')
    Contacts
@stop

@section('content')
    <h2 class="text-2xl font-bold mb-4">Contacts</h2>
    @include('contacts._index', ['contacts' => $contacts])

    <div>{{ $contacts->links() }}</div>

@stop
