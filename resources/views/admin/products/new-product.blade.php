@extends('layouts.app')


@section('content')
    <div class="container">


        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header bg-secondary">
                        {!! !is_null($product) ?  'Update product <span class="product-header-title"> ' .$product->title.'</span>' : "new Product " !!}
                    </div>

                    <form
                        action="{{ ( !is_null ($product))  ?   route('update-product' , $product->id )  : route('new-product')   }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">


                            @if ( !is_null($product) )
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                            @endif


                            <div class="form-floating col-md-12">
                                <input type="text" class="form-control" id="product_title" name="product_title"
                                       placeholder="Product title"
                                       value="{{!is_null($product)  ? $product->title  : " "  }}" required>
                                <label for="unit_search"> Product title </label>

                            </div>


                            <div class="form-group my-2">
                                <label for="product_description"> Produc Description </label>

                                <textarea class="form-control" id="product_description" name="product_description"
                                          rows="10" cols="10">
                                        {{!is_null($product)  ? $product->description  : " "  }}
                                        </textarea>

                            </div>


                            <div class="form-group">

                                <label for="product_unit" hidden> Product Unit </label>
                                <select class="form-control" name="product_unit" id="product_unit" required>
                                    <option value=""> Select a Unit</option>

                                    @foreach( $units as $unit )
                                        <option
                                            value="{{$unit->id}}" {{!is_null($product)  && $product->hasUnit->id === $unit->id  ? "selected" : "" }}> {{$unit->formatted() }} </option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group my-2">

                                <label for="product_category" hidden> Product Category </label>
                                <select class="form-control" name="product_category" id="product_category" required>
                                    <option value=""> Select a Category</option>

                                    @foreach( $categories as $category )
                                        <option
                                            value="{{$category->id}}" {{!is_null($product)  && $product->category->id === $category->id  ? "selected" : "" }}> {{$category->name }} </option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-floating col-md-12 my-2">
                                <input type="number" class="form-control" step="any" id="prodcut_price"
                                       name="prodcut_price"
                                       placeholder="Product price"
                                       value="{{!is_null($product)  ? $product->price   :0  }}" required>
                                <label for="prodcut_price"> Product price </label>


                            </div>


                            <div class="form-floating col-md-6 my-2">
                                <input type="number" class="form-control" id="prodcut_total" name="prodcut_total"
                                       placeholder="Product total"
                                       value="{{!is_null($product)  ? $product->total   :0   }}" required>
                                <label for="prodcut_total"> Product total </label>


                            </div>


                            <div class="form-floating col-md-6 my-2">
                                <input type="number" class="form-control" id="product_discount" name="product_discount"
                                       placeholder="Product Discount"
                                       value="{{!is_null($product)  ? $product-> discount   : 0   }}" required>
                                <label for="product_discount"> Product Discount </label>

                            </div>


                            <div class="form-group col-md-12">

                                <table id='options-table' class="table table-striped">
                                    @if ( !is_null( $product )  )
                                        @if (!is_null( $product->jsonOptions () ) )

                                            @foreach ( $product->jsonOptions ( ) as $optionName => $options     )
                                                @foreach( $options as $option )
                                                    <tbody>
                                                    <tr>
                                                        <td>` {{ $optionName  }} `</td>
                                                        <td>` {{ $option }} `</td>
                                                        <td>
                                                            <a class="remove-option" href=""><i
                                                                    class="bi bi-dash-circle-dotted text-danger"></i>
                                                            </a>
                                                            <input type="hidden" name="{{$optionName}}[]"
                                                                   value="{{$option}}">

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                @endforeach

                                            @endforeach
                                        @endif
                                    @endif

                                </table>

                                <a href="" class="btn btn-primary add-option-btn"> Add Option </a>

                            </div>
                            {{--Images --}}

                            <div class="form-group col-md-12">

                                <div class="row">
                                    @for ( $i = 0 ; $i < 6 ; $i++ )
                                        <div class="col-md-4 col-sm-12 mb-2 my-2">

                                            <div class="card text-center image-card-upload">


                                                <a href="" class="">
                                                    <i class="fas fa-minus-circle remove-image-upload"></i>
                                                </a>

                                                <a href="#" class="activate-image-upload" data-fileid="image--{{$i}}">
                                                    <div class="card-body">
                                                        <i class="fas fa-image"> </i>

                                                    </div>
                                                </a>
                                                <input class="form-control images-files-upload"
                                                       name="product_images[]" type="file" id="image--{{$i}}">


                                            </div>

                                        </div>
                                    @endfor
                                </div>


                            </div>
                            {{--    END IMAGES --}}

                            <div class="form-group col-md-6  my-2">

                                <button type="submit" class="btn btn-outline-dark btn-block"> SAVE</button>

                            </div>


                        </div>

                    </form>

                </div>


            </div>


        </div>


    </div>

    </div>

