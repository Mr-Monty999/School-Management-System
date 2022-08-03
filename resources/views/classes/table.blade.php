    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>

                    <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> اسم
                        الفصل</th>

                    <th class="text-uppercase text-primary  font-weight-bolder text-center">الاحداث</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>
                            <p class="text-dark text-center">
                                {{ $class->id }}
                            </p>
                        </td>

                        <td>
                            <p class="text-dark text-center">
                                {{ $class->class_name }}
                            </p>
                        </td>

                        <td class="align-middle text-center">
                            <a href="{{ route('classes.show', $class) }}" class="btn btn-dark">عرض </a>
                            @role('Super-Admin')
                                <a href="{{ route('classes.edit', $class) }}" class="btn btn-danger">تعديل </a>
                                <form method="post" id="delete" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" name="id" id="id" hidden value="{{ $class->id }}">
                                    <button type="submit" class="btn btn-danger">حذف </button>
                                </form>
                            @endrole
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    {!! $classes->links() !!}
