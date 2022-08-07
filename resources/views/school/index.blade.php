@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المدرسة</h1>

        <form enctype="multipart/form-data" id="school">
            @csrf
            <br>
            {{-- <h4>اضافة المعلم</h4> --}}
            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">اسم المدرسة</label>
                <input type="text" value="{{ $school->school_name }}" name="school_name" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">اسم مالك المدرسة</label>
                <input type="text" value="{{ $school->school_owner }}" name="school_owner" class="form-control">
            </div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">عنوان المدرسة</label>
                <input type="text" value="{{ $school->school_address }}" name="school_address" class="form-control">
            </div>


            <div class="input-group input-group-outline my-3 bg-white is-filled">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" value="{{ $school->school_phone }}" name="school_phone" class="form-control">
            </div>




            <label class="text-dark"> سعر السنة الدراسية</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="number" value="{{ $school->school_year_price }}" name="school_year_price"
                    class="form-control">
            </div>


            <label class="text-dark">شعار المدرسة:</label>
            <div class="input-group input-group-outline  bg-white is-filled">
                <input type="file" value="{{ $school->school_logo }}" name="school_logo" class="form-control">
            </div>


            <button type="submit" class="btn btn-success margin my-3 col-6">حفظ</button>


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



    </div>
@endsection

@push('ajax')
    <script>
        ////Update school //
        $("form").on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('schools.store') }}";


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
