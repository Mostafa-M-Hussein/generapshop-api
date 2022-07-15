@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">{{ __('Reviews') }}</div>


                    <div class="card-body">


                        <div class="row">

                            @foreach($reviews  as $review )
                                <div class="col-md-3">

                                    <div class="alert alert-primary">
                                        {{--       Error Here                                   --}}
                                        <p><strong>customer name  : </strong>{{$review->customer->FormatedName() }}  </p>
                                        <p><strong>title : </strong>{{$review->product->title }}  </p>

                                        <p><strong>reviews : </strong>{{$review->review }}  </p>
                                        <p><strong>Date : </strong>{{ $review-> humanFormattedDate()  }}  </p>

                                        @for( $i = 0;  $i < $review->starts ; $i++ )
                                            <i class="fas fa-star"></i>
                                        @endfor

                                        @for( $i = $review->starts ;  $i < 5 ; $i++ )

                                            <i class="far fa-star"></i>
                                        @endfor

                                    </div>


                                </div>
                            @endforeach
                        </div>

                        {{$reviews ->links('pagination::bootstrap-4') }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
