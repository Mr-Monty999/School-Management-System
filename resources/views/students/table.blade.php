 <div class="col-12">
     <div class="d-flex justify-content-between mb-5">
         <div class="input-group input-group-outline bg-white w-25">
             <label class="form-label"> بحث...</label>
             <input type="text" class="form-control" id="search">
         </div>
         <a href="{{ route('students.create') }}" class="btn btn-dark">اضافة طالب</a>
     </div>

     <div class="card my-4">
         <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

             <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">

                 <h6 class="text-white text-capitalize ps-3 text-center">جدول الطلاب</h6>

             </div>
         </div>
         <div class="card-body px-0 pb-2">
             <div class="table-responsive p-0">
                 <table class="table align-items-center mb-0 text-center">
                     <thead>
                         <tr>
                             <th class="text-uppercase text-primary font-weight-bolder">
                                 الرقم</th>
                             <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                 اسم الطالب</th>
                             <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                 صورة الطالب</th>
                             <th class="text-uppercase text-primary  font-weight-bolder">الفصل</th>
                             <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>

                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($students as $student)
                             <tr>
                                 <td>
                                     <p class="text-dark text-center">{{ $student->id }}</p>
                                 </td>

                                 <td>
                                     <p class="text-dark text-center">{{ $student->student_name }}
                                     </p>
                                 </td>

                                 <td>
                                     <img class="text-dark text-center" src="{{ asset($student->student_photo) }}"
                                         alt="لا توجد صورة">

                                 </td>
                                 <td>
                                     <p class="text-dark text-center">
                                         <a class="text-dark"
                                             href="{{ route('classes.show', $student->class) }}">{{ $student->class->class_name }}</a>
                                     </p>
                                 </td>
                                 <td class="align-middle text-center">
                                     <a href="{{ route('students.show', $student) }}" class="btn btn-dark">عرض</a>
                                     <a href="{{ route('students.edit', $student) }}" class="btn btn-dark">تعديل</a>
                                     <form method="post" id="delete" class="d-inline">
                                         @csrf
                                         @method('DELETE')
                                         <input type="text" name="id" id="id" hidden
                                             value="{{ $student->id }}">
                                         <button type="submit" class="btn btn-danger">حذف </button>
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

 {!! $students->links() !!}
