      <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 text-center">
              <thead>
                  <tr>
                      <th class="text-uppercase text-primary font-weight-bolder">
                          الرقم</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                          اسم الموظف</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                          صورة الموظف</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">نوع الوظيفة</th>
                      <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                          تاريخ التسجيل</th>
                      <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($employees as $employe)
                      <tr>
                          <td>
                              <p class="text-dark text-center">
                                  {{ $employe->id }}
                              </p>
                          </td>

                          <td>
                              <p class="text-dark text-center">
                                  {{ $employe->employe_name }}
                              </p>
                          </td>

                          <td>
                              <img class="text-dark text-center" src="{{ asset($employe->employe_photo) }}">
                          </td>
                          <td>
                              {{ $employe->employe_job }}
                          </td>
                          <td>
                              <p class="text-dark text-center">
                                  {{ $employe->employe_hire_date }}
                              </p>
                          </td>

                          <td class="align-middle text-center">
                              <a href="{{ route('employees.show', $employe) }}" class="btn btn-dark">عرض
                              </a>
                              <a href="{{ route('employees.edit', $employe) }}" class="btn btn-dark">تعديل
                              </a>
                              <form id="delete" action="" method="post" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <input hidden type="text" id="id" value="{{ $employe->id }}">
                                  <button type="submit" class="btn btn-danger">حذف </button>
                              </form>
                          </td>

                      </tr>
                  @endforeach
              </tbody>
          </table>

      </div>

      {!! $employees->links() !!}
