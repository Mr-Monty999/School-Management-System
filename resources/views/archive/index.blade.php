@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1> أرشيف المستخدمين</h1>


        <div class="my-3">
            <label for="view-by" class="text-dark">عرض:</label>
            <div class="input-group input-group-outline">
                <select class="form-control bg-white" id="view-by" name="view_by">
                    <option value="all" selected>الكل</option>
                    <option value="students">الطلاب فقط</option>
                    <option value="teachers">المعلمين فقط</option>
                    <option value="employees">الموظفين فقط</option>
                </select>
            </div>
        </div>
        <div class="input-group input-group-outline bg-white w-25 my-3">
            <label class="form-label"> بحث...</label>
            <input type="text" class="form-control" id="search">
        </div>
        <div class="container-fluid row">

            <div class="col-12">

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول الأرشيف</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 mytable">
                        @include('archive.table')
                    </div>
                </div>
            </div>

        </div>

        <button class="btn btn-success" type="button" id="restore-all">استعادة جميع البيانات</button>
        <button class="btn btn-danger" type="button" id="delete-all">حذف جميع البيانات</button>


    </div>
@endsection

@push('ajax')
    <script>
        //View And Refresh The Table
        $(document).on("change", "#view-by", function(e) {
            e.preventDefault();


            let = search = $("#search").val(),
                viewBy = $("#view-by").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


            let table = $(".mytable"),
                url = "{{ route('archive.table', ['', '', '']) }}/" + pageNumber +
                "/" +
                viewBy + "/" +
                search;




            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "get",
                url: url,
                data: "",
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


                    table.empty();
                    table.append(response);


                },
                error: function(response) {

                    $(".alert").remove();



                }

            });


        });

        //Delete All archive And Refresh The Table
        $(document).on("click", "#delete-all", function(e) {
            e.preventDefault();


            let archiveId = $(this).find("#id").val(),
                deleteAllArchives = confirm("هل أنت متأكد من حذف جميع البيانات؟"),
                url = "{{ route('archive.destroy.all') }}",
                viewBy = $("#view-by").val(),
                search = $("#search").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


            if (deleteAllArchives) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: "post",
                    url: url,
                    data: "",
                    dataType: "json",
                    beforeSend: function() {
                        $(".mytable").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                            '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                            '</div>');
                    },
                    complete: function() {
                        $(".spinner").remove();
                    },
                    success: function(response) {


                        $(".alert").remove();

                        let table = $(".mytable"),
                            tableUrl = "{{ route('archive.table', ['', '', '']) }}/1/" + viewBy +
                            "/" + search;



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
        //Restore All archive And Refresh The Table
        $(document).on("click", "#restore-all", function(e) {
            e.preventDefault();


            let archiveId = $(this).find("#id").val(),
                restoreArchive = confirm("هل أنت متأكد من إستعادة جميع البيانات؟"),
                url = "{{ route('archive.restore.all') }}",
                viewBy = $("#view-by").val(),
                search = $("#search").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


            if (restoreArchive) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: "post",
                    url: url,
                    data: "",
                    dataType: "json",
                    beforeSend: function() {
                        $(".mytable").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                            '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                            '</div>');
                    },
                    complete: function() {
                        $(".spinner").remove();
                    },
                    success: function(response) {


                        $(".alert").remove();

                        let table = $(".mytable"),
                            tableUrl = "{{ route('archive.table', ['', '', '']) }}/1/" + viewBy +
                            "/" + search;



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

        /// Search For archive By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val(),
                viewBy = $("#view-by").val(),
                url = "{{ route('archive.table', ['', '', '']) }}/1/" + viewBy + "/" + search;

            let table = $(".mytable");

            $.ajax({
                type: "get",
                url: url,
                data: "data",
                success: function(response) {
                    console.log(response);
                    table.empty();
                    table.append(response);



                },
                error: function(response) {
                    console.log(response);

                }
            });



        });

        //Delete archive And Refresh The Table
        $(document).on("submit", "form#delete", function(e) {
            e.preventDefault();


            let archiveId = $(this).find("#id").val(),
                deletearchive = confirm("هل أنت متأكد من حذف هذا الحساب ؟ لن تتمكن من إرجعاه مرة أخرى !"),
                url = "{{ route('archive.destroy', '') }}/" + archiveId,
                search = $("#search").val(),
                viewBy = $("#view-by").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


            if (deletearchive) {
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
                        $(".mytable").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                            '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                            '</div>');
                    },
                    complete: function() {
                        $(".spinner").remove();
                    },
                    success: function(response) {


                        $(".alert").remove();

                        let table = $(".mytable"),
                            tableUrl = "{{ route('archive.table', ['', '', '']) }}/" + pageNumber +
                            "/" +
                            viewBy + "/" +
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

        //Restore archive And Refresh The Table
        $(document).on("submit", "form#restore", function(e) {
            e.preventDefault();


            let archiveId = $(this).find("#id").val(),
                url = "{{ route('archive.restore', '') }}/" + archiveId,
                search = $("#search").val(),
                viewBy = $("#view-by").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


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
                    $(".mytable").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
                        '<div class="spinner-border text-primary margin-1" role="status"></div>' +
                        '</div>');
                },
                complete: function() {
                    $(".spinner").remove();
                },
                success: function(response) {


                    $(".alert").remove();


                    let table = $(".mytable"),
                        tableUrl = "{{ route('archive.table', ['', '', '']) }}/" + pageNumber +
                        "/" +
                        viewBy + "/" +
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


        });

        //Load Table By Page Number/s/
        $(document).on("click", ".pagination .page-link", function(e) {
            e.preventDefault();


            let pageNumber = parseInt($(this).text());

            if ($(this).attr("rel") == "prev")
                pageNumber = parseInt($(".pagination .active").text()) - 1;
            else if ($(this).attr("rel") == "next")
                pageNumber = parseInt($(".pagination .active").text()) + 1;



            let table = $(".mytable"),
                search = $("#search").val(),
                viewBy = $("#view-by").val(),
                url = "{{ route('archive.table', ['', '', '']) }}/" + pageNumber + "/" + viewBy + "/" + search;


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
