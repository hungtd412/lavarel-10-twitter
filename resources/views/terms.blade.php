@extends('layout.app')

@section('title', 'Terms')

@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.left-sidebar')
    </div>
    <div class="col-6">
        <h1>Terms</h1>
        <div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam
            repudiandae tempore culpa pariatur assumenda! Sequi optio
            tempore quas ipsam aliquam modi quo veritatis, vel qui facere?
            Dolorum perspiciatis iste voluptate.
        </div>
    </div>
    <div class="col-3">
        @include('shared.search')
        @include('shared.follow-box')
    </div>
</div>

@endsection