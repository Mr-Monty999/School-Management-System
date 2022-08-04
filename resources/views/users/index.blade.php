@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المستخدمين</h1>


        <div class="input-group input-group-outline bg-white w-25 my-3 mtop-1">
            <label class="form-label"> بحث...</label>
            <input type="text" class="form-control" id="search">
        </div>

        <div class="container-fluid row">
            <div class="col-12">
                <a class="btn btn-dark" href="{{ route('roles.index') }}">عرض الرتب</a>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">ادارة المستخدمين</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 mytable">
                        @include('users.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('ajax')
    <script>
        /// Search For users By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val().trim(),
                url = "{{ route('users.search', ['', '']) }}/1/" + search;


            if (search == "")
                url = "{{ route('users.table', '') }}/1";

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
                url = "{{ route('users.table', '') }}/" + pageNumber;

            if (search.trim() != "")
                url = "{{ route('users.search', ['', '']) }}/" + pageNumber + "/" + search;



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
