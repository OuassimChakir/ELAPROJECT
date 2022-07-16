@extends('layouts.layout')
@section('title')
    Niveaux Scolaires
@endsection
@section('content')
  <!--message success -->
  @if(session()->has('success'))
  <div class="alert alert-success">
      {{session()->get('success')}}
  </div>
@endif
  <!--errour du validation -->
                @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
     @endif
  <!-- end errour du validation -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Add Product</h1>
                <p class="breadcrumbs"><span><a href="{{route('admin.acceuil')}}">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product</p>
            </div>
            <div>
                <a href="product-list.html" class="btn btn-primary"> View All
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Add Product</h2>
                    </div>
                                    <!--message success -->
    @if(session()->has('success'))
      <div class="alert alert-success">
          {{session()->get('success')}}
      </div>
    @endif
      <!--errour du validation -->
                    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
         @endif
      <!-- end errour du validation -->

                    <div class="card-body">
                        <div class="row ec-vendor-uploads">
                            <div class="col-lg-4">
                                <div class="ec-vendor-img-upload">
                                    <div class="ec-vendor-main-img">
                                        <div class="avatar-upload">
                        <form method="POST" action="{{url('/prodact/dd/create')}}" 	enctype="multipart/form-data">					@csrf
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" 
                                                name="image" 
                                                class="ec-image-upload"
                                                    accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload"><img
                                                        src="{{asset('admin-assets/assets/img/icons/edit.svg')}}"
                                                        class="svg_img header_svg" alt="edit" /></label>
                                            </div>
                                            <div class="avatar-preview ec-preview">
                                                <div class="imagePreview ec-div-preview">
                                                    <img class="ec-image-preview"
                                                        src="{{asset('admin-assets/assets/img/products/vender-upload-preview.jpg')}}"
                                                        alt="edit" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="thumb-upload-set colo-md-12">
                                            
                                    
                                            <div class="thumb-upload">
                                                <div class="thumb-edit">
                                                    <input type='file' id="thumbUpload05"
                                                    name="images[]" 
                                                        class="ec-image-upload"
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload"><img
                                                            src="{{asset('admin-assets/assets/img/icons/edit.svg')}}"
                                                            class="svg_img header_svg" alt="edit" /></label>
                                                </div>
                                                <div class="thumb-preview ec-preview">
                                                    <div class="image-thumb-preview">
                                                        <img class="image-thumb-preview ec-image-preview"
                                                            src="{{asset('admin-assets/assets/img/products/vender-upload-thumb-preview.jpg')}}"
                                                            alt="edit" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="thumb-upload">
                                                <div class="thumb-edit">
                                                    <input type='file' id="thumbUpload06"
                                                    name="images[]"
                                                        class="ec-image-upload"
                                                        accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"><img
                                                            src="{{asset('admin-assets/assets/img/icons/edit.svg')}}"

                                                            class="svg_img header_svg" alt="edit" /></label>
                                                </div>
                                                <div class="thumb-preview ec-preview">
                                                    <div class="image-thumb-preview">
                                                        <img class="image-thumb-preview ec-image-preview"
                                                            src="{{asset('admin-assets/assets/img/products/vender-upload-thumb-preview.jpg')}}"
                                                            alt="edit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>								
                            <div class="col-lg-8">
                                <div class="ec-vendor-upload-detail">
                                    
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Product name</label>
                                            <input type="text" class="form-control slug-title" id="inputEmail4" name="libelle">
                                        </div><br>
                                        <div class="col-md-6">
                                            <label class="form-label">Select Categories</label>
                                            <select name="parent_category" id="id-category" class="form-select">
                            
  <!--traitement de category->subcategory-> sub-subcategory--->
                                            
        <option>{{ trans('global.pleaseSelect') }}</option>
        @foreach($categories as $category)
            <option value="{{ $category->idCategories }}" >{{ $category->designation }}</option>
            @foreach($category->childCategories as $childCategory)
                <option value="{{ $childCategory->idCategories }}">-- {{ $childCategory->designation }}
                </option>
                @foreach($childCategory->childCategories as $child)
                       <option value="{{ $child->idCategories }}" >--- {{ $child->designation }}
                       </option>
                @endforeach
            @endforeach
        @endforeach
                                            </select>
                                        </div><br>
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" rows="2" name="descriptionArticle"></textarea>
                                        </div><BR>

                                    <form class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Prix <span>( In DH
                                                )</span></label>
                                            <input type="number" name="prix" class="form-control" id="price1">
                                        </div><br>
                                        <div class="col-md-6">
                                            <label class="form-label">Quantity</label>
                                            <input type="number" name="qteStock" class="form-control" id="quantity1">
                                        </div>						
                                                
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Tracking Detail -->
                <div class="card my-9 mb-3">
                    <div class="card-header card-header-border-bottom">
                        <h2>Information du article</h2>
                    </div>
                    <div class="card-body"> 
                        <div
                            class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
<div class="row">
<div class="col-lg-12">
<div id="inputFormRow">
    <div class="input-group row mb-3">
        <input type="hidden" name="lastId" value="">             
        <input type="text" name="item[]" class="form-control col-sm-6" placeholder="Enter Item" autocomplete="off" multiple>
        <input type="text" name="value[]" class="form-control col-sm-6" placeholder="Enter Value" autocomplete="off" multiple>
    </div>
</div>
<div id="newRow"></div>
<button id="addRow" type="button" class="btn btn-info">Add Row</button>     <button type="submit" class="btn btn-primary">Submit</button>											
</div>
</div>
</div>


                                
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
</div> <!-- End Content Wrapper -->
@endsection