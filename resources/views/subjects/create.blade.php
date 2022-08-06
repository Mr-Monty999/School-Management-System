@extends('layouts.dashboard')
@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <a href="{{ route('subjects.index') }}" class="btn btn-dark" style="margin-left: auto ; maring-right:0"> رجوع</a>

        <h1>ادارة المواد</h1>
        <form enctype="multipart/form-data" method="post" id="subjects">
            @csrf
            <br>
            <h4>اضافة مادة</h4>
            <div>

                <div class="input-group input-group-outline my-3 bg-white">
                    <label class="form-label">اسم المادة</label>
                    <input type="text" name="subject_name" class="form-control ">
                </div>
                <div style="display:none" class="alert alert-danger text-white text-center subject_paid_price"></div>

                <label class="form-label" for="sample-select2">اسم الفصل </label>
                <div class="input-group input-group-outline mb-3">
                    <select name="class_id" id="sample-select2">
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="form-label" for="sample-select">المعلمين <span class="text-sm">(اختياري)</span></label>
                <div class="input-group input-group-outline mb-3">
                    <select name="teachers" id="sample-select" multiple>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>
            <div style="display:none" class="alert alert-success text-white text-center validate_success"></div>
            <div style="display:none" class="alert alert-danger text-white text-center validate_error"></div>

        </form>
    </div>

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger text-white">{{ $error }}</div>
    @endforeach

    @if (Session::has('success'))
        <div class="alert alert-success text-white">{{ Session::get('success') }}</div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger text-white">{{ Session::get('error') }}</div>
    @endif

    @push('ajax')
        <script>
            VirtualSelect.init({
            ele: '#sample-select',
        });
        VirtualSelect.init({
            ele: '#sample-select2',
        });


        let form = $("form#subjects");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('subjects.store') }}"
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
                    $("form#subjects").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                        '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                        '</div>');
                },
                complete: function() {
                    $(".spinner").remove();
                },
                success: function(response) {



                    $(".alert").remove();


                   /*  $.ajax({
                        type: "get",
                        url: tableUrl,
                        data: "data",
                        success: function(res) {
                            console.log(res);
                            table.empty();
                            table.append(res);

                        },
                        error: function(res) {
                            console.log(res);

                        }
                    }); */

                    ///Show Success Or Error Message
                    if (response.success) {
                        $("form#subjects input:not([type='date'])").val("");


                        $("form#subjects").after(
                            '<div class="alert alert-success text-white text-center">' + response
                            .message +
                            '</div>'
                        );

                    } else
                        $("form#subjects").after(
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


                        $("form#subjects input[name='" + errorName + "']").parent().after(
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
