@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1> {{$subject->subject_name}}</h1>

        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{route('subjects.index')}}" class="btn btn-dark">رجوع</a>
                    <button type="button" class="btn btn-secondary " <?php echo count($teachers) == 0  ? 'disabled="disabled"' : '' ?> data-bs-toggle="modal" data-bs-target="#exampleModal">
                         اضافة معلم للمادة
                    </button>
                    <button type="button" class="btn btn-secondary " <?php echo count($subject->teachers) < 1  ? 'disabled="disabled"' : '' ?> data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        ازالة معلم
                   </button>
                </div>


                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center"> بيانات المادة</h6>
                        </div>
                        <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center m-6">
                                <tbody class="p-6">
                                    <tr>
                                        <td>رقم  المادة</td>
                                        <td> {{$subject->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>اسم المادة</td>
                                        <td> {{$subject->subject_name}}</td>
                                    </tr>
                                    <tr>
                                        <td> الفصل</td>
                                        <td> <a href="{{route('classes.show',$subject->class)}}">{{$subject->class->class_name}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>المعلمين</td>
                                            <td>
                                                @foreach ($subject->teachers as $teacher)
                                                     <a href="{{route('teachers.show',$teacher)}}">{{$teacher->teacher_name}}</a>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!--  Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
           <div class="modal-content">
               <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">اضافة معلم للمادة </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form method="POST" action="{{route('subjects.attachTeacher',$subject)}}">
                       @csrf
                   <label for="choice" class="text-lg mb-3">أدخل اسم المعلم</label>

               <div class="input-group input-group-outline bg-white" style="margin-bottom:20px">
                   <select name="teachers" id="sample-select" multiple class="mb-6">
                       @foreach ($teachers as $teacher)
                           <option value="{{$teacher->id}}">{{$teacher->teacher_name}}</option>
                       @endforeach
                   </select>
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

   <!--  Modal -->
   <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">ازالة معلم من المادة </h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <form method="POST" action="{{route('subjects.detachTeacher',$subject)}}">
                   @csrf
               <label for="choice" class="text-lg mb-3">أدخل اسم المعلم</label>

           <div class="input-group input-group-outline bg-white" style="margin-bottom:20px" >
               <select name="teachers" id="sample-select2" multiple class="mb-6">
                   @foreach ($subject->teachers as $teacher)
                       <option value="{{$teacher->id}}">{{$teacher->teacher_name}}</option>
                   @endforeach
               </select>
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

@push('ajax')
    <script>
       VirtualSelect.init({
        ele: '#sample-select',
        });

        VirtualSelect.init({
        ele: '#sample-select2',
        });
    </script>
@endpush

{{-- @push('ajax')
    <script>
        $("input[type=date]").val(new Date().toISOString().slice(0, 10));


        let form = $(".students");

        form.on("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $("form .alert").hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "post",
                url: "{{ route('students.store') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {





                    ///Show Success Or Error Message
                    if (response.success) {
                        $("form .validate_success").text(response.message).show();

                        /* Not Finished Yet !
                                                console.log(response);
                                                ///if Rows Less Than 5 , Then Append
                                                if ($("tbody").children().length < 100) {
                                                    $("tbody").prepend("<tr>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.id + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'></p>" + response
                                                        .data.student_name + "</td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_class + "</p></td>");
                                                    $("tbody").prepend(
                                                        "<td><p class='text-dark text-center'>{{ asset('+response.data.student_photo+') }}</p></td>"
                                                    );
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_registered_date + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_birthdate + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.student_paid_price + "</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>-</p></td>");
                                                    $("tbody").prepend("<td><p class='text-dark text-center'>" + response
                                                        .data.parent_name + "</p></td>");

                                                    $("tbody").prepend("</tr>");

                                                }
                        */
                    } else
                        $("form .validate_error").text(response.message).show();

                },
                error: function(response) {


                    //errors = Validtion Errors keys
                    let errors = response.responseJSON.errors;

                    for (let errorName in errors) {

                        ///errorName = input field name (key) like student_name
                        $("form ." + errorName + "").text(errors[errorName]).show();
                    }

                }

            });

        });
    </script>
@endpush --}}
