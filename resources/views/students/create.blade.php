@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <a href="{{ route('students.index') }}" class="btn btn-dark" style="margin-left: auto ; maring-right:0"> رجوع</a>

        <h1>ادارة الطلاب</h1>

        <form class="students" action="{{ route('students.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <br>
            <h4>اضافة طالب جديد </h4>
            <div class="input-group input-group-outline  bg-white">
                <label class="form-label">اسم الطالب</label>
                <input type="text" name="student_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_name"></div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline bg-white">
                <select class="form-control" name="student_gender">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_genre"></div>

            <label class="text-dark">السنة الدراسية :</label>
            <div class="input-group input-group-outline my-3 bg-white">
                <select class="form-control" name="class_id">
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

            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label"> الرقم الوطني</label>
                <input type="text" name="student_national_number" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_national_number"></div>

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

            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label"> الرقم الوطني</label>
                <input type="text" name="parent_national_number" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_national_number"></div>


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

    </div>
@endsection

@push('ajax')
    <script>
        let form = $("form");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('students.store') }}";

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "post",
                url: url,
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("form").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                        '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                        '</div>');
                },
                complete: function() {
                    $(".spinner").remove();
                },
                success: function(response) {



                    $(".alert").remove();


                    ///Show Success Or Error Message
                    if (response.success) {
                        $("form").after(
                            '<div class="alert alert-success text-white">' + response
                            .message +
                            '</div>'
                        );
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
                        $("form").after(
                            '<div class="alert alert-danger text-white">' + response.message +
                            '</div>'
                        );

                },
                error: function(response) {

                    // console.log(response);
                    $(".alert").remove();

                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {


                        $("form").after(
                            '<div class="alert alert-danger text-white">' + errors[
                                errorName] +
                            '</div>'
                        );
                    }

                }

            });

        });
    </script>
@endpush
