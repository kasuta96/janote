<button type="button" class="btn btn-light btn-sm" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <i data-feather="more-horizontal"></i>
</button>
<div class="dropdown-menu" style="max-width: 300px;">
    <div class="dropdown-header">
        <a href="{{ route('editNote', $Note->id) }}" role="button" class="btn btn-primary btn-sm" title="{{ __('Edit') }}"><i data-feather="edit"></i></a>

        <form action="{{ route('deleteNote', $Note->id) }}" method="get" class="d-inline-block" onsubmit="return checkDelete()">
        @csrf
            <button type="submit" class="btn btn-primary btn-sm" title="{{ __('Delete') }}"><i data-feather="trash"></i></button>
        </form>
    </div>
    @if ($Note->hashtag)
    <div class="dropdown-divider"></div>
    <div class="px-3" style="max-width: 300px;">
    @foreach ($arr = explode(',',$Note->hashtag) as $val)
        <a href="{{ route('wordtag', $val) }}" class="badge rounded-pill my-1 p-2 bg-info text-white">{{ Config::get('hashtag')[App::getLocale()][$val] ?? '' }}</a>
    @endforeach
    </div>
    @endif
    <div class="dropdown-divider"></div>
    <div class="text-muted px-3">{{ (new App\Classes\General())->shortTime($Note->updated_at) }}</div>
</div>
