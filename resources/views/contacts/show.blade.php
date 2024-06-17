@extends('templates.index')

@section('content')

    <div class="container mx-auto flex flex-wrap pb-12">
        <main class="w-full p-4">
            <div class="container mx-auto flex flex-col pb-12">
                <!-- Page de détail du contact -->
                <section class="w-full">
                    <section class="mb-20">
                        <div
                            class="bg-gradient-to-br from-gray-800 to-blue-300 rounded-lg shadow-xl p-6 transform transition duration-500 hover:scale-105 relative">
                            <!-- En-tête -->
                            <div class="flex items-center mb-6">
                                <div class="w-24 h-24 rounded-full overflow-hidden">
                                    <img class="w-full h-full object-cover"
                                        src="{{ $contact->profile_image ? asset('images/' . $contact->profile_image) : asset('images/profile-default.png') }}"
                                        alt="{{ $contact->first_name }} {{ $contact->last_name }}" />
                                </div>
                                <div class="ml-4 flex-1">
                                    <h2 class="text-3xl font-bold text-white">
                                        {{ $contact->first_name }} {{ $contact->last_name }}
                                    </h2>
                                </div>

                                <form action="{{ route('favorites.add', $contact->id) }}" method="POST"
                                    class="inline-block absolute top-4 right-4">
                                    @csrf
                                    <button class="favorite-btn" data-id="{{ $contact->id }}">
                                        <i class="{{ Auth::user()->favorites->contains($contact->id) ? 'fas fa-star text-yellow-500' : 'far fa-star text-gray-400' }}"></i>
                                    </button>
                                </form>

                            </div>

                            <!-- Détails du contact -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <strong class="text-white block">Téléphone:</strong>
                                        <span class="text-gray-300">{{ $contact->phone }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <strong class="text-white block">Email:</strong>
                                        <span class="text-gray-300">{{ $contact->email }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <strong class="text-white block">Adresse:</strong>
                                        <span class="text-gray-300">{{ $contact->address }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <strong class="text-white block">Ville:</strong>
                                        <span class="text-gray-300">{{ $contact->city }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <strong class="text-white block">Date de Naissance:</strong>
                                        <span class="text-gray-300">{{ $contact->date_of_birth }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <strong class="text-white block">Note:</strong>
                                        <span class="text-gray-300">{{ $contact->notes }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <strong class="text-white block">Company:</strong>
                                        <span class="text-gray-300">{{ $contact->company }}</span>
                                    </div>
                                </div>
                                <div class="col-span-1 md:col-span-2">
                                    <div class="mb-4">
                                        <strong class="text-white block">Catégories:</strong>
                                        <div class="flex flex-wrap mt-2">
                                            @foreach ($contact->categories as $category)
                                                <span
                                                    class="bg-blue-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="flex justify-end space-x-2 mt-4">
                                <a href="{{ route('contacts.edit', $contact->id) }}"
                                    class="text-white bg-blue-500 hover:bg-blue-700 rounded-full px-4 py-2 transition-colors duration-300">Modifier</a>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </main>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.favorite-btn').on('click', function() {
                var button = $(this);
                var contactId = button.data('id');
                $.ajax({
                    url: '/contacts/' + contactId + '/favorite',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.is_favorite) {
                            button.find('i').removeClass('far fa-star text-gray-400').addClass(
                                'fas fa-star text-yellow-500');
                        } else {
                            button.find('i').removeClass('fas fa-star text-yellow-500')
                                .addClass('far fa-star text-gray-400');
                        }
                    }
                });
            });
        });
    </script>
@endpush
