@extends('layouts.app')


@section('content')
    <meta id="token" name="token" content="{{ csrf_token() }}">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        {!! !is_null($product) ?  'Update product <span class="product-header-title"> ' .$product->title.'</span>' : "new Product " !!}
                    </div>
                    <form
                        action="{{ ( !is_null ($product))  ?   route('update-product' ,  $product->id )  : route('new-product')   }}"
                        method="post" enctype="multipart/form-data">
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

                            {{--  Options --}}
                            <div class="form-group col-md-12">
                                <table id='options-table' class="table table-striped">
                                    @if ( !is_null( $product )  )
                                        @if (!is_null( $product->jsonOptions () ) )
                                            @foreach ( $product->jsonOptions ( ) as $optionName => $options     )
                                                @foreach( $options as $option )
                                                    <tbody>
                                                    <tr>
                                                        <td> {{ $optionName }} </td>
                                                        <td> {{ $option }} </td>
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
                                                <input type="hidden" name="options[]"
                                                       value="{{$optionName}}">
                                            @endforeach
                                        @endif
                                    @endif
                                </table>

                                <a href="" class="btn btn-primary add-option-btn"> Add Option </a>

                            </div>
                            {{--End options --}}


                            {{--Images --}}
                            <div class="form-group col-md-12 my-2">
                                <div class="row">
                                    @for ( $i = 0 ; $i < 6 ; $i++ )
                                        <div class="col-md-4 col-sm-12 mb-4">

                                            <div class="card image-card-upload text-center">

                                                @if (  !is_null($product) && !is_null ( $product->images )   && count ( $product->images ) > 0  )
                                                    @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                        <a href="" class="remove-image-upload"
                                                           style="display: inline-block"
                                                           data-imageid='{{$product->images[$i]->id }}'
                                                           data-fileid="image-{{$i}}" data-removeimg="removeimg-{{$i}}">
                                                            <i
                                                                class="bi bi-dash-circle"></i> </a>


                                                    @else

                                                        <a href="" class="remove-image-upload" style="display: none"
                                                           data-fileid="image-{{$i}}"> <i
                                                                class="bi bi-dash-circle"></i> </a>
                                                    @endif
                                                @endif

                                                <a href="" class="activate-image-upload" data-fileid="image-{{$i}}"
                                                   id="removeimg-{{$i}}">
                                                    @if (  !is_null($product) && !is_null ( $product->images )   && count ( $product->images ) > 0  )
                                                        @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                            '<img src="{{asset($product->images[$i]->url ) }}"
                                                                  id="{{'iimage-'.$i}}"
                                                                  class="card-img-top">'
                                                        @endif
                                                    @endif
                                                    <div class="card-body">
                                                        @if (   !is_null($product) && !is_null ( $product->images )   && count ( $product->images ) > 0  )
                                                            @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                                {{--     NOthing here right now --}}
                                                                <i class="bi bi-image" style="display: none"></i>

                                                            @else
                                                                <i class="bi bi-image"></i>
                                                            @endif
                                                        @else
                                                            <i class="bi bi-image"></i>

                                                        @endif
                                                    </div>
                                                </a>

                                                @if (   !is_null($product)&& !is_null ( $product->images )   && count ( $product->images ) > 0  )
                                                    @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                        <input name='product_images[]' type="file"
                                                               class="form-control images-files-upload"
                                                               id="image-{{$i}}"
                                                               value="{{ asset($product->images[$i]->url) }}">
                                                    @else
                                                        <input name='product_images[]' type="file"
                                                               class="form-control images-files-upload"
                                                               id="image-{{$i}}">
                                                    @endif
                                                @else
                                                    <input name='product_images[]' type="file"
                                                           class="form-control images-files-upload"
                                                           id="image-{{$i}}">
                                                @endif


                                            </div>

                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        {{--  END IMAGES --}}
                        <div class="form-group col-md-6  my-2">
                            <button type="submit" class="btn btn-outline-dark btn-block"> SAVE</button>
                        </div>


                    </form>

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
                var optionNameList = [];
            </script>

            <script>
                var imageDelete = '{!!  url(route('delete-image')) !!}';

            </script>
            @if (  !is_null($product) )
                @if ( !is_null($product->jsonOptions () ))
                    @foreach( $product->jsonOptions () as $optionName => $option )
                        <script>
                            optionNameList.push('{{$optionName}}')
                        </script>
                    @endforeach
                @endif
            @endif
            <script>

                $(document).ready(function () {

                    function readURL(input, imageid) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $("#" + imageid).attr('src', e.target.result);

                            };
                            reader.readAsDataURL(input.files[0]);
                        }


                    }

                    function resetFileUpload(fileUploadId, imageID, $eI, $eD) {
                        console.log()
                        $("#" + imageID).attr('src', '').remove();
                        $("#" + fileUploadId).val('');
                        $eI.fadeIn();
                        $eD.fadeOut();

                        document.getElementById(fileUploadId).value = '';


                    }


                    var $optionWindows = $('#options-window');
                    var $addOptionBtn = $(".add-option-btn");
                    var $activateImageUpload = $('.activate-image-upload');

                    //Working with images upload
                    $activateImageUpload.on('click', function (e) {
                        e.preventDefault();
                        var $me = $(this);
                        var fileUploadId = $(this).data('fileid');
                        $('#' + fileUploadId).trigger('click');
                        var imagetag = '<img src="" id="i' + fileUploadId + '" class="card-img-top" >';
                        $(this).append(imagetag);
                        $('#' + fileUploadId).on('change', function (e) {
                            readURL(this, 'i' + fileUploadId);
                            $me.find('i').fadeOut();
                            var $removeThisImage = $me.parent().find(".remove-image-upload");


                            $removeThisImage.on('click', function (e) {
                                e.preventDefault();
                                resetFileUpload(fileUploadId, 'i' + fileUploadId, $me.find('i'), $removeThisImage);
                            })

                        });


                    })


                    $('.remove-image-upload').on('click', function (e) {
                        e.preventDefault();
                        var $me = $(this);
                        var imageID = $me.data('imageid');

                        var fileUploadId = $(this).data('fileid');
                        var removeID = $(this).data('removeimg');
                        var $removeThisImage = $me.parent().find(".remove-image-upload");
                        resetFileUpload(fileUploadId, 'i' + fileUploadId, $("#" + removeID).find('i'), $removeThisImage);

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{route( 'delete-image' )}}",
                            data: {
                                image_id : imageID,

                            },

                            method: "post",
                            dataType: "json",
                            success: function (data) {
                                console.log(data);

                            },
                            error: function (data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            },


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
