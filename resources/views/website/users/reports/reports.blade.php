<style>
    .transactions-tb {
        min-height: 300px;
    }
</style>
@extends('website.layouts.master_dash')

@section('content')
    <div class=" container-fluid pb-5 mt-2">
        @if (Auth::user()->hasRole(['provider']) && Auth::user()->hasRole(['seeker']))
            <div class="row container m-auto mb-4 ">
                <div class="col-6 mb-4 mt-3">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl"
                            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                            <span class="mask bg-gradient-dark"></span>
                            <a href="offer_reports">
                                <div class="card-body position-relative z-index-1 ">
                                    <h5 class="text-white mt-4 mb-1 pb-2 text-center">العروض</h5>
                                    <h5 class="text-white  text-center">

                                    </h5>


                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4 mt-3">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl"
                            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                            <span class="mask bg-gradient-dark"></span>
                            <a href="/reports">
                                <div class="card-body position-relative z-index-1 ">
                                    <h5 class="text-white mt-4 mb-1 pb-2 text-center">المشاريع</h5>
                                    <h5 class="text-white  text-center">

                                    </h5>


                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        @elseif (Auth::user()->hasRole(['seeker']))
            <div class=" container-fluid pb-5 mt-2">
                <div class="col-12 mb-4">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl"
                            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                            <span class="mask bg-gradient-dark"></span>
                            <div class="card-body position-relative z-index-1 ">
                                <h3 class="text-white mt-4 mb-1 pb-2 text-center">تقارير المشاريع </h3>
                                <h5 class="text-white  text-center">

                                </h5>


                            </div>
                        </div>
                    </div>
                </div>
            @elseif (Auth::user()->hasRole(['provider']))
                <div class=" container-fluid pb-5 mt-2">
                    <div class="col-12 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl"
                                style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body position-relative z-index-1 ">
                                    <h3 class="text-white mt-4 mb-1 pb-2 text-center"> تقارير العروض </h3>
                                    <h5 class="text-white  text-center">

                                    </h5>


                                </div>
                            </div>
                        </div>
                    </div>
        @endif



        <div class="col-10 m-auto">
            <div class="card mb-4">
                <div class="my-3 mt-5">
                    @if (Auth::user()->hasRole(['seeker']))
                        <form action="/reports" method="POST">
                            @csrf
                            <div class="container row ">
                                <div class="col-xl-4 col-lg-4  col-md-4 col-sm-3">
                                    <select class="form-select form-select-lg  mb-3" name="project_status"
                                        id='projectsFilter' onchange='projectFilter(this)'>

                                        <option value='-1'> المشاريع </option>

                                        <option value="0">معلق</option>
                                        <option value="1">مفتوح </option>
                                        <option value="4"> بانتظار تأكيد العرض </option>
                                        <option value="2">قيد التنفيذ</option>
                                        <option value="3">قيد التسليم</option>
                                        <option value="5">مغلق</option>
                                        <option value="6">مرفوض</option>
                                        <option value="7">علية شكوى</option>
                                        <option value="8">حل النزاع </option>
                                        <option value="9">موقف</option>



                                    </select>
                                </div>

                                {{-- <div class="col-xl-4 col-lg-4  col-md-4 col-sm-3">
                                    <button type="submit" class="btn btn-outline-primary ">بحث</button>
                                </div> --}}
                            </div>
                        </form>


                </div>

                <div class="card-body px-0 pt-0 pb-2 col-11 m-auto">
                    <div class="table-responsive p-0 transactions-tb">
                        <div class="col-4">

                        </div>

                        <table class="table align-items-center justify-content-center mb-0 ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم
                                        المشروع
                                    </th>
                                    <th style="padding: 10px;"
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        الحاله
                                    </th>
                                    <th style="padding: 10px;"
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        اسم
                                        المزود
                                    </th>


                                    <th style="padding: 10px;"
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        تاريخ التسليم</th>



                                    <th></th>
                                </tr>
                            </thead>

                            <tbody id='projectTableBody'>

                                @forelse ($seeker_project_success as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">

                                                <div class="my-auto">

                                                    <h6 class="mb-0 text-sm">
                                                        {{ $item->title }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" text-right">
                                            @if ($item->status == 0)
                                                <span class="text-xs font-weight-bold">
                                                    معلق
                                                </span>
                                            @elseif($item->status == 1)
                                                <span class="text-xs font-weight-bold">
                                                    مفتوح
                                                </span>
                                            @elseif($item->status == 2)
                                                <span class="text-xs font-weight-bold">
                                                    قيد التنفيذ
                                                </span>
                                            @elseif($item->status == 3)
                                                <span class="text-xs font-weight-bold">
                                                    قيد التسليم
                                                </span>
                                            @elseif($item->status == 4)
                                                <span class="text-xs font-weight-bold">
                                                    بانتظار تأكيد العرض
                                                </span>
                                            @elseif($item->status == 5)
                                                <span class="text-xs font-weight-bold">
                                                    مغلق
                                                </span>
                                            @elseif($item->status == 6)
                                                <span class="text-xs font-weight-bold">
                                                    مرفوض
                                                </span>
                                            @elseif($item->status == 7)
                                                <span class="text-xs font-weight-bold">
                                                    عليه شكوى
                                                </span>
                                            @elseif($item->status == 8)
                                                <span class="text-xs font-weight-bold">
                                                    حل النزاع
                                                </span>
                                            @elseif($item->status == 9)
                                                <span class="text-xs font-weight-bold">
                                                    موقف
                                                </span>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="d-flex px-2">


                                                <div class="my-auto">
                                                    @if ($item->handled_by != null)
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $item->sal_handel_by->name }}
                                                        </h6>
                                                    @else
                                                        <h6 class="mb-0 text-sm">
                                                            -


                                                        </h6>
                                                    @endif
                                                </div>

                                            </div>

                                        </td>
                                        <td class=" text-right">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $item->delivery_date }}
                                            </p>
                                        </td>


                                    </tr>

                                @empty
                                @endforelse

                            </tbody>

                        </table>
                    @elseif (Auth::user()->hasRole(['provider']))
                        <form action="/reports" method="POST">
                            @csrf
                            <div class="container row">
                                <div class="col-xl-4 col-lg-4  col-md-6 col-sm-3">
                                    <select class="form-select form-select-lg  mb-3 " name="offer_status"
                                        {{-- id="sl" onchange='offersFilter(this)' --}} id='offersFilter'>

                                        <option value="-1">العروض</option>


                                        <option value="1">بانتظار الموافقه </option>
                                        <option value="2">مقبول </option>
                                        <option value="3">قيد التنفيذ</option>
                                        {{-- <option value="5">تم الاستلام</option>
                                <option value="5">رفض الاستلام</option>
                                <option value="4">مرفوض</option> --}}
                                        <option value="0">ملغي</option>



                                    </select>
                                </div>

                                {{-- <div class="col-xl-4 col-lg-4  col-md-4 col-sm-3">
                                    <button type="submit" class="btn btn-outline-primary ">بحث</button>
                                </div> --}}
                            </div>
                        </form>
                        {{-- <form action="/offer_reports" method="POST">
                            @csrf
                            <div class="container row">
    
                                <div class="col-xl-4 col-lg-4  col-md-6 col-sm-3" style="    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    flex-wrap: nowrap;
                                    justify-content: space-evenly;">
                                    <div class="form-check">
    
                                        <input class="form-check-input" name="neer" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            الاحدث
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="defaultCheck1">
                                            الاقدم
                                        </label>
                                        <input class="form-check-input" name="last" type="checkbox" value="" id="defaultCheck1">
    
                                    </div>
    
    
    
    
    
                                </div>
                                <div class="col-xl-4 col-lg-4  col-md-4 col-sm-3">
                                    <button type="submit" class="btn btn-outline-primary ">بحث</button>
                                </div>
                            </div>
                        </form> --}}

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 transactions-tb">


                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم
                                            المشروع </th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            صاحب المشروع</th>
                                        <th style="padding: 7px;"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            سعر العرض</th>
                                        <th style="padding: 7px;"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            المدة </th>
                                        {{-- <th style="padding: 7px;"
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    تاريخ الاستلام</th> --}}
                                        <th style="padding: 7px;"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            الحاله
                                        </th>

                                    </tr>
                                </thead>

                                <tbody id='offerTableBody'>
                                    @forelse ($offers as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">

                                                    <div class="my-auto">

                                                        <h6 class="mb-0 text-sm">
                                                            {{ $item->sal_project_id->title }}</span>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class=" text-right">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $item->sal_project_id->sal_created_by->name }}
                                                </p>
                                            </td>
                                            <td class=" text-right">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $item->price }} $
                                                </p>
                                            </td>
                                            <td class=" text-right">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $item->duration }} يوم
                                                </p>
                                            </td>
                                            {{-- <td class=" text-right">
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $item->created_at }}
                                        </p>
                                    </td> --}}

                                            <td class=" text-right">
                                                @if ($item->sal_project_id->status == 1 && $item->status == 0)
                                                    <a style="color:rgb(224, 41, 41)"
                                                        class="text-sm font-weight-bold mb-0">ملغي</a>
                                                @elseif($item->sal_project_id->status == 1 && $item->status == 1)
                                                    <a style="color:black" class="text-sm font-weight-bold mb-0">بانتظار
                                                        الموافقة </a>
                                                @elseif($item->sal_project_id->status == 4 && $item->status == 1)
                                                    <a style="color:rgb(16, 190, 40)"
                                                        class="text-sm font-weight-bold mb-0">
                                                        مقبول</a>
                                                @elseif($item->sal_project_id->status == 4 && $item->status == 2)
                                                    <a style="color:black" class="text-sm font-weight-bold mb-0">تمت
                                                        موافقتك
                                                    </a>
                                                @elseif($item->sal_project_id->status == 2 && $item->status == 3)
                                                    <a style="color:black" class="text-sm font-weight-bold mb-0">قيد
                                                        التنفيذ
                                                    </a>
                                                @elseif($item->sal_project_id->status == 3 && $item->status == 3)
                                                    {{-- <a style="color:black" class="text-sm font-weight-bold mb-0">تم التسليم  </a> --}}
                                                    <a style="color:black" class="text-sm font-weight-bold mb-0"> قيد
                                                        التسليم
                                                    </a>
                                                @elseif($item->sal_project_id->status == 5 && $item->status == 3)
                                                    <a style="color:black" class="text-sm font-weight-bold mb-0"> تم
                                                        الاستلام
                                                    </a>
                                                @elseif($item->sal_project_id->status == 1 && $item->status == 4)
                                                    <a style="color:black" class="text-sm font-weight-bold mb-0">مرفوض</a>
                                                @endif
                                            </td>



                                        </tr>
                                    @empty
                                    @endforelse


                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
            @endif




        </div>
    </div>
    </div>
    </div>

    </div>
    <script>
        /**----------------------
         * @returns {HTMLElement}
         *------------------------**/

        function renderOfferTable(item) {
            const status=()=>{
                let status=''
                if(item.sal_project_id.status == 1 && item.status == 0){
                    status="<a style = 'color:rgb(224, 41, 41)'class = 'text-sm font-weight-bold mb-0' > ملغي < /a>";
                    return status;
                }
                else if(item.sal_project_id.status == 1 && item.status == 1){
                    status="<a style ='color:black'class = 'text-sm font-weight-bold mb-0' > بانتظار الموافقة </a>";
                    return status;
                }
                else if(item.sal_project_id.status == 4 && item.status == 1){
                    status="<a style = 'color:rgb(16, 190, 40)' class = 'text-sm font-weight-bold mb-0' > مقبول < /a>";
                    return status;
                }
                else if(item.sal_project_id.status == 2 && item.status == 3){
                    status="<a style = 'color:rgb(16, 190, 40)' class = 'text-sm font-weight-bold mb-0' > قيدالتنفيذ< /a>";
                    return status;
                }
            }
            // <
            // td class = " text-right" >
            //     @if ($item->sal_project_id->status == 1 && $item->status == 0)
            //         <
            //         a style = "color:rgb(224, 41, 41)"
            //         class = "text-sm font-weight-bold mb-0" > ملغي < /a>
            //     @elseif ($item->sal_project_id->status == 1 && $item->status == 1) <
            //         a style = "color:black"
            //         class = "text-sm font-weight-bold mb-0" > بانتظار
            //         الموافقة < /a>
            //     @elseif ($item->sal_project_id->status == 4 && $item->status == 1) <
            //         a style = "color:rgb(16, 190, 40)"
            //         class = "text-sm font-weight-bold mb-0" >
            //             مقبول < /a>
            //     @elseif ($item->sal_project_id->status == 4 && $item->status == 2) <
            //         a style = "color:black"
            //         class = "text-sm font-weight-bold mb-0" > تمت
            //         موافقتك
            //             <
            //             /a>
            //     @elseif ($item->sal_project_id->status == 2 && $item->status == 3) <
            //         a style = "color:black"
            //         class = "text-sm font-weight-bold mb-0" > قيد
            //         التنفيذ
            //             <
            //             /a>
            //     @elseif ($item->sal_project_id->status == 3 && $item->status == 3)
            //         {{-- <a style="color:black" class="text-sm font-weight-bold mb-0">تم التسليم  </a> --}}
            //             <
            //             a style = "color:black"
            //         class = "text-sm font-weight-bold mb-0" > قيد
            //         التسليم
            //             <
            //             /a>
            //     @elseif ($item->sal_project_id->status == 5 && $item->status == 3) <
            //         a style = "color:black"
            //         class = "text-sm font-weight-bold mb-0" > تم
            //         الاستلام
            //             <
            //             /a>
            //     @elseif ($item->sal_project_id->status == 1 && $item->status == 4) <
            //         a style = "color:black"
            //         class = "text-sm font-weight-bold mb-0" > مرفوض < /a>
            //     @endif <
            //     /td>


            let html = `
            <tr>
                <td>
                    <div class="d-flex px-2">

                        <div class="my-auto">

                            <h6 class="mb-0 text-sm">
                                ${item.sal_project_id.title}</span>

                            </h6>
                        </div>
                    </div>
                </td>

                <td class=" text-right">
                    <p class="text-sm font-weight-bold mb-0">
                         ${item.sal_project_id.sal_created_by.name }
                    </p>
                </td>
                <td class=" text-right">
                    <p class="text-sm font-weight-bold mb-0">
                        ${ item.price } $
                    </p>
                </td>
                <td class=" text-right">
                    <p class="text-sm font-weight-bold mb-0">
                        ${ item.duration } يوم
                    </p>
                </td> 
                <td class = " text-right" >
                    ${status()}
                </td> 
        </tr>
                        `;

            return html;
        }

        function renderProjectTable(item) {
            const deliveryDate = () => {

                if (item.delivery_date != null) {

                    return item.delivery_date;
                }

                return "-";
            };
            const handled_by = () => {

                if (item.sal_handel_by != null) {

                    return item.sal_handel_by.name;
                }
                return '-'
            }
            const status = () => {
                let status = '';
                if (item.status == 0) {
                    status = 'معلق';
                    return status;
                } else if (item.status == 1) {
                    status = ' مفتوح';
                    return status;
                } else if (item.status == 2) {
                    status = '  قيد التنفيذ';
                    return status;
                } else if (item.status == 3) {
                    status = '   قيد التسليم ';
                    return status;
                } else if (item.status == 4) {
                    status = '    بانتظار تأكيد العرض';
                    return status;
                } else if (item.status == 5) {
                    status = '   مغلق';
                    return status;
                } else if (item.status == 6) {
                    status = '   مرفوض';
                    return status;
                } else if (item.status == 7) {
                    status = '    عليه شكوى';
                    return status;
                } else if ($item.status == 8) {
                    status = '    حل النزاع';
                    return status;
                } else if (item.status == 9) {
                    status = '    موقف';
                    return status;
                }



                return ''
            }
            let html = `
            <tr>
              <td>
                <div class="d-flex px-2">

                    <div class="my-auto">

                        <h6 class="mb-0 text-sm">
                            ${ item.title }</span>
                </td>
                </h6>
                    </div>
                </div>
                </td>
                <td class=" text-right">
                    <span class="text-xs font-weight-bold">
                         ${status()}
                     </span>
                </td>
                <td>
                    <div class="d-flex px-2">
                        <div class="my-auto">
                                <h6 class="mb-0 text-sm">
                                    ${handled_by()}
                                </h6>
                        </div>
                    </div>
                </td>
                <td class=" text-right">
                    <p class="text-sm font-weight-bold mb-0">
                        ${deliveryDate()}
                    </p>
                </td>
                

                </tr>`;

            return html;
        }
        const el = ($elemnt) => document.querySelector($elemnt);

        // const log = (...param) => console.log(...param);
        var offersFilter = el('#offersFilter');
        var offerTableBody = el("#offerTableBody");
        var projectsFilter = el('#projectsFilter');
        var projectTableBody = el("#projectTableBody");

        let token = document.head.querySelector("[name=csrf-token]").content;
        console.log(token);


        function projectFilter(e) {
            var projectStatus = e.value;
            // console.log(e.target.value); used with even listener
            url = "/reports";
            event.preventDefault();
            fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token,
                    },
                    method: "post",
                    credentials: "same-origin",
                    body: JSON.stringify({
                        project_status: projectStatus,
                    }),
                })
                .then(async (result) => {
                    let res = await result.json();
                    console.log(res);
                    let list = res.project
                        .map((item) => renderProjectTable(item))
                        .reduce((prev, current) => prev + current, "");
                    projectTableBody.innerHTML = list;

                })
                .catch(function(error) {
                    console.log(error);
                });

        }



        offersFilter.addEventListener("change", function(e) {
            var offerStatus = e.target.value;
            console.log(e.target.value);
            url = "/reports";
            event.preventDefault();
            fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token,
                    },
                    method: "post",
                    credentials: "same-origin",
                    body: JSON.stringify({
                        offer_status: offerStatus,
                    }),
                })
                .then(async (result) => {
                    let res = await result.json();
                    console.log(res);
                    let list = res.offer
                        .map((item) => renderOfferTable(item))
                        .reduce((prev, current) => prev + current, "");
                    offerTableBody.innerHTML = list;

                })
                .catch(function(error) {
                    console.log(error);
                });

        });
    </script>
@endsection
