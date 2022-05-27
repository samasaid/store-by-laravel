@extends('layouts.admin')

@section('content')
@if ($errors->any())
    @foreach ($errors->all() as $error )

    @endforeach
@endif
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.brands')}}">  قيم الخصائص </a>
                            </li>
                            <li class="breadcrumb-item active">اضافة قيمة
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> اضافة قيمة </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.error')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.options.store') }}" method="POST"
                                          enctype="multipart/form-data">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i>بيانات القيمة </h4>
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">اسم القيمة</label>
                                                        <input type="text" value="" id="name"
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="name">
                                                               @error("name")
                                                               <span class="text-danger"> {{ $message }} </span>
                                                               @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> السعر</label>
                                                        <input type="text" value="" id="price"
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="price">
                                                               @error("price")
                                                               <span class="text-danger"> {{ $message }} </span>
                                                               @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اختر  الخاصية
                                                        </label>
                                                        <select name="attribute_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر الخاصية ">
                                                                @if($attributes && $attributes-> count() > 0)
                                                                    @foreach($attributes as $attribute)
                                                                        <option
                                                                            value="{{$attribute->id }}">{{$attribute->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('attribute_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اختر المنتج
                                                        </label>
                                                        <select name="product_id" class="select2 form-control">
                                                            <optgroup label="من فضلك أختر المنتج ">
                                                                @if($products && $products-> count() > 0)
                                                                    @foreach($products as $product)
                                                                        <option
                                                                            value="{{$product->id }}">{{$product->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('product_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
@endsection
