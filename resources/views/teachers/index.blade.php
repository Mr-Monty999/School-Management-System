@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المعلمين</h1>
        <form enctype="multipart/form-data" method="post" >
            @csrf
            <br>
            <h4>بيانات المعلم</h4>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">اسم المعلم</label>
                <input type="text" name="teacher_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_name"></div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white">
                <select class="form-control" name="teacher_genre" id="">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_genre"></div>

            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">السكن</label>
                <input type="text" name="teacher_address" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_address"></div>

            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="teacher_phone" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_phone"></div>

            <label class="text-dark">تاريخ ميلاد المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_birthdate" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_birthdate"></div>

            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_hire_date" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_registered_date"></div>

            <label class="text-dark"> راتب المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_salary" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_salary"></div>

            <label class="text-dark">  الرقم الوطني :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_national_number" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_national_number"></div>


            <label class="text-dark">صورة المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="teacher_photo" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center teacher_photo"></div>

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
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول المعلمين</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder">
                                            الرقم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            اسم المعلم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            صورة المعلم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            تاريخ التسجيل</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $teacher->id }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $teacher->teacher_name }}
                                            </p>
                                        </td>

                                        <td>
                                            <img class="text-dark text-center"
                                                src="{{asset($teacher->teacher_photo)}}"
                                            >
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $teacher->teacher_hire_date }}
                                            </p>
                                        </td>

                                        <td class="align-middle text-center">
                                            <a href="{{route('teachers.show',$teacher)}}" class="btn btn-dark">عرض </a>
                                            <a href="{{route('teachers.edit',$teacher)}}" class="btn btn-dark">تعديل </a>
                                            <form action="{{route('teachers.destroy',$teacher)}}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف </button>
                                            </form>
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
                url: "{{ route('teachers.store') }}",
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

                        ///errorName = input field name (key) like teacher_name
                        $("form ." + errorName + "").text(errors[errorName]).show();
                    }

                }

            });

        });
    </script>
@endpush

