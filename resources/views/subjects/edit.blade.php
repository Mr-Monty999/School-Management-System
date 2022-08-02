@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المواد الدراسية</h1>
        <form enctype="multipart/form-data" method="post" action="{{ route('subjects.update', $subject) }}">
            @csrf
            @method('PUT')
            <br>
            <h4>تعديل مادة</h4>
            <div>

                <div class="input-group input-group-outline my-3 bg-white is-filled">
                    <label class="form-label">اسم المادة</label>
                    <input type="text" name="subject_name" class="form-control" value="{{ $subject->subject_name }}">
                </div>
                <div style="display:none" class="alert alert-danger text-white text-center subject_paid_price"></div>

                <label class="form-label" for="sample-select2">اسم الفصل </label>
                <div class="input-group input-group-outline mb-3 bg-white">
                    <select name="class_id" id="sample-select2">
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" @if ($class->id == $subject->class_id) selected @endif>
                                {{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="form-label" for="sample-select">المعلمين <span class="text-sm">(اختياري)</span></label>
                <div class="input-group input-group-outline mb-3 bg-white">
                    <select name="teachers" id="sample-select" multiple>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" @if (in_array($teacher->id, $teacherIds)) selected @endif>
                                {{ $teacher->teacher_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success col-5">تعديل</button>
            <a href="{{ url()->previous() }}" type="button" class="btn btn-dark col-5">رجوع</a>
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
        VirtualSelect.init({
            ele: '#sample-select',
        });
        VirtualSelect.init({
            ele: '#sample-select2',
        });




        ////Update subject //
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('subjects.update', $subject) }}";


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
