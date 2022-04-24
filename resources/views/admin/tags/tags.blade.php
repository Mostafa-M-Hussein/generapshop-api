@extends('layouts.app')


@section('content')
    <div class="container">
        @if(Session::has('message' )  )
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto text-black-50">Sussecfully</strong>
                </div>
                <div class="toast-body ">
                    <p class="text-secondary"> {{Session::get('message')}}  </p>
                </div>
            </div>
        @endif

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">{{ __('Tags') }}</div>


                    <div class="card-body">

                        <form action="{{route('tags')}}" method="post" class="row my-2">
                            @csrf
                            <div class="form-floating col-md-6">

                                <input type="text" class="form-control" id="tag_name" name="tag_name"
                                       placeholder="TagName" required>
                                <label for="tag_name"> TagName </label>

                            </div>


                            <div class="form-group col-md-12 my-3">

                                <button type="submit" class="btn btn-outline-primary">Save Tag </button>

                            </div>


                        </form>

                        <div class="row">

                            @foreach($tags  as $tag )
                                <div class="col-md-3">


                                    <div class="alert alert-primary">
                                                                    <span class="btns-span">


                                   <span>
                                        <a href="" class="edit-unit" data-tagname="{{$tag->tag}}"
                                           data-tagid="{{$tag->id}}"> <i class="bi bi-pencil"></i></a>
                                   </span>




                                    <span>
                                       <a href="" class="delete-unit" data-tagid="{{$tag->id}}"
                                       > <i class="bi bi-trash"></i></a>
                                   </span>



                                    </span>

                                        <p> {{$tag->tag }}  </p>
                                    </div>


                                </div>
                            @endforeach
                        </div>
                        <form action="{{route('search_tags')}}" method="post" class="row my-2">
                            @csrf
                            <div class="form-floating col-md-6">

                                <input type="text" class="form-control" id="tag_search" name="tag_search"
                                       placeholder="Tag Search" required>
                                <label for="tag_search"> Search </label>

                            </div>


                            <div class="form-group col-md-12 my-3">

                                <button type="submit" class="btn btn-outline-primary">Search</button>

                            </div>


                        </form>


                        {{  is_null($showLinks)  && $showLinks ?  $tag->links()  : '' }}

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal" id="delete-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete tag </h5>
                    <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('tags')}}" method="post">

                    <div class="modal-body">

                        <p id="delete_message"></p>
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="tag_id" value="" id="tag_id">

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

    <div class="modal" id="edit-window" itabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tag </h5>
                    <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('tags')}}" method="post">

                    <div class="modal-body">

                        @csrf
                        <div class="form-floating col-md-12">

                            <input type="text" class="form-control" id="edit_tag_name" name="tag_name"
                                   placeholder="Unit Name" required>
                            <label for="edit_tag_name"> Unit Name </label>

                        </div>


                        <input type="hidden" id="edit_tag_id" name="tag_id">
                        <input type="hidden" name="_method" value="PUT">


                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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

    <script>

        $(document).ready(function () {
            var $deleteUnit = $('.delete-unit');

            var $deleteWindow = $('#delete-window');

            var $tag_id = $('#tag_id');

            var $deleteMessage = $('#delete_message');

            $deleteUnit.on('click', function (element) {

                element.preventDefault();
                var tagID = $(this).data('tagid');
                $tag_id.val(tagID);

                $deleteMessage.text("Are your sure you want delete  this tag ! ");
                $deleteWindow.modal('show');

                window.closeModal = function () {
                    $('#delete-window').modal('hide');


                }


            })


            var $editTagButton = $('.edit-unit');
            var $editWindow = $('#edit-window');

            var $edit_tag_id = $('#edit_tag_id');

            var $edit_tag_name = $('#edit_tag_name');


            $editTagButton.on('click', function (element) {

                element.preventDefault();
                $editWindow.modal('show');
                var tagId = $(this).data('tagid');
                var tagName = $(this).data('tagname');
                $edit_tag_name.val(tagName);
                $edit_tag_id.val(tagId);
                window.closeModal = function () {
                    $('#edit-window').modal('hide');


                }


            })


        })


    </script>


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
@endsection
