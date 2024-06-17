<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Date of Birth</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->first_name }}</td>
                <td>{{ $contact->last_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->date_of_birth }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
