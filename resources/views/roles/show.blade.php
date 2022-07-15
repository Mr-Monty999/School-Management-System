@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center ltr">
        <h1>ادارة  الصلاحيات</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <a href="{{url()->previous()}}" class="btn btn-dark">رجوع</a>
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
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> الصلاحية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role->permissions as $permission)
                                        <tr>
                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $permission->id }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $permission->name }}
                                                </p>
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
