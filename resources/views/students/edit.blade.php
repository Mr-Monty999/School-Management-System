@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الطلاب</h1>
        <form class="students" action="{{route('students.update',$student)}}" enctype="multipart/form-data" method="post">
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

                <select class="form-control" name="student_genre" id="">
                    <option value="ذكر" @if ($student->student_genre == "ذكر") selected @endif >ذكر</option>
                    <option value="أنثى" @if ($student->student_genre == "أنثى") selected @endif >أنثى</option>
                </select>
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_genre"></div>
            <label class="text-dark">السنة الدراسية :</label>
            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <select class="form-control" name="class_id" id="">
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
                <input type="date" name="student_birthdate" value="{{ $student->student_birthdate }}" class="form-control">
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
                <input type="text" name="parent_national_number" value="{{ $student->parent->parent_national_number }}"
                    class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_phone"></div>

            <button type="submit" class="btn btn-success margin col-4">حفظ</button>
            <a href="{{ url()->previous() }}" class="btn btn-dark  col-4">رجوع</a>

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
{{--
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


                    console.log(response);
                    ///Show Success Or Error Message
                    if (response.success) {
                        $("form .validate_success").text(response.message).show();

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
 --}}
