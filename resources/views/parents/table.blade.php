<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3 text-center">جدول أولياء الأمور</h6>
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
                                اسم ولي الأمر</th>
                            <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                صورة ولي الأمر</th>
                            <th class="text-uppercase text-primary  font-weight-bolder">عدد الأبناء</th>
                            <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parents as $parent)
                            <tr>
                                <td>
                                    <p class="text-dark text-center">{{ $parent->id }}</p>
                                </td>

                                <td>
                                    <p class="text-dark text-center">{{ $parent->parent_name }}
                                    </p>
                                </td>

                                <td>
                                    <img class="text-dark text-center" src="{{ asset($parent->parent_photo) }}"
                                        alt="لا توجد صورة">

                                </td>
                                <td>
                                    <p class="text-dark text-center">
                                        {{ count($parent->students) }}
                                    </p>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('parents.show', $parent) }}" class="btn btn-dark">عرض</a>
                                    <a href="{{ route('parents.edit', $parent) }}" class="btn btn-danger">تعديل</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{!! $parents->links() !!}
