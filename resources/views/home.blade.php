@extends('layouts.app')

@section('content')
    <section id="" class="bg-default">
        <input type="hidden" name="" id="user_id" value="{{ auth()->user()->id }}">
        <div class="card">
            <div class="card-header bg-primary text-white">                
                Tickets {{ auth()->user()->name }}
            </div>
            <div id="app_vue" class="card-body">
                
            </div>
            <div class="card-footer"></div>
        </div>
    </section>
@endsection
