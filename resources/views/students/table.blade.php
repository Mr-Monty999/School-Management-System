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
                        <img class="text-dark text-center" src="{{ asset($student->student_photo) }}" alt="لا توجد صورة">

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
                            <input type="text" name="id" id="id" hidden value="{{ $student->id }}">
                            <button type="submit" class="btn btn-danger">حذف </button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>
</div>
{!! $students->links() !!}
