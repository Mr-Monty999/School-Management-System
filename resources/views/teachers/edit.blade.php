@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المعلمين</h1>
        <form class="teachers" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <br>
            <h4>بيانات المعلم</h4>
            <div class="input-group input-group-outline bg-white is-filled">
                <label class="form-label">اسم المعلم</label>
                <input type="text" name="teacher_name" value="{{ $teacher->teacher_name }}" class="form-control">
            </div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <select class="form-control" name="teacher_gender" id="">
                    <option value="ذكر"@if ($teacher->teacher_gender == 'ذكر') selected @endif>ذكر</option>
                    <option value="انثى"@if ($teacher->teacher_gender == 'انثى') selected @endif>انثى</option>
                </select>
            </div>

            <div class="input-group input-group-outline bg-white is-filled my-3">
                <label class="form-label">السكن</label>
                <input type="text" name="teacher_address" value="{{ $teacher->teacher_address }}" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="teacher_phone" value="{{ $teacher->teacher_phone }}" class="form-control">
            </div>

            <label class="text-dark">تاريخ ميلاد المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_birthdate" value="{{ $teacher->teacher_birthdate }}"
                    class="form-control">
            </div>

            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_hire_date" value="{{ $teacher->teacher_hire_date }}"
                    class="form-control">
            </div>

            <label class="text-dark"> راتب المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_salary" value="{{ $teacher->teacher_salary }}" class="form-control">
            </div>

            <label class="text-dark"> الرقم الوطني :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_national_number" value="{{ $teacher->teacher_national_number }}"
                    class="form-control">
            </div>


            <label class="text-dark">صورة المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="teacher_photo" class="form-control">
            </div>


            <div class="my-3">
                <button type="submit" class="btn btn-success margin col-4">حفظ</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark  col-4">رجوع</a>
            </div>

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
        ////Update teacher //
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('teachers.update', $teacher) }}";


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

                    console.log(response);

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

                    console.log(response);

                    $(".alert").remove();


                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {


                        $("form input[name='" + errorName + "']").parent().after(
                            '<div class="alert alert-danger text-white text-center">' +
                            errors[errorName] +
                            '</div>');
                    }


                }

            });

        });
    </script>
@endpush
