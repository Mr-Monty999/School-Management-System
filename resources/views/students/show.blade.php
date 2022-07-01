@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الطلاب</h1>
        {{-- <form class="students" action="" enctype="multipart/form-data" method="post">
            @csrf
            <br>
            <h4>بيانات الطالب</h4>
            <div class="input-group input-group-outline  bg-white">
                <label class="form-label">اسم الطالب</label>
                <input type="text" name="student_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_name"></div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white">
                <select class="form-control" name="student_genre" id="">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_genre"></div>

            <label class="text-dark">السنة الدراسية :</label>
            <div class="input-group input-group-outline my-3 bg-white">
                <select class="form-control" name="class_id" id="">
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="input-group input-group-outline  bg-white">
                <label class="form-label">السكن</label>
                <input type="text" name="student_address" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_address"></div>

            <label class="text-dark">تاريخ ميلاد الطالب :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="student_birthdate" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_birthdate"></div>

            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="student_registered_date" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_registered_date"></div>

            <label class="text-dark">صورة الطالب :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="student_photo" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_photo"></div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">الرسوم المدفوعة</label>
                <input type="text" name="student_paid_price" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_paid_price"></div>

            <h4>بيانات ولي أمر الطالب</h4>

            <div class="input-group input-group-outline  bg-white">
                <label class="form-label">اسم ولي أمر الطالب </label>
                <input type="text" name="parent_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_name"></div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">مهنة ولي أمر الطالب </label>
                <input type="text" name="parent_job" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_job"></div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">رقم هاتف ولي أمر الطالب </label>
                <input type="text" name="parent_phone" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_phone"></div>

            <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>
            <div style="display:none" class="alert alert-success text-white text-center validate_success"></div>
            <div style="display:none" class="alert alert-danger text-white text-center validate_error"></div>

        </form>
 --}}
       {{--  @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-white">{{ $error }}</div>
        @endforeach

        @if (Session::has('success'))
            <div class="alert alert-success text-white">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger text-white">{{ Session::get('error') }}</div>
        @endif --}}


        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> بيانات الطالب</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-4 p-4">
                                <tbody class="p-6">
                                    <tr>
                                        <td>رقم الطالب</td>
                                        <td> {{$student->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>اسم الطالب</td>
                                        <td> {{$student->student_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>عنوان الطالب</td>
                                        <td> {{$student->student_address}}</td>
                                    </tr>
                                    <tr>
                                        <td> الجنس</td>
                                        <td> {{$student->student_genre}}</td>
                                    </tr>
                                    <tr>
                                        <td> تاريخ الميلاد</td>
                                        <td> {{$student->student_birthdate}}</td>
                                    </tr>
                                    <tr>
                                        <td> ناريخ التسجيل</td>
                                        <td> {{$student->student_registered_date}}</td>
                                    </tr>
                                    <tr>
                                        <td> الرسوم المقررة</td>
                                        <td> {{$student->student_paid_price}}</td>
                                    </tr>
                                    <tr>
                                        <td> الرسوم المدفوعة</td>
                                        <td> {{$student->student_paid_price}}</td>
                                    </tr>
                                    <tr>
                                        <td> الرسوم المتبقية</td>
                                        <td> {{$student->student_paid_price}}</td>
                                    </tr>
                                    <tr>
                                        <td>صورة الطالب</td>
                                        <td> <img height="100px" width="100px" src="{{asset($student->student_photo)}}" alt="لا توجد صورة"></td>
                                    </tr>
                                    <tr>
                                        <td> الرقم الوطني</td>
                                        <td> {{$student->student_national_number}}</td>
                                    </tr>

                                    <tr>
                                        <td> الفصل</td>
                                        <td> <a href="{{route('classes.show',$student->class)}}">{{$student->class->class_name}}</a></td>
                                    </tr>

                                    <tr>
                                        <td> اسم المستخدم</td>
                                        <td> {{$student->user->username}}<td>
                                    </tr>

                                </tbody>
                            </table>

                            <h3 class="my-5 text-center">بيانات ولي أمر الطالب</h3>
                            <table class="table align-items-center mb-0">
                                <tr>
                                    <td>رقم ولي الأمر</td>
                                    <td> {{$student->parent->id}}</td>
                                </tr>
                                <tr>
                                    <td>اسم ولي الأمر</td>
                                    <td> <a href="{{route('parents.show',$student->parent)}}">{{$student->parent->parent_name}}</a></td>
                                </tr>
                                <tr>
                                    <td>هاتف ولي الأمر</td>
                                    <td> {{$student->parent->parent_phone}}</td>
                                </tr>
                                <tr>
                                    <td>مهنة ولي الأمر</td>
                                    <td> {{$student->parent->job}}</td>
                                </tr>
                                <tr>
                                    <td>الرقم الوطني</td>
                                    <td> {{$student->parent->parent_national_number}}</td>
                                </tr>
                                <tr>
                                    <td>صورة ولي الأمر</td>
                                    <td> <img src="{{asset($student->parent->parent_photo)}}" alt="لا توجد صورة"></td>
                                </tr>
                            </table>

                            <h3 class="my-5 text-center"> أشقاء الطالب</h3>
                            <table class="table align-items-center mb-4 p-4">
                                <thead>
                                    <tr>
                                        <th>رقم الطالب</th>
                                        <th>اسم الطالب</th>
                                        <th>الفصل</th>
                                    </tr>
                                </thead>
                                <tbody class="p-6">
                                    @forelse ($siblings as $sibling)
                                    <tr>
                                        <td> {{$sibling->id}}</td>
                                        <td> <a href="{{route('students.show',$sibling)}}">{{$sibling->student_name}}</a></td>
                                        <td> <a href="{{route('classes.show',$sibling->class)}}">{{$sibling->class->class_name}}</a></td>
                                    </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
@endsection


{{-- @push('ajax')
    <script>
        $("input[type=date]").val(new Date().toISOString().slice(0, 10));


        let form = $(".students");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $("form .alert").hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "post",
                url: "{{ route('students.store') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {





                    ///Show Success Or Error Message
                    if (response.success) {
                        $("form .validate_success").text(response.message).show();

                        /* Not Finished Yet !
                                                console.log(response);
                                                ///if Rows Less Than 5 , Then Append
                                                if ($("tbody").children().length < 100) {
                                                    $("tbody").prepend("<tr>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.id + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.student_name + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_class + "</p></td>");
                                                    $("tbody").prepend(
                                                        "<td><p class='text-dark text-center'>{{ asset('+response.data.student_photo+') }}</p></td>"
                                                    );
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_registered_date + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_paid_price + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>-</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.parent_name + "</p></td>");

                                                    $("tbody").prepend("</tr>");

                                                }
                        */
                    } else
                        $("form .validate_error").text(response.message).show();

                },
                error: function(response) {


                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {

                        ///errorName = input field name (key) like student_name
                        $("form ." + errorName + "").text(errors[errorName]).show();
                    }

                }

            });

        });
    </script>
@endpush --}}
