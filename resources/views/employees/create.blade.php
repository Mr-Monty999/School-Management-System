@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <a href="{{ route('employees.index') }}" class="btn btn-dark" style="margin-left: auto ; maring-right:0"> رجوع</a>

        <h1>ادارة الموظفين</h1>
        <form id="employees" enctype="multipart/form-data" method="post">
            @csrf
            <br>
            <h4>بيانات الموظف</h4>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">اسم الموظف</label>
                <input type="text" name="employe_name" class="form-control">
            </div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white">
                <select class="form-control" name="employe_gender" id="">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">السكن</label>
                <input type="text" name="employe_address" class="form-control">
            </div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="employe_phone" class="form-control">
            </div>


            <label class="text-dark">تاريخ ميلاد الموظف :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="employe_birthdate" class="form-control">
            </div>


            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="employe_hire_date" class="form-control">
            </div>


            <label class="text-dark"> راتب الموظف :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="employe_salary" class="form-control">
            </div>


            <label class="text-dark"> الرقم الوطني :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="employe_national_number" class="form-control">
            </div>
            <label class="text-dark"> نوع الوظيفة :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="text" name="employe_job" class="form-control">
            </div>


            <label class="text-dark">صورة الموظف :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="employe_photo" class="form-control">
            </div>

            <div class="form-check form-switch d-flex align-items-center mb-3 is-filled my-3">
                <label class="form-check-label mb-0 ms-3" for="giveAdmin">اعطاء صلاحية الإشراف لهذا الموظف؟</label>
                <input class="form-check-input" name="give_admin" type="checkbox" id="giveAdmin">
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
            let form = $("form#employees");

            form.on("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(this),
                    url = "{{ route('employees.store') }}"

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
                        $("form#employees").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                            '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                            '</div>');
                    },
                    complete: function() {
                        $(".spinner").remove();
                    },
                    success: function(response) {

                        $(".alert").remove();

                        if (response.success) {

                            $("form#employees input:not([type='date'])").val("");


                            $("form#employees").after(
                                '<div class="alert alert-success text-white text-center">' + response
                                .message +
                                '</div>'
                            );

                        } else
                            $("form#employees").after(
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

                            ///errorName = input field name (key) like employe_name
                            $("form#employees input[name='" + errorName + "']").parent().after(
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
