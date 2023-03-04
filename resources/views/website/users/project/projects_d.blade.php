<link rel="stylesheet" href="{{ asset('auth_assets/project_assests/css/project_card.css ') }}">
<link rel="stylesheet" href="{{ asset('auth_assets/project_assests/css/style.css ') }}">
<link rel="stylesheet" href="{{ asset('css/model.css ') }}">


<style>
    /****search effect******/


    /****search effect******/

    .search {
        cursor: pointer;
        color: #186d80;
        font-size: 18px;
    }

    .search-box {
        width: fit-content;
        height: fit-content;
        position: relative;
    }

    .input-search {
        height: 50px;
        width: 50px;
        border-style: none;
        padding: 10px;
        letter-spacing: 2px;
        outline: none;
        border-radius: 25px;
        transition: all .5s ease-in-out;
        background-color: transparent;
        padding-right: 40px;
        color: #257587;
    }

    .input-search::placeholder {
        color: gray;
        letter-spacing: 2px;
    }

    .btn-search {
        width: 50px;
        height: 50px;
        border-style: none;
        font-size: 16px;
        font-weight: bold;
        outline: none;
        cursor: pointer;
        border-radius: 50%;
        position: absolute;
        right: 0px;
        color: black;
        background-color: transparent;
        pointer-events: painted;
    }

    .btn-search:focus~.input-search {
        width: 177px;
        border-radius: 0px;
        background-color: transparent;
        border-bottom: 1px solid gray;
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }

    .input-search:focus {
        width: 177px;
        border-radius: 0px;
        background-color: transparent;
        border-bottom: 1px solid gray;
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }

    /* .show_more:hover {
        background-color: white;
        color: #186d80;
    } */
    @media (min-width:768px) {
        .input-search:focus {
            width: 170px;
        }
    }

    .show_more {
        background-color: #186d80;
        color: white;
        border-radius: 0.25rem;
        transition: all .5ms;
    }

    /* .editbtn:hover {
        background-color: white;
        color: #186d80;
        transform: scale(1.1);
    } */

    .price {
        font-size: 33px;
        color: #186d80;
    }

    .status span {
        border-radius: 3px;
        /* color: white !important; */
    }
</style>
@extends('website.layouts.master_dash')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid mt-2 ">
        <div class="page-header min-height-150 border-radius-xl mt-2 text-center text-white d-flex justify-content-center"
            style="">
            <span class="mask bg-gradient-dark"></span>
            <div class='text-center' style='z-index:12'>
                <h3 class='text-white'>
                    مشاريعي
                    [ {{ $data->count() }}

                    ]
                </h3>
                <p>
                    تعرض هذه الصفحة المشاريع التي قمت بنشرها
                </p>
            </div>
        </div>

    </div>
    <div class="container-fluid pb-4">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @forelse ($data as $item)
                <div class="col-12 col-xl-4 mt-3 ">
                    <div class="card h-100 ">
                        <div class="">
                            <a href="projects/{{ $item->id }}">
                                <div class="personal_info_container myworks" style="width: auto;max-height:415px">
                                    <div class="container_card">
                                        <div class="">
                                            <h2 class="h4"> {{ Str::substr($item->title, 0, 15) }}...

                                            </h2>
                                            <div class='mt-3 mb-3'>
                                                <div class="flex  align-items-baseline gap-2">
                                                    <span>
                                                        <ion-icon name="person-outline"></ion-icon>
                                                    </span>
                                                    <h5></h5>
                                                </div>
                                                <div class="flex gap-2">
                                                    <span>
                                                        <ion-icon name="time-outline"></ion-icon>
                                                    </span>
                                                    <span class="aut_pub"></span>

                                                </div>
                                            </div>

                                            <div>
                                                {{ Str::substr($item->description, 0, 50) }}
                                                ...


                                            </div>
                                            <div class="liks_shows">
                                                <ul class="d-grid w-100 gap-1 pe-0">


                                                    <li class='d-flex gap-2'>
                                                        <a href="" class="status">
                                                            الحالة:
                                                            @if ($item->status == 1)
                                                                <span
                                                                    style="        background: #a0d0e0;
                                                                                            padding: 1px 12px;
                                                                                            border-radius: 3px;
                                                                                            color: white;">مفتوح</span>
                                                            @elseif($item->status == 0)
                                                                <span
                                                                    style="    color: #3a416f;
                                                                                                                            background: #fce4ec;
                                                                                                                            padding: 1px 12px;">:
                                                                    معلق
                                                                </span>
                                                            @elseif($item->status == 2)
                                                                <span
                                                                    style="        background: #a0d0e0;
                                                                                        padding: 1px 12px;
                                                                                        border-radius: 3px;
                                                                                        color: white;">قيد
                                                                    التنفيذ
                                                                </span>
                                                            @elseif($item->status == 3)
                                                                <span
                                                                    style="       background: #a5d6a7;
                                                                            padding: 1px 12px;
                                                                            border-radius: 3px;
                                                                            color: white;">تم
                                                                    التسليم</span>
                                                            @elseif($item->status == 4)
                                                                <span
                                                                    style="     background: #f6bed1;
                                                                                padding: 1px 12px;
                                                                                border-radius: 3px;
                                                                                color: white;">لا
                                                                    يتلقى
                                                                    عروض</span>
                                                            @elseif($item->status == 5)
                                                                <span
                                                                    style="    background: #f6bed1;
                                                                                padding: 1px 12px;
                                                                                border-radius: 3px;
                                                                                color: white;">مغلق</span>
                                                            @elseif($item->status == 6)
                                                                <span
                                                                    style="    background: #f6bed1;
                                                                                padding: 1px 12px;
                                                                                border-radius: 3px;
                                                                                color: white;">رفضت
                                                                    التسليم</span>
                                                            @elseif($item->status == 7)
                                                                <span
                                                                    style="    color: #3a416f;
                                                                                background: #ea06065e;
                                                                                padding: 1px 12px; color:white">عليه
                                                                    شكوى</span>
                                                            @elseif($item->status == 6)
                                                                <span
                                                                    style="    color: #3a416f;
                                                                                        background: #ea06065e;
                                                                                        padding: 1px 12px; color:white">رفضت
                                                                    التسليم</span>
                                                            @elseif($item->status == 8)
                                                                <span
                                                                    style="    background: #f6bed1;
                                                                                padding: 1px 12px;
                                                                                border-radius: 3px;
                                                                                color: white;">حُل
                                                                    النزاع</span>
                                                            @endif
                                                        </a>
                                                    </li>


                                                </ul>
                                            </div>

                                        </div>

                                        <div class="hr">
                                        </div>

                                        <div class="liks_shows">
                                            @if ($item->status == 0 || $item->status == 1)
                                                <a href="{{ route('projects.edit', $item->id) }}" class="show_more editBtn"
                                                    style=" background-color: #186d80;text-align:center; padding:7px 0px;color:white">
                                                    تعديل
                                                </a>
                                            @else
                                            @endif






                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- @endif --}}

        </div>



    </div>
    </div>
@endsection
