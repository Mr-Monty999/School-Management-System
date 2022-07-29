@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة أولياء الأمور</h1>

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




        /// Search For Parents By Name On keyup Event //
        $(document).on("keyup change", "#search", function() {

            $(".alert").remove();

            let search = $(this).val(),
                url = "{{ route('parents.search', ['', '']) }}/1/" + search,
                table = $(".mytable");


            if (search.trim() == "")
                url = "{{ route('parents.table', '') }}/1";

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
                url = "{{ route('parents.table', '') }}/" + pageNumber;

            if (search.trim() != "")
                url = "{{ route('parents.search', ['', '']) }}/" + pageNumber + "/" + search;



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
