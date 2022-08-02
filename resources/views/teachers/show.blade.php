@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1> {{ $teacher->teacher_name }}</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('teachers.index') }}" class="btn btn-dark">رجوع</a>
                </div>


                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> بيانات المعلم</h6>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center m-6">
                                    <tbody class="p-6">
                                        <tr>
                                            <td>رقم المعلم</td>
                                            <td> {{ $teacher->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>اسم المعلم</td>
                                            <td> {{ $teacher->teacher_address }}</td>
                                        </tr>
                                        <tr>
                                            <td>رقم هاتف المعلم</td>
                                            <td> {{ $teacher->teacher_phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>عنوان المعلم</td>
                                            <td> {{ $teacher->teacher_address }}</td>
                                        </tr>
                                        <tr>
                                            <td>صورة المعلم</td>
                                            <td> <img src="{{ asset($teacher->teacher_photo) }}" alt="لا توجد صورة"></td>
                                        </tr>
                                        <tr>
                                            <td>راتب المعلم</td>
                                            <td> {{ $teacher->teacher_salary }}</td>
                                        </tr>
                                        <tr>
                                            <td> الجنس</td>
                                            <td> {{ $teacher->teacher_gender }}</td>
                                        </tr>
                                        <tr>
                                            <td>تاريخ تعيين المعلم</td>
                                            <td> {{ $teacher->teacher_hire_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>ناريخ ميلاد المعلم</td>
                                            <td> {{ $teacher->teacher_birthdate }}</td>
                                        </tr>
                                        <tr>
                                            <td> الرقم الوطني</td>
                                            <td> {{ $teacher->teacher_national_number }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h4 class="text-center">المواد</h4>
                                <table class="table align-items-center m-6">
                                    <thead>
                                        <tr>
                                            <td>رقم المادة</td>
                                            <td>اسم المادة</td>
                                            <td>الفصل</td>
                                        </tr>
                                    </thead>
                                    <tbody class="p-6">
                                        @foreach ($teacher->subjects as $subject)
                                            <tr>
                                                <td> {{ $subject->id }}</td>
                                                <td> <a
                                                        href="{{ route('subjects.show', $subject) }}">{{ $subject->subject_name }}</a>
                                                </td>
                                                <td> <a
                                                        href="{{ route('classes.show', $subject->class) }}">{{ $subject->class->class_name }}</a>
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

{{-- @push('ajax')
    <script>
        $("input[type=date]").val(new Date().toISOString().slice(0, 10));


        let form = $(".students");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $("form .alert").hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "post",
                url: "{{ route('students.store') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {





                    ///Show Success Or Error Message
                    if (response.success) {
                        $("form .validate_success").text(response.message).show();

                        /* Not Finished Yet !
                                                console.log(response);
                                                ///if Rows Less Than 5 , Then Append
                                                if ($("tbody").children().length < 100) {
                                                    $("tbody").prepend("<tr>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.id + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.student_name + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_class + "</p></td>");
                                                    $("tbody").prepend(
                                                        "<td><p class='text-dark text-center'>{{ asset('+response.data.student_photo+') }}</p></td>"
                                                    );
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_registered_date + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_paid_price + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>-</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.parent_name + "</p></td>");

                                                    $("tbody").prepend("</tr>");

                                                }
                        */
                    } else
                        $("form .validate_error").text(response.message).show();

                },
                error: function(response) {


                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {

                        ///errorName = input field name (key) like student_name
                        $("form ." + errorName + "").text(errors[errorName]).show();
                    }

                }

            });

        });
    </script>
@endpush --}}
