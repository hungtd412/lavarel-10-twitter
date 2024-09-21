<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">Top Users</h5>
    </div>
    <div class="card-body">
        @foreach ($topUsers as $user)
        <div class="hstack gap-2 mb-3">
            <div class="avatar">
                <a href="{{ route('users.show', $user->id) }}"><img class="avatar-img rounded-circle" style="width:50px"
                        src="{{ $user->getImageURL() }}" alt=""></a>
            </div>
            <div class="overflow-hidden">
                <a class="h6 mb-0" href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                <p class="mb-0 small text-truncate">{{ $user->email }}</p>
            </div>

            @if (Auth::check() && Auth::user()->follow($user))
            <form method="POST" action="{{ route('users.unfollow', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary-soft rounded-circle icon-md ms-auto"><i
                        class="fa-solid fa-xmark">
                    </i></button>
            </form>
            @else
            <form method="POST" action="{{ route('users.follow', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus">
                    </i></button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
</div>