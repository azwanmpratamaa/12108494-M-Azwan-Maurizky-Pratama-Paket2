@extends('layouts._main')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 style="color: #3F51B5">
                            Dashboard
                        </h2>

                        <p>Welcome! <b>{{ Auth::user()->role}}</b></p>
                    </div>
            </div>
        </div>
    </div>
@endsection
