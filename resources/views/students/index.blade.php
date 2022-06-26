@extends('layouts.dashboard')

@section('section')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>ادارة الطلاب</h1>
        <form action="" enctype="multipart/form-data" method="post">
            @csrf
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">اسم الطالب</label>
                <input type="text" name="student_name" class="form-control">
            </div>
            <label class="text-dark">النوع :</label>
            <div class="input-group input-group-outline  bg-white">
                <select class="form-control" name="student_genre" id="">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>

                </select>
            </div>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">السكن</label>
                <input type="text" name="student_address" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">السنة الدراسية</label>
                <input type="text" name="student_class" class="form-control">
            </div>
            <label class="text-dark">تاريخ ميلاد الطالب :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="student_birthdate" class="form-control">
            </div>
            <label class="text-dark">تاريخ التسجيل :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="date" name="student_registered_date" class="form-control">
            </div>

            <label class="text-dark">ولي الامر</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="text" name="parent_name" class="form-control">

            </div>

            <label class="text-dark">صورة الطالب :</label>
            <div class="input-group input-group-outline  bg-white">
                <input type="file" name="student_photo" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3 bg-white">
                <label class="form-label">الرسوم المدفوعة</label>
                <input type="text" name="student_paid_price" class="form-control">
            </div>
            <button type="submit" class="btn btn-success margin my-3 col-6">اضافة</button>
        </form>

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-white">{{ $error }}</div>
        @endforeach

        @if (Session::has('success'))
            <div class="alert alert-success text-white">{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger text-white">{{ Session::get('error') }}</div>
        @endif


        <div class="container-fluid row my-8">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3 text-center">جدول المنتجات</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary font-weight-bolder">
                                            الرقم</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            اسم الطالب</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            ولي الامر</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            النوع</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            السنة الدراسية</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            صورة الطالب</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            تاريخ الميلاد</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            تاريخ التسجيل</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            الرسوم المدفوعة</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder  ps-2">
                                            الرسوم المتبقية</th>
                                        <th class="text-uppercase text-primary  font-weight-bolder">الاحداث</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    <tr>
                                        <td>
                                            <p class="text-dark text-center">{{ ++$i }}</p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-center">منتصر محمد</p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-center">محمد عبدالله</p>

                                        </td>
                                        <td>
                                            <p class="text-dark text-center">ذكر</p>

                                        </td>
                                        <td>
                                            <p class="text-dark text-center">الصف الثالث</p>

                                        </td>
                                        <td>
                                            <p class="text-dark text-center">لاتوجد صورة</p>
                                        </td>

                                        <td>
                                            <p class="text-dark text-center">2000</p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-center">2022</p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-center">1,9000</p>
                                        </td>
                                        <td>
                                            <p class="text-dark text-center">5,600</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="" class="btn btn-dark">تعديل </a>
                                            <form action="" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف </button>
                                            </form>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
@endsection

@push('ajax')
    <script>
        let form = $("form");

        form.on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                method: "post",
                url: {{ route('students.store') }},
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("success");
                },
                error: function(xhr) {
                    console.log("error");
                }
            });
        });
    </script>
@endpush
