<ul class="list-reset">
    @foreach ($categories as $category)
        <li>
            <a href="{{ route('contacts.filterByCategory', $category->id) }}">
                {{ $category->name }} <sup>({{ $category->contacts_count }})</sup>
            </a>
        </li>
    @endforeach
</ul>
