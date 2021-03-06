@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المواد الدراسية</h1>
        <form enctype="multipart/form-data" method="post" id="subjects">
            @csrf
            <br>
            <h4>اضافة مادة</h4>
            <div>

                <div class="input-group input-group-outline my-3 bg-white">
                    <label class="form-label">اسم المادة</label>
                    <input type="text" name="subject_name" class="form-control ">
                </div>
                <div style="display:none" class="alert alert-danger text-white text-center subject_paid_price"></div>

                <label class="form-label" for="sample-select2">اسم الفصل </label>
                <div class="input-group input-group-outline mb-3">
                    <select name="class_id" id="sample-select2">
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="form-label" for="sample-select">المعلمين <span class="text-sm">(اختياري)</span></label>
                <div class="input-group input-group-outline mb-3">
                    <select name="teachers" id="sample-select" multiple>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
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


        <div class="input-group input-group-outline bg-white w-25 my-3 mtop-1">
            <label class="form-label"> بحث...</label>
            <input type="text" class="form-control" id="search">
        </div>
        <div class="container-fluid row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول المواد الدراسية</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 mytable">
                        @include('subjects.table')
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


        let form = $("form#subjects");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('subjects.store') }}",
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
                    $("form#subjects").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                        '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                        '</div>');
                },
                complete: function() {
                    $(".spinner").remove();
                },
                success: function(response) {



                    $(".alert").remove();

                    let table = $(".mytable"),
                        tableUrl = "{{ route('subjects.table', '') }}/" + pageNumber;


                    if (search.trim() != "")
                        tableUrl = "{{ route('subjects.search', ['', '']) }}/" + pageNumber + "/" +
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
                        $("form#subjects").after(
                            '<div class="alert alert-success text-white text-center">' + response
                            .message +
                            '</div>'
                        );
                        /* Not Finished Yet !
                                                console.log(response);
                                                ///if Rows Less Than 5 , Then Append
                                                if ($("tbody").children().length < 100) {
                                                    $("tbody").prepend("<tr>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.id + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.subject_name + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.subject_class + "</p></td>");
                                                    $("tbody").prepend(
                                                        "<td><p class='text-dark text-center'>{{ asset('+response.data.subject_photo+') }}</p></td>"
                                                    );
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.subject_registered_date + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.subject_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.subject_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.subject_paid_price + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>-</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.parent_name + "</p></td>");

                                                    $("tbody").prepend("</tr>");

                                                }
                        */
                    } else
                        $("form#subjects").after(
                            '<div class="alert alert-danger text-white text-center">' + response
                            .message +
                            '</div>'
                        );

                },
                error: function(response) {

                    // console.log(response);
                    $(".alert").remove();

                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {


                        $("form#subjects").after(
                            '<div class="alert alert-danger text-white text-center">' + errors[
                                errorName] +
                            '</div>'
                        );
                    }

                }

            });

        });

        /// Search For subjects By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val().trim(),
                url = "{{ route('subjects.search', ['', '']) }}/1/" + search;


            if (search == "")
                url = "{{ route('subjects.table', '') }}/1";

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

        //Delete subject And Refresh The Table
        $(document).on("submit", "form#delete", function(e) {
            e.preventDefault();


            let subjectId = $(this).find("#id").val(),
                deletesubject = confirm("هل أنت متأكد من حذف هذه المادة؟"),
                url = "{{ route('subjects.destroy', '') }}/" + subjectId,
                search = $("#search").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;



            if (deletesubject) {
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
                            tableUrl = "{{ route('subjects.table', '') }}/" + pageNumber;


                        if (search.trim() != "")
                            tableUrl = "{{ route('subjects.search', ['', '']) }}/" + pageNumber + "/" +
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
                url = "{{ route('subjects.table', '') }}/" + pageNumber;

            if (search.trim() != "")
                url = "{{ route('subjects.search', ['', '']) }}/" + pageNumber + "/" + search;



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
