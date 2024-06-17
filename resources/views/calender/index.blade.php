@extends('templates.index')

@section('title', 'Calendrier')

@section('content')
    <div class="flex flex-row">
        <!-- Form Modal Placeholder -->
        <div class="w-1/4 pr-6">
            <div id="eventFormContainer">
                <!-- Modal for creating or modifying an event -->
                <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-4 text-center">
                        Ajouter/Modifier un événement
                    </h2>
                    <div id="error-message" class="hidden bg-red-500 text-white p-2 rounded mb-4"></div>
                    <form id="eventForm">
                        @csrf
                        <input type="hidden" id="eventId">
                        <div class="mb-4">
                            <label for="eventTitle" class="block mb-1 text-white">Titre</label>
                            <input type="text" id="eventTitle" name="title"
                                class="w-full border rounded px-3 py-2 text-gray-700" placeholder="Titre de l'événement">
                        </div>
                        <div class="mb-4">
                            <label for="eventStartDate" class="block mb-1 text-white">Date de début</label>
                            <input type="datetime-local" id="eventStartDate" name="start_date"
                                class="w-full border rounded px-3 py-2 text-gray-700">
                        </div>
                        <div class="mb-4">
                            <label for="eventEndDate" class="block mb-1 text-white">Date de fin</label>
                            <input type="datetime-local" id="eventEndDate" name="end_date"
                                class="w-full border rounded px-3 py-2 text-gray-700">
                        </div>
                        <div class="flex justify-between">
                            <button type="submit" class="bg-blue-400 text-white px-2 py-2 rounded-lg shadow-lg">
                                Enregistrer
                            </button>
                            <button type="button" id="deleteEvent"
                                class="bg-red-500 text-white px-2 py-2 rounded-lg shadow-lg" style="display:none;">
                                Supprimer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Calendar -->
        <div class="w-3/4 pl-4">
            <div id="calendar" class="shadow-lg bg-opacity-50 bg-gray-700 rounded-lg p-5"></div>
        </div>
    </div>
@endsection

@section('hideAside', true)

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events',
                dateClick: function(info) {
                    $('#eventId').val('');
                    $('#eventTitle').val('');
                    $('#eventStartDate').val(info.dateStr + 'T00:00');
                    $('#eventEndDate').val(info.dateStr + 'T00:00');
                    $('#deleteEvent').hide();
                },
                eventClick: function(info) {
                    $('#eventId').val(info.event.id);
                    $('#eventTitle').val(info.event.title);
                    $('#eventStartDate').val(info.event.startStr);
                    $('#eventEndDate').val(info.event.endStr ? info.event.endStr : info.event.startStr);
                    $('#deleteEvent').show().off('click').on('click', function() {
                        if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
                            deleteEvent(info.event);
                        }
                    });
                }
            });

            calendar.render();

            $('#eventForm').on('submit', function(e) {
                e.preventDefault();

                var eventId = $('#eventId').val();
                var title = $('#eventTitle').val();
                var startDate = $('#eventStartDate').val();
                var endDate = $('#eventEndDate').val();

                var eventData = {
                    title: title,
                    start_date: startDate,
                    end_date: endDate
                };

                if (eventId) {
                    updateEvent(eventId, eventData);
                } else {
                    createEvent(eventData);
                }
            });

            function createEvent(eventData) {
                $.ajax({
                    url: '{{ route('events.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ...eventData
                    },
                    success: function(response) {
                        calendar.refetchEvents();
                        $('#error-message').hide(); // Cache le message d'erreur en cas de succès
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseJSON.errors);
                        var errorMessage = "Veuillez bien remplir les données.";
                        if (xhr.responseJSON.errors) {
                            errorMessage += " " + Object.values(xhr.responseJSON.errors).join(" ");
                        }
                        $('#error-message').text(errorMessage).show(); // Affiche le message d'erreur
                    }
                });
            }

            function updateEvent(eventId, eventData) {
                $.ajax({
                    url: '/events/' + eventId,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ...eventData
                    },
                    success: function(response) {
                        calendar.refetchEvents();
                        $('#error-message').hide(); // Cache le message d'erreur en cas de succès
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseJSON.errors);
                        var errorMessage = "Veuillez bien remplir les données.";
                        if (xhr.responseJSON.errors) {
                            errorMessage += " " + Object.values(xhr.responseJSON.errors).join(" ");
                        }
                        $('#error-message').text(errorMessage).show(); // Affiche le message d'erreur
                    }
                });
            }

            function deleteEvent(event) {
                $.ajax({
                    url: '/events/' + event.id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        calendar.refetchEvents();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>
@endpush
