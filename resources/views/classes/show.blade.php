@extends('layouts.dashboard')

@section('section')
            <!-- Modal -->
            <div class="modal fade " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مادة جديدة </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('classes.addSubjectToClass')}}">
                                @csrf
                            <input type="hidden" name="class_id" value="{{$class->id}}">
                        <label for="choice" class="text-lg mb-3">أدخل اسم المادة</label>

                        <div class="input-group input-group-outline bg-white" style="margin-bottom:20px">
                            <input type="text" name="subject_name" class="form-control" required >
                        </div>

                    <label class="text-dark">المعلمين</label>
                        <div class="input-group input-group-outline my-3 bg-white mb-6">
                            <select class="form-control mb-6" name="teachers" id="teachers" multiple>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
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
         <div class="d-flex flex-column justify-content-center align-items-center">
        <h1> {{$class->class_name}}</h1>
        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <a href="{{route('classes.index')}}" class="btn btn-dark">رجوع</a>
                    <button type="button" class="btn btn-secondary " <?php echo count($class->students) < 1  ? 'disabled="disabled"' : '' ?> data-bs-toggle="modal" data-bs-target="#exampleModal">
                         نقل طالب
                     </button>
                     <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        اضافة مواد
                     </button>
                    {{-- This feature not finished yet --}}

                </div>
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
                                        <td>رقم الفصل </td>
                                        <td> {{$class->id}} </td>
                                    </tr>
                                    <tr>
                                        <td>اسم الفصل </td>
                                        <td> {{$class->class_name}} </td>
                                    </tr>
                                    <tr>
                                        <td>عدد الطلاب </td>
                                        <td> {{count($class->students)}} </td>
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
                                            <td>
                                                @forelse ($subject->teachers as $teacher)
                                                    <a href="{{route('teachers.show',$teacher->id)}}">{{$teacher->teacher_name}}</a> -
                                                    @empty
                                                    <a>لا يوجد </a>
                                                    @endforelse
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                                <h2 class="text-center mt-5">الطلاب</h2>

                            <table class="table align-items-center mt-3 text-center">
                                <thead>
                                    <tr>
                                        <th>رقم الطالب</th>
                                        <th>اسم الطالب</th>
                                        <th>الأحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($class->students as $student)
                                        <tr>
                                            <td>{{$student->id}}</td>
                                            <td>{{$student->student_name}}</td>
                                            <td>
                                                <a href="{{route('students.show',$student)}}" class="btn btn-dark">عرض</a>
                                            </td>
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
    <!--  Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">نقل طلاب الى فصل آخر </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('classes.changeStudentClass')}}">
                        @csrf
                    <label for="choice" class="text-lg mb-3">أدخل اسم الطالب</label>

                <div class="input-group input-group-outline bg-white" style="margin-bottom:20px">
                    <select name="ids" id="sample-select" multiple>
                        @foreach ($class->students as $student)
                            <option value="{{$student->id}}">{{$student->student_name}}</option>
                        @endforeach
                    </select>
                </div>

                <label class="text-dark">الفصل</label>
                    <div class="input-group input-group-outline my-3 bg-white">
                        <select class="form-control" name="class_id">
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
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
        ele: '#teachers',
        });
    </script>
@endpush

{{--
@push('ajax')
    <script>
    const choice = document.getElementById("choice");
    console.log(choice);
    const choices = new Choices(choice,{
        duplicateItemsAllowed:false,
        noResults: 'ss',
        noChoices : 'ff'
    });
</script>
@endpush --}}

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

