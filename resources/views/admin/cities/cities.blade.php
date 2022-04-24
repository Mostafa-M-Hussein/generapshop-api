@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">{{ __('Tags') }}</div>


                    <div class="card-body">


                        <div class="row">

                            @foreach($cities  as $city )
                                <div class="col-md-3">

                                    <div class="alert alert-primary">
                                        <p> <strong>City name : </strong>{{$city->name }}  </p>
                                        <p> <strong>Country name : </strong>{{$city->country->name }}  </p>
                                        <p> <strong>State : </strong> {{$city->state->name }}  </p>

                                    </div>


                                </div>
                            @endforeach
                        </div>

                        {{$cities ->links('pagination::bootstrap-4') }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
