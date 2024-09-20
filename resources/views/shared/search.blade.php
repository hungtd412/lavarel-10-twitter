<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <div class="card-body">
        @if (Request::url() === url('/'))
        <form action="{{ route('dashboard') }}" method="GET">
            <input name="search" placeholder="..." class="form-control w-100" type="text">
            <button class="btn btn-dark mt-2">Search</button>
        </form>
        @elseif (Request::url() === url('/feed'))
        <form action="{{ route('feed') }}" method="GET">
            <input name="search" placeholder="..." class="form-control w-100" type="text">
            <button class="btn btn-dark mt-2">Search</button>
        </form>
        @endif
    </div>
</div>