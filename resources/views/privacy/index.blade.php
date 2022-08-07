@extends('layouts.dashboard')


@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">

        <h1>ادارة الخصوصية</h1>
        <form id="privacy" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <br>
            <h4>خصوصية حسابي</h4>
            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">إسم المستخدم</label>
                <input type="text" value="{{ $user->username }}" name="username" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">كلمة المرور الجديدة (اختياري)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-success margin my-3 col-6">حفظ</button>


        </form>
    </div>
@endsection

@push('ajax')
    <script>
        ////Update privacy //
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('privacy.update', $user) }}",
                updateUser = confirm("هل أنت متأكد من حفظ البيانات ؟");

            if (updateUser) {
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
                                '<div class="alert alert-success text-white text-center">' +
                                response
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
            }

        });
    </script>
@endpush
