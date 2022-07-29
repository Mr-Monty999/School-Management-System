@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الطلاب</h1>
        <form class="students" action="" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <br>
            <h4>بيانات الطالب</h4>
            <div class="input-group input-group-outline bg-white is-filled">
                <label class="form-label">اسم الطالب</label>
                <input type="text" name="student_name" value="{{ $student->student_name }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_name"></div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white is-filled">

                <select class="form-control" name="student_gender">
                    <option value="ذكر" @if ($student->student_gender == 'ذكر') selected @endif>ذكر</option>
                    <option value="أنثى" @if ($student->student_gender == 'أنثى') selected @endif>أنثى</option>
                </select>
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_gender"></div>
            <label class="text-dark">السنة الدراسية :</label>
            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <select class="form-control" name="class_id">
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" @if ($student->class_id == $class->class_id) selected @endif>
                            {{ $class->class_name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="input-group input-group-outline  bg-white is-filled">
                <label class="form-label">السكن</label>
                <input type="text" name="student_address" value="{{ $student->student_address }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_address"></div>

            <label class="text-dark">تاريخ ميلاد الطالب :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="date" name="student_birthdate" value="{{ $student->student_birthdate }}"
                    class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_birthdate"></div>

            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="date" name="student_registered_date" value="{{ $student->student_registered_date }}"
                    class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_registered_date"></div>

            <label class="text-dark">صورة الطالب :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="file" name="student_photo" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_photo"></div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">الرسوم المدفوعة</label>
                <input type="text" value="{{ $student->student_paid_price }}" name="student_paid_price"
                    class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_paid_price"></div>

            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">الرقم الوطني </label>
                <input type="text" name="student_national_number" value="{{ $student->student_national_number }}"
                    class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_national_number"></div>

            <h4>بيانات ولي أمر الطالب</h4>

            <div class="input-group input-group-outline  bg-white is-filled">
                <label class="form-label">اسم ولي أمر الطالب </label>
                <input type="text" name="parent_name" value="{{ $student->parent->parent_name }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_name"></div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">مهنة ولي أمر الطالب </label>
                <input type="text" name="parent_job" value="{{ $student->parent->parent_job }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_job"></div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">رقم هاتف ولي أمر الطالب </label>
                <input type="text" name="parent_phone" value="{{ $student->parent->parent_phone }}"
                    class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_phone"></div>

            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">الرقم الوطني </label>
                <input type="text" name="parent_national_number"
                    value="{{ $student->parent->parent_national_number }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_phone"></div>

            <button type="submit" class="btn btn-success margin col-4">حفظ</button>
            <a href="{{ url()->previous() }}" class="btn btn-dark  col-4">رجوع</a>


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
        ////Update Student //
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('students.update', $student) }}";


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
                            '<div class="alert alert-success text-white text-center">' + response
                            .message +
                            '</div>'
                        );

                    } else
                        $("form").after(
                            '<div class="alert alert-danger text-white text-center">' + response
                            .message +
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
                            '<div class="alert alert-danger text-white text-center">' + errors[
                                errorName] +
                            '</div>'
                        );
                    }


                }

            });

        });
    </script>
@endpush
