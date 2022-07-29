@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الطلاب</h1>
        {{-- <form class="students" action="{{route('students.store')}}" enctype="multipart/form-data" method="post">
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

            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label"> الرقم الوطني</label>
                <input type="text" name="student_national_number" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center student_national_number"></div>

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

            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label"> الرقم الوطني</label>
                <input type="text" name="parent_national_number" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center parent_national_number"></div>


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
        @endif --}}
        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="d-flex justify-content-between mb-5">
                    <div class="input-group input-group-outline bg-white w-25">
                        <label class="form-label"> بحث...</label>
                        <input type="text" class="form-control" id="search">
                    </div>
                    <a href="{{ route('students.create') }}" class="btn btn-dark">اضافة طالب</a>
                </div>

                <div class="card my-4 mytable">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">

                            <h6 class="text-white text-capitalize ps-3 text-center">جدول الطلاب</h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @include('students.table')
                    </div>

                </div>

            </div>



        </div>
    @endsection

    @push('ajax')
        <script>
            const search = document.querySelector('#search')
            console.log(search)
            search.addEventListener('change', () => console.log(55))
        </script>
    @endpush
    @push('ajax')
        <script>
            //Delete Student And Refresh The Table
            // let form = $("form");
            // console.log(form);

            $(document).on("keyup", "#search", function() {

                $(".alert").remove();

                let search = $(this).val(),
                    url = "{{ route('students.search', ['', '']) }}/1/" + search;


                if (search.trim() == "")
                    url = "{{ route('students.table', '') }}/1";

                let table = $(".mytable");

                table.load(url, function(response, status,
                    request) {});



            });

            $(document).on("submit", "form#delete", function(e) {
                e.preventDefault();


                let studentId = $(this).parent().find("#id").val(),
                    deleteStudent = confirm("هل أنت متأكد من حذف هذا الطالب"),
                    url = "{{ route('students.destroy', '') }}/" + studentId,
                    search = $("#search").val(),
                    pageNumber = $(".pagination .active").text();

                if (pageNumber == "")
                    pageNumber = 1;


                if (deleteStudent) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        method: "post",
                        url: url,
                        data: new FormData(this),
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            $("mytable").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                                '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                                '</div>');
                        },
                        complete: function() {
                            $(".spinner").remove();
                        },
                        success: function(response) {



                            $(".alert").remove();

                            let table = $(".mytable"),
                                tableUrl = "{{ route('students.table', '') }}/" + pageNumber;


                            if (search.trim() != "")
                                tableUrl = "{{ route('students.search', ['', '']) }}/" + pageNumber + "/" +
                                search;

                            table.load(tableUrl, function(response, status,
                                request) {

                            });


                            ///Show Success Or Error Message
                            if (response.success) {
                                $(".mytable").after(
                                    '<div class="alert alert-success text-white text-center">' +
                                    response
                                    .message +
                                    '</div>'
                                );

                            } else
                                $(".mytable").after(
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


                                $(".mytable").after(
                                    '<div class="alert alert-danger text-white">' + errors[
                                        errorName] +
                                    '</div>'
                                );
                            }


                        }

                    });
                }

            });


            //Load Table By Page Number//
            $(document).on("click", ".pagination .page-link", function(e) {
                e.preventDefault();



                let pageNumber = parseInt($(this).text());

                if ($(this).attr("rel") == "prev")
                    pageNumber = parseInt($(".pagination .active").text()) - 1;
                else if ($(this).attr("rel") == "next")
                    pageNumber = parseInt($(".pagination .active").text()) + 1;



                let table = $(".mytable"),
                    search = $("#search").val(),
                    url = "{{ route('students.table', '') }}/" + pageNumber;

                if (search.trim() != "")
                    url = "{{ route('students.search', ['', '']) }}/" + pageNumber + "/" + search;



                table.load(url, function(response, status,
                    request) {});
            });
        </script>
    @endpush
