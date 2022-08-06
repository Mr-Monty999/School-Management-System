@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الصلاحيات</h1>
        <form method="post" action="{{route('users.update',$user)}}">
            @csrf
            @method('PUT')
            <br>
            <h4> تغيير رتبة المستخدم</h4>
            <div>
                <label class="form-label" for="sample-select2"> الرتبة </label>
                <div class="input-group input-group-outline mb-3 ">
                    <select name="role" id="sample-select" multiple>
                         @foreach ($roles as $role)
                            <option value="{{$role->id}}"  @if (in_array($role->id,$user_roles) ) selected @endif >{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <a href="{{url()->previous()}}" type="button" class="btn btn-dark margin my-3 ">رجوع</a>
            <button type="submit" class="btn btn-success margin my-3 ">حفظ</button>
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
 {{-- @push('ajax')
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
                url: "{{ route('ubjects.store') }}",
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
@endpush
 --}}
