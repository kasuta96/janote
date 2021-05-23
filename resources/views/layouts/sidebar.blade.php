<div class="bg-light border-right vh-100" id="sidebar-wrapper">
    <!-- <div class="sidebar-heading">Start Bootstrap </div> -->
    <div class="overflow-auto h-100 pt-3">

        <!-- Search Form -->
        <form id="" class="search-form mb-3">
            <input type="text" placeholder="Search">
            <button type="button"><i class="icon i-search"></i></button>
        </form>

        <!-- Add button -->
        <a class="btn btn-success btn-sm btn-block mb-2" href="{{ route('createNote') }}"><i class="icon i-plus"></i> {{ __('Note') }}</a>
        <a class="btn btn-success btn-sm btn-block mb-2" href=""><i class="icon i-plus"></i> {{ __('Categories') }}</a>

        <div class="list-group list-group-flush">
        <a href="{{ route('categories') }}" class="list-group-item list-group-item-action bg-light"><i class="icon i-folder"></i> {{ __('Categories') }}</a>
        <a href="{{ route('posts') }}" class="list-group-item list-group-item-action bg-light"><i class="icon i-twitch"></i> {{ __('Community') }}</a>
        <a href="{{ route('trashNote') }}" class="list-group-item list-group-item-action bg-light"><i class="icon i-trash"></i> {{ __('Trash') }}</a>
        </div>
    </div>
</div>