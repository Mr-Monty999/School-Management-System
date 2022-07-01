@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الفصول</h1>
        <form enctype="multipart/form-data" method="post" >
            @csrf
            <br>
            <h4>بيانات الفصل</h4>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">اسم الفصل</label>
                <input type="text" name="class_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center class_name"></div>
                <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>
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


        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول الفصول</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>

                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> اسم الفصل</th>

                                        <th class="text-uppercase text-primary  font-weight-bolder text-center">الاحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $class)
                                    <tr>
                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $class->id }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $class->class_name }}
                                            </p>
                                        </td>

                                        <td class="d-flex justify-content-center">
                                            <a href="{{route('classes.show',$class)}}" class="btn btn-dark pb-4 mx-2">عرض </a>
                                            @role('Super-Admin')
                                                <a href="{{route('classes.edit',$class)}}" class="btn btn-dark pb-4 mx-2">تعديل </a>
                                                <form action="{{route('classes.destroy',$class)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف </button>
                                                </form>
                                            @endrole
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

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
@endpush

