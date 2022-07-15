@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة النتائج</h1>



        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">{{$student->student_name}}</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>

                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> اسم المادة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">   المعلم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">  الدرجة المستحقة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center">  الدرجة الكاملة</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                    <tr>
                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $result->id }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $result->subject->subject_name }}
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                @foreach ($result->subject->teachers as $teacher)
                                                  {{ $teacher->teacher_name }} -

                                                @endforeach
                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                  {{ $result->result}}

                                            </p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">
                                                {{ $result->full_mark}}
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
