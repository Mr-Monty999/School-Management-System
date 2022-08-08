<div class="table-responsive p-0">
    <table class="table align-items-center mb-0 text-center">
        <thead>
            <tr>
                <th class="text-uppercase text-primary font-weight-bolder">
                    الرقم</th>
                <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                    اسم المستخدم</th>
                <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                    الاسم</th>
                <th class="text-uppercase text-primary  font-weight-bolder  ps-2">نوع المستخدم</th>
                <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>
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
                        <p class="text-dark text-center">
                            {{ $user[$user->type][$user->type . '_name'] }}

                            {{-- @if ($user->hasRole('employe'))
                                {{ $user->employe()->onlyTrashed()->first()->employe_name }}
                            @elseif ($user->hasRole('student'))
                                {{ $user->student()->onlyTrashed()->first()->student_name }}
                            @else
                                {{ $user->teacher()->onlyTrashed()->first()->teacher_name }}
                            @endif --}}
                        </p>
                    </td>

                    <td>
                        {{ $user->type }}
                        {{-- @foreach ($user->getRoleNames() as $role)
                            ,{{ $role }}
                        @endforeach --}}
                    </td>
                    <td class="align-middle text-center">
                        <form id="delete" action="{{ route('archive.destroy', $user) }}" method="post"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input hidden type="text" name="id" id="id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-danger"> حذف من الأرشيف</button>
                        </form>

                        <form id="restore" method="post" class="d-inline">
                            @csrf
                            <input hidden type="text" name="id" id="id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-success">استعادة</button>
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

{!! $users->links() !!}
