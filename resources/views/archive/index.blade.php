@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1> أرشيف المستخدمين</h1>

        <div class="input-group input-group-outline bg-white w-25 my-3 mtop-1">
            <label class="form-label"> بحث...</label>
            <input type="text" class="form-control" id="search">
        </div>
        <div class="container-fluid row">

            <div class="col-12">

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول المستخدمين</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 mytable">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder">
                                            الرقم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            اسم المستخدم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                             الاسم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">نوع المستخدم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $user->id }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $user->username }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-dark text-center">
                                                    {{ $user[$user->type][$user->type.'_name'] }}
                                                </p>
                                            </td>

                                            <td>
                                                {{ $user->type }}
                                            </td>
                                            <td class="align-middle text-center">
                                                <form id="delete" action="{{route('archive.destroy',$user)}}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input hidden type="text" id="id" value="{{ $user }}">
                                                    <button type="submit" class="btn btn-danger"> حذف من الأرشيف</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        {!! $users->links() !!}
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

@push('ajax')
    <script>
        let form = $("form#employees");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this),
                url = "{{ route('employees.store') }}",
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
                    $("form#employees").after('<div class="d-flex spinner"><p>جار المعالجة...</p>' +
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
                        tableUrl = "{{ route('employees.table', '') }}/" + pageNumber;


                    if (search.trim() != "")
                        tableUrl = "{{ route('employees.search', ['', '']) }}/" + pageNumber + "/" +
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

                        $("form#employees input:not([type='date'])").val("");


                        $("form#employees").after(
                            '<div class="alert alert-success text-white text-center">' + response
                            .message +
                            '</div>'
                        );

                    } else
                        $("form#employees").after(
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

                        ///errorName = input field name (key) like employe_name
                        $("form#employees input[name='" + errorName + "']").parent().after(
                            '<div class="alert alert-danger text-white text-center">' +
                            errors[errorName] +
                            '</div>');
                    }

                }

            });

        });

        /// Search For employees By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val().trim(),
                url = "{{ route('employees.search', ['', '']) }}/1/" + search;


            if (search == "")
                url = "{{ route('employees.table', '') }}/1";

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

        //Delete employe And Refresh The Table
        /* $(document).on("submit", "form#delete", function(e) {
            e.preventDefault();


            let employeId = $(this).find("#id").val(),
                deleteemploye = confirm("هل أنت متأكد من حذف هذا الموظف؟"),
                url = "{{ route('archive.destroy', '') }}/" + employeId,
                search = $("#search").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


            if (deleteemploye) {
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
                            tableUrl = "{{ route('employees.table', '') }}/" + pageNumber;


                        if (search.trim() != "")
                            tableUrl = "{{ route('employees.search', ['', '']) }}/" + pageNumber +
                            "/" +
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

        }); */


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
                url = "{{ route('employees.table', '') }}/" + pageNumber;

            if (search.trim() != "")
                url = "{{ route('employees.search', ['', '']) }}/" + pageNumber + "/" + search;



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
