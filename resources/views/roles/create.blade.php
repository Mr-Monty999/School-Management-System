@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الصلاحيات</h1>
        <form enctype="multipart/form-data" method="post" action="{{route('roles.store')}}">
            @csrf
            <br>
            <h4>انشاء رتبة جديدة</h4>
            <div class="input-group input-group-outline  bg-white my-3">
                <label class="form-label">أسم الرتبة</label>
                <input type="text" name="role_name" class="form-control">
            </div>
                <div style="display:none" class="alert alert-danger text-white text-center teacher_birthdate"></div>

            <div style="display:none" class="alert alert-danger text-white text-center class_name"></div>

            <label class="form-label"> الصلاحيات</label>
            <div class="input-group input-group-outline my-3">
                <select name="permissions" id="sample-select" multiple>
                    @foreach ($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                    @endforeach
                </select>
            </div>
                <button type="submit" class="btn btn-success margin my-3 ">اضافة</button>
                <a href="{{url()->previous()}}" class="btn btn-dark my-3">  رجوع</a>

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
    </script>
@endpush

{{--
 @push('ajax')
    <script>
        $("input[type=date]").val(new Date().toISOString().slice(0, 10));


        let form = $("form");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $("form .alert").hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "post",
                url: "{{ route('classes.store') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {

                    if (response.success)
                        $("form .validate_success").text(response.message).show();
                    else
                        $("form .validate_error").text(response.message).show();


                },
                error: function(response) {

                    console.log(response);

                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {

                        ///errorName = input field name (key) like class_name
                        $("form ." + errorName + "").text(errors[errorName]).show();
                    }

                }

            });

        });
    </script>
@endpush --}}

