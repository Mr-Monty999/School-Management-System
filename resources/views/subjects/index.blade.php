@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المواد الدراسية</h1>
        <form enctype="multipart/form-data" method="post" action="{{route('subjects.store')}}" >
            @csrf
            <br>
            <h4>اضافة مادة</h4>
            <div>

                <div class="input-group input-group-outline my-3 bg-white">
                    <label class="form-label">اسم المادة</label>
                    <input type="text" name="subject_name" class="form-control ">
                </div>
                <div style="display:none" class="alert alert-danger text-white text-center student_paid_price"></div>

                <label class="form-label" for="sample-select2">اسم الفصل </label>
                <div class="input-group input-group-outline mb-3">
                    <select name="class_id" id="sample-select2">
                         @foreach ($classes as $class)
                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                        @endforeach
                    </select>
                </div>

                <label class="form-label" for="sample-select">المعلمين <span class="text-sm">(اختياري)</span></label>
                <div class="input-group input-group-outline mb-3">
                    <select name="teachers" id="sample-select" multiple>
                         @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->teacher_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

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
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول المواد الدراسية</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>

                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> اسم المادة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">   الفصل</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">   المعلمين</th>

                                        <th class="text-uppercase text-primary  font-weight-bolder text-center">الاحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                    <tr>
                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $subject->id }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $subject->subject_name }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $subject->class->class_name }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ count($subject->teachers) }}
                                            </p>
                                        </td>

                                        <td class="d-flex justify-content-center">
                                            <a href="{{route('subjects.show',$subject)}}" class="btn btn-dark pb-4 mx-2">عرض </a>
                                            @role('Super-Admin')
                                                <a href="{{route('subjects.edit',$subject)}}" class="btn btn-danger pb-4 mx-2">تعديل </a>
                                                <form action="{{route('subjects.destroy',$subject)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف</button>
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
       VirtualSelect.init({
        ele: '#sample-select',
        });
        VirtualSelect.init({
        ele: '#sample-select2',
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
