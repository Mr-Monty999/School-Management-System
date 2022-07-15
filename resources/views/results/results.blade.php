@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة النتائج</h1>
        {{-- <form enctype="multipart/form-data" method="post" >
            @csrf
            <br>
            <h4> الفصول</h4>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">اسم الفصل</label>
                <input type="text" name="class_name" class="form-control">
            </div>
            <div style="display:none" class="alert alert-danger text-white text-center class_name"></div>
                <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>
            <div style="display:none" class="alert alert-success text-white text-center validate_success"></div>
            <div style="display:none" class="alert alert-danger text-white text-center validate_error"></div>

        </form> --}}

        {{-- @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-white">{{ $error }}</div>
        @endforeach

        @if (Session::has('success'))
            <div class="alert alert-success text-white">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger text-white">{{ Session::get('error') }}</div>
        @endif --}}


        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a class="btn btn-dark" href="{{url()->previous()}}">رجوع</a>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        اضافة نتيجة
                    </button>
                </div>

                <div class="card my-4">

                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> {{$student->student_name}}</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>

                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> اسم المادة</th>
                                        @can('teacher.view')
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> معلم المادة </th>
                                        @endcan
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">  الدرجة المتحصلة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">  الدرجة الكاملة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">  الأحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student->results as $result)
                                    <tr>
                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $result->id }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                @can('subject.view')
                                                    <a href="{{route('subjects.show',$result->subject)}}">{{ $result->subject->subject_name }}</a>
                                                @else
                                                    {{$result->subject->subject_name }}
                                                @endcan
                                            </p>
                                        </td>
                                        @can('teacher.view')
                                            <td>
                                                <p class="text-dark text-center">
                                                    @foreach ($result->subject->teachers as $teacher)
                                                        <a class="" href="{{route('teachers.show',$teacher)}}">{{ $teacher->teacher_name }}</a>
                                                    @endforeach
                                                </p>
                                            </td>
                                        @endcan
                                        <td >
                                            <p class="text-dark text-center">
                                                {{ $result->result }}
                                            </p>
                                        </td>

                                        <td >
                                            <p class="text-dark text-center">
                                                {{ $result->full_mark }}
                                            </p>
                                        </td>

                                        <td >
                                            <form action="{{route('results.destroy',$result)}}" method="POST" class="text-dark text-center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>

    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
           <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">اضافة نتيجة </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form method="POST" action="{{route('results.assignResult',$student)}}">
                       @csrf

               <label class="text-dark">المادة</label>
                   <div class="input-group input-group-outline my-3 bg-white ">
                       <select class="form-control " name="subject_id" id="subject_id">
                           @foreach ($student->class->subjects as $subject)
                               <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                           @endforeach

                       </select>
                   </div>

                   <label for="choice" class="text-lg mb-3"> الدرجة المستحقة </label>
                   <div class="input-group input-group-outline bg-white" style="margin-bottom:20px">
                         <input type="text" name="result" class="form-control">
                    </div>

                    <label for="choice" class="text-lg mb-3">الدرجة الكاملة</label>
                    <div class="input-group input-group-outline bg-white" style="margin-bottom:20px">
                        <input type="text" name="full_mark" class="form-control">
                    </div>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
               <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
               </form>
               </div>
           </div>
       </div>
   </div>
@endsection
{{--
 @push('ajax')
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
@endpush
 --}}
