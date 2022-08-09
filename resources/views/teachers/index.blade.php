@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المعلمين</h1>
        <div class="my-3">
            <label for="sort-by" class="">ترتيب حسب :</label>
            <div class="input-group input-group-outline">
                <select class="form-control bg-white" id="sort-by" name="sort_by">
                    <option value="last" selected>من الأخر الى الأول</option>
                    <option value="first">من الأول الى الأخر</option>
                    <option value="name">الأسم</option>
                </select>
            </div>
        </div>

        <div class="input-group input-group-outline bg-white w-25">
            <label class="form-label"> بحث...</label>
            <input type="text" class="form-control" id="search">
        </div>
        <div class="container-fluid row">
            <div class="col-12">
                <div class="d-flex justify-content-between mb-5">
                    <a href="{{ route('teachers.create') }}" class="btn btn-dark">اضافة معلم</a>
                </div>
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

        <button class="btn btn-danger" type="button" id="delete-all">حذف جميع المعلمين</button>




    </div>
@endsection

@push('ajax')
    <script>
        //Sort And Refresh The Table
        $(document).on("change", "#sort-by", function(e) {
            e.preventDefault();


            let = search = $("#search").val(),
                sortBy = $("#sort-by").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


            let table = $(".mytable"),
                url = "{{ route('teachers.table', ['', '', '']) }}/" + pageNumber +
                "/" +
                sortBy + "/" +
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

        //Delete All teachers And Refresh The Table
        $(document).on("click", "#delete-all", function(e) {
            e.preventDefault();


            let = deleteAllArchives = confirm("هل أنت متأكد من حذف جميع البيانات؟"),
                url = "{{ route('teachers.destroy.all') }}",
                sortBy = $("#sort-by").val(),
                search = $("#search").val()
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

                        console.log(response);

                        $(".alert").remove();

                        let table = $(".mytable"),
                            tableUrl = "{{ route('teachers.table', ['', '', '']) }}/1/" + sortBy +
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

        /// Search For teachers By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val(),
                sortBy = $("#sort-by").val(),
                url = "{{ route('teachers.table', ['', '', '']) }}/1/" + sortBy + "/" + search;



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
                sortBy = $("#sort-by").val(),
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
                            tableUrl = "{{ route('teachers.table', ['', '', '']) }}/" + pageNumber +
                            "/" +
                            sortBy + "/" +
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
                sortBy = $("#sort-by").val(),
                url = "{{ route('teachers.table', ['', '', '']) }}/" + pageNumber + "/" + sortBy + "/" + search;



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
