@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة أولياء الأمور</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> بيانات ولي الأمر</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-4 p-4">
                                <tbody class="p-6">
                                    <tr>
                                        <td>رقم ولي الأمر</td>
                                        <td> {{ $parent->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>اسم ولي الأمر</td>
                                        <td> {{ $parent->parent_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>مهنة ولي الأمر</td>
                                        <td> {{ $parent->parent_job }}</td>
                                    </tr>
                                    <tr>
                                        <td> رقم الهاتف</td>
                                        <td> {{ $parent->parent_phone }}</td>
                                    </tr>

                                    <tr>
                                        <td>صورة ولي الأمر</td>
                                        <td> <img height="100px" width="100px" src="{{ asset($parent->parent_photo) }}"
                                                alt="لا توجد صورة"></td>
                                    </tr>
                                    <tr>
                                        <td> الرقم الوطني</td>
                                        <td> {{ $parent->parent_national_number }}</td>
                                    </tr>

                                </tbody>
                            </table>

                            <h3 class="my-5 text-center"> بيانات أبناء ولي الأمر</h3>
                            <table class="table align-items-center mb-4 p-4 text-center">
                                <thead>
                                    <tr>
                                        <th>رقم الطالب</th>
                                        <th>اسم الطالب</th>
                                        <th>الفصل</th>
                                        <th>الأحداث</th>
                                    </tr>
                                </thead>
                                <tbody class="p-6">
                                    @forelse ($parent->students as $student)
                                        <tr>
                                            <td> {{ $student->id }}</td>
                                            <td> {{ $student->student_name }}</td>
                                            <td> <a href="{{ route('classes.show', $student->class) }}"
                                                    class="text-dark">{{ $student->class->class_name }}</a></td>
                                            <td> <a href="{{ route('students.show', $student) }}"
                                                    class="btn btn-dark">عرض</a></td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection
