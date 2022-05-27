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
                            <li class="breadcrumb-item"><a href="{{route('admin.tags')}}">  العلامات </a>
                            </li>
                            <li class="breadcrumb-item active">تعديل - {{ $tag->name }}
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
                                <h4 class="card-title" id="basic-layout-form"> تعديل الماركة التجارية </h4>
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
                                    <form class="form" action="{{ route('admin.tags.update' , $tag->id) }}" method="POST"
                                          enctype="multipart/form-data">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> العلامات </h4>
                                            @method('GET')
                                            @csrf
                                            <input type="hidden" value="{{ $tag->id }}">


                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">اسم العلامة</label>
                                                        <input type="text" value="{{ $tag->name }}" id="name"
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
                                                        <label for="projectinput1">وصف العلامة بالرابط </label>
                                                        <input type="text" value="{{ $tag->slug }}" id="slug"
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="slug">
                                                               @error("slug")
                                                               <span class="text-danger"> {{ $message }} </span>
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
                                                <i class="la la-check-square-o"></i>تحديث
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