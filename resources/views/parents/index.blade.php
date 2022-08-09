@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة أولياء الأمور</h1>

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
        <div class="input-group input-group-outline bg-white w-25 my-6">
            <label class="form-label"> بحث...</label>
            <input type="text" class="form-control" id="search">
        </div>
        <div class="container-fluid row mytable">

            @include('parents.table')

        </div>



    </div>
@endsection


@push('ajax')
    <script>
        //  const search = document.querySelector('#search')
        //         console.log(search)
        //         search.addEventListener('change', () => console.log(55))

        //Sort And Refresh The Table
        $(document).on("change", "#sort-by", function(e) {
            e.preventDefault();


            let = search = $("#search").val(),
                sortBy = $("#sort-by").val(),
                pageNumber = $(".pagination .active").text();

            if (pageNumber == "")
                pageNumber = 1;


            let table = $(".mytable"),
                url = "{{ route('parents.table', ['', '', '']) }}/" + pageNumber +
                "/" +
                sortBy + "/" +
                search;

            if (pageNumber == "")
                pageNumber = 1;


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

        /// Search For Parents By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val(),
                sortBy = $("#sort-by").val(),
                url = "{{ route('parents.table', ['', '', '']) }}/1/" + sortBy + "/" + search,
                table = $(".mytable");



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
                sortBy = $("#sort-by").val(),
                url = "{{ route('parents.table', ['', '', '']) }}/" + pageNumber + "/" + sortBy + "/" + search;




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
