@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card maincard">
                <div class="card-header">Control Center</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary mr-4" role="button" href="{{route('messages.create')}}">Create Message</a>
                        <a class="btn btn-primary" role="button" href="{{route('messages.index')}}">View All Messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection