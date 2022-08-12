@extends('layouts.dashboard')
@can('statistics.view')
    @section('status')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="text-start pt-1">
                                <p class="text-sm mb-0 text-capitalize text-dark">عدد الطلاب</p>
                                <h4 class="mb-0">{{$students}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="text-start pt-1">
                                <p class="text-sm mb-0 text-capitalize text-dark"> عدد المعلمين</p>
                                <h4 class="mb-0">{{$teachers}}</h4>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="text-start pt-1">
                                <p class="text-sm mb-0 text-capitalize text-dark"> عدد الفصول</p>
                                <h4 class="mb-0">{{$classes}}</h4>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="text-start pt-1">
                                <p class="text-sm mb-0 text-capitalize text-dark">عدد الموظفين </p>
                                <h4 class="mb-0">{{$employees}}</h4>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endsection
@endcan

@section('section')
    <div class="">
        <h2>مرحبا بك {{auth()->user()->username}}</h2>
    </div>
@endsection
