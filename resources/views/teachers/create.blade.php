@extends('layouts.dashboard')
@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <a href="{{ route('teachers.index') }}" class="btn btn-dark" style="margin-left: auto ; maring-right:0"> رجوع</a>
        <h1>ادارة المعلمين</h1>
        <form enctype="multipart/form-data" method="POST" id="teachers">
            @csrf
            <br>
            <h4>اضافة المعلم</h4>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">اسم المعلم</label>
                <input type="text" name="teacher_name" class="form-control">
            </div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white">
                <select class="form-control" name="teacher_gender" id="">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">السكن</label>
                <input type="text" name="teacher_address" class="form-control">
            </div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="teacher_phone" class="form-control">
            </div>


            <label class="text-dark">تاريخ ميلاد المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_birthdate" class="form-control">
            </div>


            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_hire_date" class="form-control">
            </div>


            <label class="text-dark"> راتب المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_salary" class="form-control">
            </div>


            <label class="text-dark"> الرقم الوطني :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_national_number" class="form-control">
            </div>



            <label class="text-dark">صورة المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="teacher_photo" class="form-control">
            </div>


            <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>


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

    @push('ajax')
        <script>
            let form = $("form#teachers");

            form.on("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(this),
                    url = "{{ route('teachers.store') }}"

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
                        $("form#teachers").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                            '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                            '</div>');
                    },
                    complete: function() {
                        $(".spinner").remove();
                    },
                    success: function(response) {

                        $(".alert").remove();

                        if (response.success) {

                            $("form#teachers input:not([type='date'])").val("");


                            $("form#teachers").after(
                                '<div class="alert alert-success text-white text-center">' + response
                                .message +
                                '</div>'
                            );

                        } else
                            $("form#teachers").after(
                                '<div class="alert alert-danger text-white text-center">' + response
                                .message +
                                '</div>'
                            );


                    },
                    error: function(response) {

                        $(".alert").remove();


                        //errors = Validtion Errors keys
                        let errors = response.responseJSON.errors;

                        for (let errorName in errors) {

                            ///errorName = input field name (key) like teacher_name
                            $("form#teachers input[name='" + errorName + "']").parent().after(
                                '<div class="alert alert-danger text-white text-center">' +
                                errors[errorName] +
                                '</div>');
                        }

                    }

                });

            });
        </script>
    @endpush
@endsection
