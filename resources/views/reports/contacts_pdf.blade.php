<!DOCTYPE html>
<html>

<head>
    <title>Rapport des Contacts</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
    </style>
</head>

<body>
    <h1>Rapport des Contacts</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Entreprise</th>
                <th>Date de Naissance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->address }}</td>
                    <td>{{ $contact->company }}</td>
                    <td>{{ $contact->date_of_birth }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
