<!DOCTYPE html>
@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('message' )  )
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="mr-auto text-success">Sussecfully</strong>
                </div>
                <div class="toast-body ">
                    <p class="text-secondary"> {{Session::get('message')}}  </p>
                </div>
            </div>
        @endif


        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">{{ __('Unit') }}</div>


                    <div class="card-body">

                        <form action="{{route('units')}}" method="post" class="row my-2">
                            @csrf
                            <div class="form-floating col-md-6">

                                <input type="text" class="form-control" id="unit_name" name="unit_name"
                                       placeholder="Unit Name" required>
                                <label for="unit_name"> Unit Name </label>

                            </div>


                            <div class="form-floating col-md-6">

                                <input type="text" class="form-control" id="unit_code" name="unit_code"
                                       placeholder="Unit Code " required>
                                <label for="unit_code"> Unit Code </label>


                            </div>


                            <div class="form-group col-md-12 my-3">

                                <button type="submit" class="btn btn-outline-primary">Save New Unit</button>

                            </div>


                        </form>


                        <div class="row">

                            @foreach($units as $unit )
                                <div class="col-md-3">

                                    <div class="alert alert-primary">
                            <span class="btns-span">


                                   <span>
                                        <a href="" class="edit-unit "
                                           data-unitcode="{{$unit->unit_code}}" data-unitname="{{$unit->unit_name}}"
                                           data-unitid="{{$unit->id}}"> <i class="bi bi-pencil"></i></a>
                                   </span>




                                    <span>
                                       <a href="" class="delete-unit" data-unitid="{{$unit->id }}"
                                          data-unitcode="{{$unit->unit_code}}" data-unitname="{{$unit->unit_name}}"> <i
                                               class="bi bi-trash "></i></a>
                                   </span>



                                    </span>


                                        <p> {{$unit->unit_name }} , {{$unit->unit_code }}  </p>

                                    </div>


                                </div>
                            @endforeach
                        </div>


                        <form action="{{route('search-units')}}"  method="get">
                            @csrf
                            <div class="row  my-2">
                                <div class="form-floating col-md-4">
                                    <input type="text" class="form-control" id="unit_search" name="unit_search"
                                           placeholder="Search Unit" required>
                                    <label for="unit_search"> Search Unit </label>
                                    <button type="submit" class="btn btn-outline-primary my-2"> SEARCH </button>

                                </div>

                            </div>

                        </form>



                        {{  is_null($showLinks)  && $showLinks ?  $units->links()  : '' }}

                    </div>
                </div>

            </div>
        </div>


    </div>




    <div class="modal" id="edit-window" itabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Unit </h5>
                    <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('units')}}" method="post">

                    <div class="modal-body">

                        @csrf
                        <div class="form-floating col-md-12">

                            <input type="text" class="form-control" id="edit_unit_name" name="unit_name"
                                   placeholder="Unit Name" required>
                            <label for="edit_unit_id"> Unit Name </label>

                        </div>


                        <div class="form-floating col-md-12 my-2">

                            <input type="text" class="form-control" id="edit_unit_code" name="unit_code"
                                   placeholder="Unit Code " required>
                            <label for="edit_unit_code"> Unit Code </label>


                        </div>


                        <input type="hidden" id="edit_unit_id" name="unit_id">
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




    <div class="modal" id="delete-window" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Unit </h5>
                    <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('units')}}" method="post">

                    <div class="modal-body">

                        <p id="delete_message"></p>
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="unit_id" value="" id="unit_id">

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
            var $deleteUnit = $('.delete-unit');

            var $deleteWindow = $('#delete-window');

            var $unit_id = $('#unit_id');

            var $deleteMessage = $('#delete_message');

            $deleteUnit.on('click', function (element) {

                element.preventDefault();
                var unitId = $(this).data('unitid');
                $unit_id.val(unitId);
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');

                $deleteMessage.text("Are your sure you want delte " + unitName + " " + "with code " + unitCode + " ? ");

                $deleteWindow.modal('show');

                window.closeModal = function () {
                    $('#delete-window').modal('hide');


                }


            })


            var $editUnitButton = $('.edit-unit');
            var $editWindow = $('#edit-window');

            var $edit_unit_id = $('#edit_unit_id');

            var $edit_unit_name = $('#edit_unit_name');

            var $edit_unit_code = $('#edit_unit_code');

            $editUnitButton.on('click', function (element) {

                element.preventDefault();
                $editWindow.modal('show');
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');
                var unitId = $(this).data('unitid');


                $edit_unit_name.val(unitName);
                $edit_unit_id.val(unitId);
                $edit_unit_code.val(unitCode);

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

