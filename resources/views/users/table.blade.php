 <div class="table-responsive p-0">
     <table class="table align-items-center mb-0">
         <thead>
             <tr>
                 <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>
                 <th class="text-uppercase text-primary font-weight-bolder ps-2 text-center"> اسم
                     المستخدم</th>
                 <th class="text-uppercase text-primary font-weight-bolder ps-2 text-center"> الاسم
                     التعريفي </th>
                 <th class="text-uppercase text-primary font-weight-bolder ps-2 text-center"> الرتبة
                 </th>
                 <th class="text-uppercase text-primary font-weight-bolder ps-2 text-center"> الاحداث
                 </th>

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
                         <p class="text-dark text-center text-bold">
                             @if ($user->student)
                                 <a
                                     href="{{ route('students.show', $user->student) }}">{{ $user->student->student_name }}</a>
                             @endif

                             @if ($user->teacher)
                                 <a
                                     href="{{ route('teachers.show', $user->teacher) }}">{{ $user->teacher->teacher_name }}</a>
                             @endif

                             @if ($user->employe)
                                 <a
                                     href="{{ route('employees.show', $user->employe) }}">{{ $user->employe->employe_name }}</a>
                             @endif

                         </p>
                     </td>

                     <td>
                         <p class="text-dark text-center">
                             {{-- <a class="text-bold" href="{{url($type . 's/' . $user[$type.'_id'])}}">{{$user[$type][$type.'_name'] }}</a> --}}
                             @foreach ($user->getRoleNames() as $role)
                                 ,{{ $role }}
                             @endforeach

                         </p>
                     </td>

                     <td>
                         <p class="text-dark text-center">
                             <a class="btn btn-danger" href="{{ route('users.edit', $user) }}">تغيير
                                 الرتية</a>
                         </p>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
 {!! $users->links() !!}
