@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الطلاب</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> بيانات الطالب</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center m-6">
                                <tbody class="p-6">
                                    <tr>
                                        <td>رقم الطالب</td>
                                        <td> {{ $student->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>اسم الطالب</td>
                                        <td> {{ $student->student_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>عنوان الطالب</td>
                                        <td> {{ $student->student_address }}</td>
                                    </tr>
                                    <tr>
                                        <td> الجنس</td>
                                        <td> {{ $student->student_genre }}</td>
                                    </tr>
                                    <tr>
                                        <td> تاريخ الميلاد</td>
                                        <td> {{ $student->student_birthdate }}</td>
                                    </tr>
                                    <tr>
                                        <td> ناريخ التسجيل</td>
                                        <td> {{ $student->student_registered_date }}</td>
                                    </tr>
                                    <tr>
                                        <td> الرسوم المقررة</td>
                                        <td> {{ $student->student_paid_price }}</td>
                                    </tr>
                                    <tr>
                                        <td> الرسوم المدفوعة</td>
                                        <td> {{ $student->student_paid_price }}</td>
                                    </tr>
                                    <tr>
                                        <td> الرسوم المتبقية</td>
                                        <td> {{ $student->student_paid_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>صورة الطالب</td>
                                        <td> <img height="100px" width="100px" src="{{ asset($student->student_photo) }}"
                                                alt="لا توجد صورة"></td>
                                    </tr>
                                    <tr>
                                        <td> الرقم الوطني</td>
                                        <td> {{ $student->student_national_number }}</td>
                                    </tr>

                                    <tr>
                                        <td> الفصل</td>
                                        <td> <a href="{{ route('classes.show', $student->class) }}"
                                                class="text-dark">{{ $student->class->class_name }}</a></td>
                                    </tr>

                                    <tr>
                                        <td> اسم المستخدم</td>
                                        <td> {{ $student->user->username }}
                                        <td>
                                    </tr>

                                </tbody>
                            </table>

                            <h3 class="my-5 text-center">بيانات ولي أمر الطالب</h3>
                            <table class="table align-items-center  m-6">
                                <tr>
                                    <td>رقم ولي الأمر</td>
                                    <td> {{ $student->parent->id }}</td>
                                </tr>
                                <tr>
                                    <td>اسم ولي الأمر</td>
                                    <td> <a href="{{ route('parents.show', $student->parent) }}"
                                            class="text-dark">{{ $student->parent->parent_name }}</a></td>
                                </tr>
                                <tr>
                                    <td>هاتف ولي الأمر</td>
                                    <td> {{ $student->parent->parent_phone }}</td>
                                </tr>
                                <tr>
                                    <td>مهنة ولي الأمر</td>
                                    <td> {{ $student->parent->parent_job }}</td>
                                </tr>
                                <tr>
                                    <td>الرقم الوطني</td>
                                    <td> {{ $student->parent->parent_national_number }}</td>
                                </tr>
                                <tr>
                                    <td>صورة ولي الأمر</td>
                                    <td> <img src="{{ asset($student->parent->parent_photo) }}" alt="لا توجد صورة"></td>
                                </tr>
                            </table>

                            <h3 class="my-5 text-center"> أشقاء الطالب</h3>
                            <table class="table align-items-center  m-6">
                                <thead>
                                    <tr>
                                        <th>رقم الطالب</th>
                                        <th>اسم الطالب</th>
                                        <th>الفصل</th>
                                    </tr>
                                </thead>
                                <tbody class="p-6">
                                    @forelse ($siblings as $sibling)
                                        <tr>
                                            <td> {{ $sibling->id }}</td>
                                            <td> <a href="{{ route('students.show', $sibling) }}"
                                                    class="text-dark">{{ $sibling->student_name }}</a></td>
                                            <td> <a href="{{ route('classes.show', $sibling->class) }}"
                                                    class="text-dark">{{ $sibling->class->class_name }}</a></td>
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


{{-- @push('ajax')
    <script>
        $("input[type=date]").val(new Date().toISOString().slice(0, 10));


        let form = $("form");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

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



                    $("form .alert").remove();


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

                    $("form .alert").remove();

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
