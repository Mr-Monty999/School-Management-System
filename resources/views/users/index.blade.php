@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة المستخدمين</h1>



        <div class="container-fluid row my-8">
            <div class="col-12">
                <a class="btn btn-dark" href="{{ route('roles.index') }}">عرض الرتب</a>

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">ادارة المستخدمين</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