@endsection
<div class="modal options-window" id="options-window" itabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Options </h5>
                <button type="button" onclick="window.closeModal() " class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body row">

                <div class="form-floating col-md-6">

                    <input type="text" class="form-control" id="option_name" name="option_name"
                           placeholder="Option Name" required>
                    <label for="option_name"> Option Name </label>

                </div>


                <div class="form-floating col-md-6 ">

                    <input type="text" class="form-control" id="option_value" name="option_value"
                           placeholder="Option Value" required>
                    <label for="option_value"> Option Value</label>


                </div>


            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary add-option-button">add option</button>
                <button type="button" onclick="window.closeModal() " class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
            </div>

        </div>
    </div>
</div>


@section('scripts')
    <script>

        $(document).ready(function () {

            var $optionWindows = $('#options-window');
            var $addOptionBtn = $(".add-option-btn");
            var $activateImageUpload = $('.activate-image-upload');

            function restFileUpload(fileUploadID, imageID, $eI, $eD) {

                $('#' + imageID).attr('src', '');
                $eI.fadeIn();
                $eD.fadeOut();
                fileUploadID.val('');


            }

            function readUrl(input, imageID) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {


                        $("#" + imageID).attr('src', e.target.result);

                    }
                    reader.readAsDataURL(input.files[0]);

                }
            }

            $activateImageUpload.on("click", function (e) {

                e.preventDefault();
                var fileUploadId = $(this).data("fileid");
                var me = $(this);
                $("#" + fileUploadId).trigger('click');
                var imageTag = '<img class="card-img-top"  id="i' + fileUploadId + '"  src="">'
                $(this).append(imageTag);

                $("#" + fileUploadId).on('change', function (e) {

                    readUrl(this, "i" + fileUploadId);
                    me.find('i').fadeOut();
                    var $removeThisImage = me.parent().find(".remove-image-upload");
                    $removeThisImage.fadeIn();
                    $removeThisImage.on("click", function (e) {
                        e.preventDefault();
                        restFileUpload('#' + fileUploadId, 'i' + fileUploadId, me.find('i'), $removeThisImage);


                    })


                });


            })


            $addOptionBtn.on('click', function (e) {

                e.preventDefault();

                $optionWindows.modal('show');
                window.closeModal = function () {
                    $('#options-window').modal('hide');


                }

            })


        })


        $(document).on('click', '.add-option-button', function (e) {
            e.preventDefault();
            var optionName = $("#option_name");
            var optionValue = $("#option_value");
            var optionTable = $('#options-table');
            var optionNameList = [];
            var optionsNameRow = "";
            if (optionName.val() === '') {
                alert('option value is required');
                return false;
            }
            if (optionValue.val() === '') {
                alert('option value is required');
                return false;
            }


            var optionRow = `
              <tbody>
                <tr>
                  <td>` + optionName.val() + `</td>
                  <td>` + optionValue.val() + `</td>
                  <td>
                <a class="remove-option" href="" ><i class="bi bi-dash-circle-dotted text-danger"></i> </a>
                <input type="hidden" name="` + optionName.val() + `[]" value="` + optionValue.val() + `">

                </td>
                </tr>
              </tbody>
            `;

            if (!optionNameList.includes(optionName.val())) {
                optionNameList.push(optionName.val());
                var optionsNameRow = `

                                            <td>
                                                <input type="hidden" name="options[]" value="` + optionName.val() + `">
                                            </td>

                                      `
            }

            optionTable.append(optionRow);
            optionTable.append(optionsNameRow);
            optionValue.val('');
            optionName.val('');


        })


        $(document).on('click', '.remove-option', function (e) {

            e.preventDefault();

            $(this).parent().parent().remove();


        })

    </script>
@endsection
