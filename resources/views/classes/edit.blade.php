@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الفصول</h1>
        <form enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <br>
            <h4>بيانات الفصل</h4>
            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">اسم الفصل</label>
                <input type="text" name="class_name" class="form-control" value="{{ $class->class_name }}">
            </div>
            <button type="submit" class="btn btn-success margin mt-3 d-inline">حفظ</button>
            <a href="{{ url()->previous() }}" class="btn btn-dark d-inline">رجوع</a>

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
        ///  Update classes ///
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('classes.update', $class) }}";

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
