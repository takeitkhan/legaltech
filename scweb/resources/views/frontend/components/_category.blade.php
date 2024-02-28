<ul>
    <li class="bg-light py-2 text-center">Category List</li>
    @forelse($categories as $key => $category)
        <li><a href="{{ route('blogs', ['title' => $category->slug]) }}" class="text-decoration-none">{{ $category->title }}</a></li>
    @empty 
        <li>No categories found!</li>
    @endforelse
</ul>