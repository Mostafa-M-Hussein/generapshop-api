@extends('layouts.app')



@section('content')
    <div class="container">
        @if(Session::has('message' )  )
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto text-success"> Sussecfully </strong>
                </div>
                <div class="toast-body ">
                    <p class="text-secondary"> {{Session::get('message')}}  </p>
                </div>
            </div>
        @endif

        <div class="row">
            <img src="storage/app/public/public/bcZDr444Gxow2gaPrJVKDImAdAgdVCYMQIviigv2.jpg" alt="">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">{{ __('Product') }}

                        <a class='btn btn-primary mx-2' href="{{route('new-product')}}"><i
                                class="bi bi-plus-circle"></i></a></div>


                    <div class="card-body">


                        <div class="row">
                            @foreach($products  as $product )
                                <div class="col-md-3">
                                    <div class="alert alert-primary">

                                        <h5> {{$product->title }} </h5>
                                        <p><strong> Category
                                                : </strong> {{   is_object ( $product->category  ) ?  $product->category->name : ""}}
                                        </p>
                                        <p><strong>Price : </strong> {{$product->price  }}
                                            <strong> {{$currency_code}} </strong></p>


                                        {!! ( count ( $product->images ) >  0 ? '<img   alt="" src="'.asset($product->images[0]->url ) .'" class="img-thumbnail " />'  : null ) !!}

                                        @if ( !is_null( $product->options  ) )
                                            @foreach($product->jsonOptions ()  as $key => $values )
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="{{$key}}"> {{ strtoupper( $key ) }} </label>
                                                        <select type="text" class="form-control" id="{{$key}}"
                                                                name="{{$key}}" placeholder="Option Value">
                                                            @foreach($values  as $value )
                                                                <option value="{{$value}}}">   {{$value}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach



                                        @endif
                                        <span>
                                            <a class='btn btn-success mx-1 my-2'
                                               href="{{route('update-product-form' , ["id" => $product->id ] )  }}">Update
                                            Product </a>

                                        <a href="" class="delete-prodcut btn btn-outline-danger"
                                           data-productid="{{$product->id }}"> <i
                                                class="bi bi-trash" style="color:red"></i></a>


                                         </span>

                                    </div>


                                </div>
                            @endforeach
                        </div>

                        {{$products->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="modal" id="delete-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete product </h5>
                    <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('products')}}" method="post">

                    <div class="modal-body">

                        <p id="delete_message"></p>
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="product_id" value="" id="product_id">

                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Delete</button>
                        <button type="button" onclick="window.closeModal() " class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('scripts')
    @if(Session::has('message') )
        <script>

            jQuery(document).ready(function ($) {
                var toast = $('.toast').toast(
                    {
                        autohide: true,
                        animation: true,
                        delay: 1000,
                    }
                );
                toast.toast('show');
            })
        </script>
    @endif


    <script>

        $(document).ready(function () {

            var deleteWindow = $("#delete-window");
            var deleteProdcut = $(".delete-prodcut");
            var message_body = $("#delete_message");
            var prodcutId_btn = $("#product_id");
            deleteProdcut.on("click", function (e) {
                e.preventDefault();
                message_body.text("Are u sure u want to delete this product ");
                deleteWindow.modal("show");
                var productID = $(this).data("productid");
                prodcutId_btn.val(productID);


            })
            window.closeModal = function () {
                $('#delete-window').modal('hide');
            }

        })

    </script>
@endsection

