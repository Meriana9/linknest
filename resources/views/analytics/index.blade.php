@extends('templates.index')

@section('title', 'Analytique des Contacts')

@section('content')
    <div class="container mx-auto ">
        <h2 class="text-2xl font-bold mb-4">Analytique des Contacts</h2>

        <div class="mb-6">
            <h3 class="text-xl font-bold mb-2">Nombre total de contacts</h3>
            <p class="text-3xl">{{ $totalContacts }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-bold mb-2">Contacts ajoutés par mois</h3>
            <canvas id="contactsByMonthChart" class="bg-gray-100 bg-opacity-20"></canvas>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-bold mb-2">Contacts les plus fréquemment contactés</h3>
            <canvas id="frequentlyContactedChart" class="bg-gray-100 bg-opacity-20"></canvas>
        </div>
    </div>
@endsection

@section('hideAside', true)

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var contactsByMonthCtx = document.getElementById('contactsByMonthChart').getContext('2d');
            var contactsByMonthChart = new Chart(contactsByMonthCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($contactsByMonthLabels) !!},
                    datasets: [{
                        label: 'Contacts ajoutés',
                        data: {!! json_encode($contactsByMonthData) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var frequentlyContactedCtx = document.getElementById('frequentlyContactedChart').getContext('2d');
            var frequentlyContactedChart = new Chart(frequentlyContactedCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($frequentlyContactedLabels) !!},
                    datasets: [{
                        label: 'Interactions',
                        data: {!! json_encode($frequentlyContactedData) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
