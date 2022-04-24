@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">{{ __('Tags') }}</div>


                    <div class="card-body">


                        <div class="row">

                            @foreach($states  as $state )
                                <div class="col-md-3">

                                    <div class="alert alert-primary">
                                        <p> <strong>State  : </strong>{{$state->name }}  </p>
                                        <p> <strong>Country name : </strong>{{$state->country->name }}  </p>

                                    </div>


                                </div>
                            @endforeach
                        </div>

                        {{$states ->links('pagination::bootstrap-4') }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
