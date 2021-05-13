<div class="card sticky-top">
    <div class="card-body">
        @auth
        <div class="h5">{{ Auth::user()->name }}</div>
        <div class="h7 text-muted">email: {{ Auth::user()->email }}</div>
        @endauth
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="h6 text-muted">Pages</div>
            <div class="h5">5.2342</div>
        </li>
        <li class="list-group-item">
            <div class="h6 text-muted">Following</div>
            <div class="h5">6758</div>
        </li>
        <li class="list-group-item">Vestibulum at eros</li>
    </ul>
</div>