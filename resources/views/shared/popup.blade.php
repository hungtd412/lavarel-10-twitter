{{-- @if (session()->has('error')) --}}
{{-- <div class="modal modal-dismissible fade show bg-dark bg-opacity-25" tabindex="-1" aria-labelledby="modal-title"
    aria-hidden="true" style="display: block">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="modal-title">{{ session('error') }}</h5>
                <button class="btn btn-danger" data-dismiss="modal" type="button" data-bs-dismiss="modal"
                    aria-label="Close">X</button>
            </div>
        </div>
    </div>
</div> --}}
{{-- @endif --}}

@if (session()->has('error'))
<div class="alert alert-warning alert-dismissible fade show bg-danger" role="alert">
    {{session('error')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif