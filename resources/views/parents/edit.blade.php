@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة أولياء الأمور</h1>
        <form class="students" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')

            <h4 class="m-5">بيانات ولي الأمر</h4>

            <div class="input-group input-group-outline  bg-white is-filled">
                <label class="form-label">اسم ولي أمر الطالب </label>
                <input type="text" name="parent_name" value="{{ $parent->parent_name }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_name"></div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">مهنة ولي أمر الطالب </label>
                <input type="text" name="parent_job" value="{{ $parent->parent_job }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_job"></div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">رقم هاتف ولي أمر الطالب </label>
                <input type="text" name="parent_phone" value="{{ $parent->parent_phone }}" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_phone"></div>

            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">الرقم الوطني </label>
                <input type="text" name="parent_national_number" value="{{ $parent->parent_national_number }}"
                    class="form-control">
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
        ///  Update Parent ///
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('parents.update', $parent) }}";

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

                    console.log(response.responseJSON);
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
