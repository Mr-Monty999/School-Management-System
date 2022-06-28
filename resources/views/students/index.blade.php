@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الطلاب</h1>
        <form class="students" action="" enctype="multipart/form-data" method="post">
            @csrf
            <br>
            <h4>بيانات الطالب</h4>
            <div class="input-group input-group-outline  bg-white">
                <label class="form-label">اسم الطالب</label>
                <input type="text" name="student_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_name"></div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white">
                <select class="form-control" name="student_genre" id="">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_genre"></div>

            <label class="text-dark">السنة الدراسية :</label>
            <div class="input-group input-group-outline my-3 bg-white">
                <select class="form-control" name="class_id" id="">
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="input-group input-group-outline  bg-white">
                <label class="form-label">السكن</label>
                <input type="text" name="student_address" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_address"></div>

            <label class="text-dark">تاريخ ميلاد الطالب :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="student_birthdate" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_birthdate"></div>

            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="student_registered_date" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_registered_date"></div>

            <label class="text-dark">صورة الطالب :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="student_photo" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_photo"></div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">الرسوم المدفوعة</label>
                <input type="text" name="student_paid_price" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_paid_price"></div>

            <h4>بيانات ولي أمر الطالب</h4>

            <div class="input-group input-group-outline  bg-white">
                <label class="form-label">اسم ولي أمر الطالب </label>
                <input type="text" name="parent_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_name"></div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">مهنة ولي أمر الطالب </label>
                <input type="text" name="parent_job" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_job"></div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">رقم هاتف ولي أمر الطالب </label>
                <input type="text" name="parent_phone" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_phone"></div>

            <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>
            <div style="display:none" class="alert alert-success text-white text-center validate_success"></div>
            <div style="display:none" class="alert alert-danger text-white text-center validate_error"></div>

        </form>

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-white">{{ $error }}</div>
        @endforeach

        @if (Session::has('success'))
            <div class="alert alert-success text-white">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger text-white">{{ Session::get('error') }}</div>
        @endif


        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول الطلاب</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder">
                                            الرقم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            اسم الطالب</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            النوع</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            السكن</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            السنة الدراسية</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            صورة الطالب</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            تاريخ التسجيل</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            تاريخ الميلاد</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            العمر</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            الرسوم المدفوعة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            الرسوم المتبقية</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            ولي الامر</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <p class="text-dark text-center">{{ $student->id }}</p>
                                            </td>

                                            <td>
                                                <p class="text-dark text-center">{{ $student->student_name }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-dark text-center">{{ $student->student_genre }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-dark text-center">{{ $student->student_address }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $student->class->class_name }}
                                                </p>
                                            </td>

                                            @if (!is_null($student->student_photo))
                                                <td>
                                                    <img class="text-dark text-center"
                                                        src="{{ asset($student->student_photo) }}">
                                                </td>
                                            @else
                                                <td>
                                                    لاتوجد صورة
                                                </td>
                                            @endif

                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $student->student_registered_date }}</p>
                                            </td>
                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $student->student_birthdate }}</p>
                                            </td>
                                            <td>
                                                @php
                                                    $birth = new DateTime($student->student_birthdate);
                                                    $now = new DateTime();
                                                    $age = $now->diff($birth)->y;
                                                @endphp
                                                <p class="text-dark text-center">
                                                    {{ $age }}</p>
                                            </td>
                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $student->student_paid_price }}</p>
                                            </td>

                                            <td>
                                                <p class="text-dark text-center">-</p>
                                            </td>
                                            <td>
                                                <p class="text-dark text-center">
                                                    <a href="">{{ $student->parent->parent_name }}
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('students.edit', $student->id) }}"
                                                    class="btn btn-dark">تعديل</a>
                                                <form action="{{ route('students.destroy', $student->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            {!! $students->links() !!}

        </div>



    </div>
@endsection


@push('ajax')
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
@endpush
