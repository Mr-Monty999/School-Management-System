      <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 text-center">
              <thead>
                  <tr>
                      <th class="text-uppercase text-primary font-weight-bolder">
                          الرقم</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                          اسم المعلم</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                          صورة المعلم</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">مواد المعلم</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                          تاريخ التسجيل</th>
                      <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($teachers as $teacher)
                      <tr>
                          <td>
                              <p class="text-dark text-center">
                                  {{ $teacher->id }}
                              </p>
                          </td>

                          <td>
                              <p class="text-dark text-center">
                                  {{ $teacher->teacher_name }}
                              </p>
                          </td>

                          <td>
                              <img class="text-dark text-center" src="{{ asset($teacher->teacher_photo) }}">
                          </td>
                          <td>
                              @if ($teacher->subjects->count() > 0)
                                  @foreach ($teacher->subjects as $subject)
                                      ,{{ $subject->subject_name }}
                                  @endforeach
                              @else
                                  لايوجد
                              @endif

                          </td>
                          <td>
                              <p class="text-dark text-center">
                                  {{ $teacher->teacher_hire_date }}
                              </p>
                          </td>

                          <td class="align-middle text-center">
                              <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-dark">عرض
                              </a>
                              <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-dark">تعديل
                              </a>
                              <form id="delete" action="" method="post" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <input hidden type="text" id="id" value="{{ $teacher->id }}">
                                  <button type="submit" class="btn btn-danger">حذف </button>
                              </form>
                          </td>

                      </tr>
                  @endforeach
              </tbody>
          </table>

      </div>

      {!! $teachers->links() !!}
