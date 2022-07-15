@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة  الصلاحيات</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="flex justify-contnet-between">
                    <a href="{{route('users.index')}}" class="btn btn-dark">رجوع</a>
                    <a href="{{route('roles.create')}}" class="btn btn-dark">انشاء صلاحية جديدة</a>
                </div>
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول  الصلاحيات</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>

                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> اسم الرتبة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">   عدد الصلاحيات</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">   عدد المستخدمين</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder text-center">الاحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $role->id }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $role->name }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $role->permissions_count }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $role->users_count }}
                                            </p>
                                        </td>

                                        <td class="d-flex justify-content-center">
                                            <a href="{{route('roles.show',$role)}}" class="btn btn-dark pb-4 mx-2">   عرض الصلاحيات </a>
                                                <a href="{{route('roles.edit',$role)}}" class="btn btn-danger pb-4 mx-2">تعديل </a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection


{{-- @push('ajax')
    <script>
       VirtualSelect.init({
        ele: '#sample-select',
        });
        VirtualSelect.init({
        ele: '#sample-select2',
        });
    </script>
@endpush --}}
