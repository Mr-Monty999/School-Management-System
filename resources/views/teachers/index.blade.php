@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المعلمين</h1>
        <form id="teachers" enctype="multipart/form-data" method="post">
            @csrf
            <br>
            <h4>بيانات المعلم</h4>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">اسم المعلم</label>
                <input type="text" name="teacher_name" class="form-control">
            </div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white">
                <select class="form-control" name="teacher_gender" id="">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">السكن</label>
                <input type="text" name="teacher_address" class="form-control">
            </div>


            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="teacher_phone" class="form-control">
            </div>


            <label class="text-dark">تاريخ ميلاد المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_birthdate" class="form-control">
            </div>


            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="teacher_hire_date" class="form-control">
            </div>


            <label class="text-dark"> راتب المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_salary" class="form-control">
            </div>


            <label class="text-dark"> الرقم الوطني :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="number" name="teacher_national_number" class="form-control">
            </div>



            <label class="text-dark">صورة المعلم :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="teacher_photo" class="form-control">
            </div>


            <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>


        </form>

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-white">{{ $error }}</div>
        @endforeach

        @if (Session::has('success'))
            <div class="alert alert-success text-white">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger text-white">{{ Session::get('error') }}</div>
        @endif

        <div class="input-group input-group-outline bg-white w-25 my-3 mtop-1">
            <label class="form-label"> بحث...</label>
            <input type="text" class="form-control" id="search">
        </div>
        <div class="container-fluid row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول المعلمين</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 mytable">
                        @include('teachers.table')
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

@push('ajax')
    <script>
        let form = $("form#teachers");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('teachers.store') }}",
                search = $("#search").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;



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
                    $("form#teachers").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                        '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                        '</div>');
                },
                complete: function() {
                    $(".spinner").remove();
                },
                success: function(response) {



                    $(".alert").remove();

                    $(".alert").remove();

                    let table = $(".mytable"),
                        tableUrl = "{{ route('teachers.table', '') }}/" + pageNumber;


                    if (search.trim() != "")
                        tableUrl = "{{ route('teachers.search', ['', '']) }}/" + pageNumber + "/" +
                        search;

                    $.ajax({
                        type: "get",
                        url: tableUrl,
                        data: "data",
                        success: function(res) {

                            table.empty();
                            table.append(res);

                        },
                        error: function(res) {
                            // console.log(res);

                        }
                    });

                    if (response.success) {

                        $("form#teachers input:not([type='date'])").val("");


                        $("form#teachers").after(
                            '<div class="alert alert-success text-white text-center">' + response
                            .message +
                            '</div>'
                        );

                    } else
                        $("form#teachers").after(
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

                        ///errorName = input field name (key) like teacher_name
                        $("form#teachers input[name='" + errorName + "']").parent().after(
                            '<div class="alert alert-danger text-white text-center">' +
                            errors[errorName] +
                            '</div>');
                    }

                }

            });

        });

        /// Search For teachers By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val().trim(),
                url = "{{ route('teachers.search', ['', '']) }}/1/" + search;


            if (search == "")
                url = "{{ route('teachers.table', '') }}/1";

            let table = $(".mytable");

            $.ajax({
                type: "get",
                url: url,
                data: "data",
                success: function(response) {

                    table.empty();
                    table.append(response);



                },
                error: function(response) {
                    // console.log(response);

                }
            });



        });

        //Delete teacher And Refresh The Table
        $(document).on("submit", "form#delete", function(e) {
            e.preventDefault();


            let teacherId = $(this).find("#id").val(),
                deleteteacher = confirm("هل أنت متأكد من حذف هذه الأستاذ؟"),
                url = "{{ route('teachers.destroy', '') }}/" + teacherId,
                search = $("#search").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;



            if (deleteteacher) {
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
                            tableUrl = "{{ route('teachers.table', '') }}/" + pageNumber;


                        if (search.trim() != "")
                            tableUrl = "{{ route('teachers.search', ['', '']) }}/" + pageNumber + "/" +
                            search;

                        $.ajax({
                            type: "get",
                            url: tableUrl,
                            data: "data",
                            success: function(res) {

                                table.empty();
                                table.append(res);

                            },
                            error: function(res) {
                                // console.log(res);

                            }
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
                url = "{{ route('teachers.table', '') }}/" + pageNumber;

            if (search.trim() != "")
                url = "{{ route('teachers.search', ['', '']) }}/" + pageNumber + "/" + search;



            $.ajax({
                type: "get",
                url: url,
                data: "data",
                success: function(response) {

                    table.empty();
                    table.append(response);

                },
                error: function(response) {
                    // console.log(response);

                }
            });
        });
    </script>
@endpush
