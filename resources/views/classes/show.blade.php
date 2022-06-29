@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1> {{$class->class_name}}</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <a href="{{url()->previous()}}" class="btn btn-dark">رجوع</a>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> {{$class->class_name}}</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody class="text-center">
                                    <tr>
                                        <td>اسم الفصل </td>
                                        <td> {{$class->class_name}} </td>
                                    </tr>
                                    <tr>
                                        <td>عدد الطلاب </td>
                                        <td> {{$class->students_count}} </td>
                                    </tr>
                                    <tr>
                                        <td> عدد المواد  </td>
                                        <td>{{count($class->subjects)}}  </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h2 class="text-center mt-5">المواد</h2>

                            <table class="table align-items-center mt-3 text-center">
                                <thead>
                                    <tr>
                                        <th>رقم المادة</th>
                                        <th>اسم المادة</th>
                                        <th>المعلمين</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($class->subjects as $subject)
                                        <tr>
                                            <td>{{$subject->id}}</td>
                                            <td>{{$subject->subject_name}}</td>
                                            @forelse ($subject->teachers as $teacher)
                                                <td>
                                                    <a href="{{route('teachers.show',$teacher->id)}}">{{$teacher->teacher_name}}</a> -
                                                </td>
                                            @empty
                                            <td>لا يوجد </td>
                                            @endforelse
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

{{--  @push('ajax')
    <script>
        $("input[type=date]").val(new Date().toISOString().slice(0, 10));


        let form = $("form");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $("form .alert").hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "post",
                url: "{{ route('classes.store') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {

                    if (response.success)
                        $("form .validate_success").text(response.message).show();
                    else
                        $("form .validate_error").text(response.message).show();


                },
                error: function(response) {

                    console.log(response);

                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {

                        ///errorName = input field name (key) like class_name
                        $("form ." + errorName + "").text(errors[errorName]).show();
                    }

                }

            });

        });
    </script>
@endpush --}}

