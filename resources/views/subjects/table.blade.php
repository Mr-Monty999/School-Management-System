  <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
          <thead>
              <tr>
                  <th class="text-uppercase text-primary font-weight-bolder text-center"> الرقم</th>

                  <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> اسم المادة</th>
                  <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> الفصل</th>
                  <th class="text-uppercase text-primary  font-weight-bolder ps-2 text-center"> المعلمين</th>

                  <th class="text-uppercase text-primary  font-weight-bolder text-center">الاحداث</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($subjects as $subject)
                  <tr>
                      <td>
                          <p class="text-dark text-center">
                              {{ $subject->id }}
                          </p>
                      </td>

                      <td>
                          <p class="text-dark text-center">
                              {{ $subject->subject_name }}
                          </p>
                      </td>

                      <td>
                          <p class="text-dark text-center">
                              {{ $subject->class->class_name }}
                          </p>
                      </td>

                      <td>
                          <p class="text-dark text-center">
                              {{ count($subject->teachers) }}
                          </p>
                      </td>

                      <td class="align-middle text-center">
                          <a href="{{ route('subjects.show', $subject) }}" class="btn btn-dark">عرض </a>
                          @role('Super-Admin')
                              <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-danger">تعديل </a>
                              <form id="delete" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <input type="text" id="id" value="{{ $subject->id }}" hidden>
                                  <button type="submit" class="btn btn-danger">حذف</button>
                              </form>
                          @endrole
                      </td>

                  </tr>
              @endforeach
          </tbody>
      </table>

  </div>
  {!! $subjects->links() !!}
