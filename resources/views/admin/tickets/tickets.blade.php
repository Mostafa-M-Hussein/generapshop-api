@extends('layouts.app')



@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Tickets') }}</div>


                    <div class="card-body">


                        <div class="row">

                            @foreach($tickets as $ticket )
                                <div class="col-md-3">

                                    <div class="alert alert-primary">
                                        {{--    <p> {{   $ticket->customer->user->id  }} </p>--}}

                                        <p>    <strong> Status:</strong>   {{$ticket->status }} </p>


                                        <p>    <strong> Title:</strong>  {{$ticket->title }} </p>


                                    </div>


                                </div>
                            @endforeach
                        </div>

                        {{$tickets->links('pagination::bootstrap-4') }}

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
