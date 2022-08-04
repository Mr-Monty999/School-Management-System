@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1> {{ $employe->employe_name }}</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('employees.index') }}" class="btn btn-dark">رجوع</a>
                </div>


                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> بيانات الموظف</h6>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center m-6">
                                    <tbody class="p-6">
                                        <tr>
                                            <td>رقم الموظف</td>
                                            <td> {{ $employe->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>اسم الموظف</td>
                                            <td> {{ $employe->employe_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>رقم هاتف الموظف</td>
                                            <td> {{ $employe->employe_phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>عنوان الموظف</td>
                                            <td> {{ $employe->employe_address }}</td>
                                        </tr>
                                        <tr>
                                            <td>صورة الموظف</td>
                                            <td> <img src="{{ asset($employe->employe_photo) }}" alt="لا توجد صورة"></td>
                                        </tr>
                                        <tr>
                                            <td>راتب الموظف</td>
                                            <td> {{ $employe->employe_salary }}</td>
                                        </tr>
                                        <tr>
                                            <td> الجنس</td>
                                            <td> {{ $employe->employe_gender }}</td>
                                        </tr>
                                        <tr>
                                            <td>تاريخ تعيين الموظف</td>
                                            <td> {{ $employe->employe_hire_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>ناريخ ميلاد الموظف</td>
                                            <td> {{ $employe->employe_birthdate }}</td>
                                        </tr>
                                        <tr>
                                            <td> الرقم الوطني</td>
                                            <td> {{ $employe->employe_national_number }}</td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection

@push('ajax')
    <script>
        VirtualSelect.init({
            ele: '#sample-select',
        });

        VirtualSelect.init({
            ele: '#sample-select2',
        });
    </script>
@endpush
