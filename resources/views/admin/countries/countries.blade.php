@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">{{ __('Tags') }}</div>


                    <div class="card-body">


                        <div class="row">

                            @foreach($countries  as $country )
                                <div class="col-md-3">

                                    <div class="alert alert-primary">
                                        <p> <strong>Country name : </strong>{{$country->name }}  </p>
                                        <p> <strong>Country currency : </strong>{{$country->currency }}  </p>
                                        <p> <strong>Country capital : </strong>{{$country->capital }}  </p>

                                    </div>


                                </div>
                            @endforeach
                        </div>

                        {{$countries ->links('pagination::bootstrap-4') }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
