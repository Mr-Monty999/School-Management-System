@extends('layouts.dashboard')


@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">

        <h1>ادارة الموظفين</h1>
        <form id="employees" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <br>
            <h4>بيانات الموظف</h4>
            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">اسم الموظف</label>
                <input type="text" value="{{ $employe->employe_name }}" name="employe_name" class="form-control">
            </div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline bg-white is-filled">
                <select class="form-control" name="employe_gender" id="">
                    <option value="ذكر" @if ($employe->employe_gender == 'ذكر') selected @endif>ذكر</option>
                    <option value="انثى" @if ($employe->employe_gender == 'انثى') selected @endif>انثى</option>
                </select>
            </div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">السكن</label>
                <input type="text" value="{{ $employe->employe_address }}" name="employe_address" class="form-control">
            </div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" value="{{ $employe->employe_phone }}" name="employe_phone" class="form-control">
            </div>


            <label class="text-dark">تاريخ ميلاد الموظف :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="date" value="{{ $employe->employe_birthdate }}" name="employe_birthdate"
                    class="form-control">
            </div>


            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="date" value="{{ $employe->employe_hire_date }}" name="employe_hire_date"
                    class="form-control">
            </div>


            <label class="text-dark"> راتب الموظف :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="number" value="{{ $employe->employe_salary }}" name="employe_salary" class="form-control">
            </div>


            <label class="text-dark"> الرقم الوطني :</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="number" value="{{ $employe->employe_national_number }}" name="employe_national_number"
                    class="form-control">
            </div>
            <label class="text-dark"> نوع الوظيفة :</label>
            <div class="input-group input-group-outline bg-white is-filled">
                <input type="text" value="{{ $employe->employe_job }}" name="employe_job" class="form-control">
            </div>


            <label class="text-dark">صورة الموظف :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="employe_photo" class="form-control">
            </div>
            <div class="form-check form-switch d-flex align-items-center mb-3 is-filled my-3">
                <label class="form-check-label mb-0 ms-3" for="giveAdmin">اعطاء صلاحية الإشراف لهذا الموظف؟</label>
                <input class="form-check-input" name="give_admin" type="checkbox" id="giveAdmin"
                    @if ($employe->user->hasRole('admin')) checked="" @endif>
            </div>

            <button type="submit" class="btn btn-success  my-3 col-5">حفظ</button>
            <a href="{{ URL::previous() }}" type="submit" class="btn btn-dark  my-3 col-5">رجوع</a>
            <input type="text" hidden name="id" value="{{ $employe->id }}">

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
        ////Update employe //
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('employees.update', $employe) }}";


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
