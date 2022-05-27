@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> الماركات التجارية </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> خصائص المنتج
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">  جميع الخصائص </h4>
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
                                <div class="card-body card-dashboard">
                                    <table
                                        class="table display nowrap table-striped table-bordered scroll-horizontal ">
                                        <thead>
                                        <tr>
                                            <th> الاسم</th>
                                            <th> الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @isset($attributs)
                                                @foreach ( $attributs as $attribut )

                                                    <tr>
                                                        <td>{{ $attribut->name }} </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                aria-label="Basic example">
                                                                <a href="{{ route('admin.attributs.edit' , $attribut->id) }}"
                                                                class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                <a href="{{ route('admin.attributs.delete' , $attribut->id) }}"
                                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                    {{-- //فى حالة اذا كان الروت بوست --}}
                                                                {{-- <button type="button"
                                                                        value=""
                                                                        onclick="if(confirm('are u sure to delete this item?')){ $('#frm-delete-data-{{ $language->id }}').submit()}"
                                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                                                        data-toggle="modal"
                                                                        data-target="#rotateInUpRight">
                                                                    حذف
                                                                </button> --}}
                                                                {{-- <form action="{{route('admin.languages.delete' , $language->id)}}" id="frm-delete-data-{{ $language->id }}" method="POST"> --}}
                                                                    {{-- <input type="hidden" name="_method" value="Delete"> == --}}
                                                                    {{-- @method("Delete") --}}
                                                                    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> == --}}
                                                                    {{-- @csrf --}}
                                                                    {{-- <button class="btn btn-danger m-1">Delete</button> --}}
                                                                {{-- </form> --}}

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset

                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

