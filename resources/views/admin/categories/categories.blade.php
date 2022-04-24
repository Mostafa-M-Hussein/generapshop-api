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
                    <div class="card-header bg-secondary">{{ __('Categories') }}</div>


                    <div class="card-body">
                        <form action="{{route('categories')}}" method="post" class="row ">
                            @csrf
                            <div class="form-floating col-md-6  ">

                                <input type="text" class="form-control" id="category_name" name="category_name"
                                       placeholder="category Name" required>
                                <label for="category_name"> Category </label>

                            </div>


                            <div class="form-group col-md-12 my-3">

                                <button type="submit" class="btn btn-outline-primary">Save Category</button>

                            </div>


                        </form>


                        <div class="row">

                            @foreach($categories as $category )
                                <div class="col-md-3">

                                    <div class="alert alert-primary">

                                    <span class="btns-span">


                                   <span>
                                        <a href="" class="edit-unit "
                                           data-categoryname="{{$category->name}}" data-categoryid="{{$category->id}}"> <i
                                                class="bi bi-pencil"></i></a>
                                   </span>




                                    <span>
                                       <a href="" class="delete-category" data-categoryid="{{$category->id }}"
                                          data-categoryname="{{$category->name}}"> <i
                                               class="bi bi-trash "></i></a>
                                   </span>



                                    </span>


                                        <p> {{$category->name }} </p>
                                    </div>


                                </div>
                            @endforeach
                        </div>
                        <form action="{{route('search-categorie')}}" method="get" class="row my-2">
                            @csrf
                            <div class="form-floating col-md-6">

                                <input type="text" class="form-control" id="category_search" name="category_search"
                                       placeholder="Category Search" required>
                                <label for="tag_search"> Search </label>

                            </div>


                            <div class="form-group col-md-12 my-3">

                                <button type="submit" class="btn btn-outline-primary">Search</button>

                            </div>


                        </form>

                        {{ !is_null ($showLinks)  &&  $showLinks  ? $categories->links() : '' }}

                    </div>
                </div>

            </div>
        </div>
    </div>




    <div class="modal" id="edit-window" itabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category </h5>
                    <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <form action="{{route('categories')}}" method="post">

                    <div class="modal-body">

                        @csrf
                        <div class="form-floating col-md-12">

                            <input type="text" class="form-control" id="edit_category_name" name="category_name"
                                   placeholder="Unit Name" required>
                            <label for="edit_category_name"> Category Name </label>

                        </div>


                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="edit_category_id" name="category_id">


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

    <div class="modal" id="delete-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category </h5>
                    <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('categories')}}" method="post">

                    <div class="modal-body">

                        <p id="delete_message"></p>
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="category_id" value="" id="category_id">

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


    <script>
        $(document).ready(function () {
            var $deleteCategory = $('.delete-category');

            var $deleteWindow = $('#delete-window');

            var $category_id = $('#category_id');

            var $deleteMessage = $('#delete_message');

            $deleteCategory.on('click', function (element) {

                element.preventDefault();

                var CategoryName = $(this).data('categoryname');
                var CategoryId = $(this).data('categoryid');

                $deleteMessage.text("Are your sure you want delte " + CategoryName);

                $category_id.val(CategoryId);

                $deleteWindow.modal('show');

                window.closeModal = function () {
                    $('#delete-window').modal('hide');


                }


            })


            var $editUnitButton = $('.edit-unit');
            var $editWindow = $('#edit-window');

            var $edit_category_id = $('#edit_category_id');

            var $edit_category_name = $('#edit_category_name');


            $editUnitButton.on('click', function (element) {

                element.preventDefault();
                $editWindow.modal('show');


                var CategoryName = $(this).data('categoryname');
                var CategoryId = $(this).data('categoryid');


                $edit_category_id.val(CategoryId);
                $edit_category_name.val(CategoryName);


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
            @endif

        </script>
@endsection
