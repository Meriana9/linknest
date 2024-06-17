@extends('templates.index')

@section('title', 'Statistiques du Tableau de Bord')

@section('content')
    <div class="container mx-auto pt-20">
        <h2 class="text-2xl font-bold mb-4">Statistiques</h2>

        <div class="mb-4">
            <canvas id="contactsPerMonthChart"></canvas>
        </div>

        <div class="mb-4">
            <canvas id="contactsPerCategoryChart"></canvas>
        </div>
    </div>
@endsection

@section('hideAside', true)

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var contactsPerMonthCtx = document.getElementById('contactsPerMonthChart').getContext('2d');
            var contactsPerCategoryCtx = document.getElementById('contactsPerCategoryChart').getContext('2d');

            var contactsPerMonthData = @json($contactsPerMonth);
            var contactsPerCategoryData = @json($contactsPerCategory);

            new Chart(contactsPerMonthCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(contactsPerMonthData).map(month => `Month ${month}`),
                    datasets: [{
                        label: 'Contacts ajoutés par mois',
                        data: Object.values(contactsPerMonthData),
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

            new Chart(contactsPerCategoryCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(contactsPerCategoryData),
                    datasets: [{
                        label: 'Contacts par catégorie',
                        data: Object.values(contactsPerCategoryData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        });
    </script>
@endpush
