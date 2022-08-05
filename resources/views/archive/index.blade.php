@extends('layouts.dashboard')

@section('section')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="text-start pt-1">
                        <p class="text-sm mb-0 text-capitalize text-dark"> الطلاب</p>
                        <h4 class="mb-0"><a href="{{route('archive.show','student')}}">عرض</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="text-start pt-1">
                        <p class="text-sm mb-0 text-capitalize text-dark">  المعلمين</p>
                        <h4 class="mb-0"><a href="{{route('archive.show','teacher')}}">عرض</a></h4>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="text-start pt-1">
                        <p class="text-sm mb-0 text-capitalize text-dark"> الموظفين </p>
                        <h4 class="mb-0"><a href="{{route('archive.show','employe')}}">عرض</a></h4>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
