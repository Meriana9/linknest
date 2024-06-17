<div class="tag-cloud">
    @foreach ($tags as $tag)
        <a class="text-gray-300 hover:text-white" href="#"
            style="font-size: calc(1em + {{ count($tag->contacts) / 10 }}em)">
            {{ $tag->name }}
        </a>
    @endforeach
</div>
