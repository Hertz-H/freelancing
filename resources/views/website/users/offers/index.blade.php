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

    @media (min-width:768px) {
        .input-search:focus {
            width: 170px;
        }
    }

    .show_more {
        background-color: #186d80;
        color: white;
        border-radius: 0.25rem;
    }

    .show_more:hover {
        background-color: white;
        color: #186d80;
    }

    .price {
        font-size: 33px;
        color: #186d80;
    }

    .flex1 {
        flex: 1 1 auto;
    }
</style>
@extends('website.layouts.master_dash')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid mt-1 ">
        <div class="page-header min-height-150 border-radius-xl mt-2 text-center text-white d-flex justify-content-center"
            style="">
            <span class="mask bg-gradient-dark"></span>
            <div class='text-center' style='z-index:12'>
                <h3 class='text-white'>
                    عرض العروض
                    [ {{ $offers->count() }}
                    ]
                </h3>
                <p>
                    تعرض هذه الصفحة العروض التي قدمتها
                </p>
            </div>
        </div>

    </div>
    <div class="container-fluid pb-4">
        <div class="row">
            @if (!$offers->isEmpty())
                @foreach ($offers as $offer)
                    <div class="col-12 col-xl-4 mt-3 ">
                        <div class="card h-100 mb-5">
                            <div class="">
                                <a href="projects/{{ $offer->sal_project_id->id }}#offer{{ $offer->id }}">
                                    <div class="personal_info_container myworks" style="width: auto;max-height:415px">
                                        <div class="container_card">
                                            <div class="">
                                                <h2 class="h4">
                                                    {{ Str::substr($offer->sal_project_id->title, 0, 15) }}...</h2>
                                                <div class='mt-3 mb-3'>
                                                    <div class="flex  align-items-baseline gap-2">
                                                        <span>
                                                            <ion-icon name="person-outline"></ion-icon>
                                                        </span>
                                                        <h6>{{ $offer->sal_project_id->sal_created_by->name }}</h6>
                                                    </div>
                                                    <div class="flex gap-2">
                                                        <span>
                                                            {{-- <ion-icon name="time-outline"></ion-icon> --}}
                                                        </span>
                                                        <span class="aut_pub"> </span>

                                                    </div>
                                                </div>

                                                <div>
                                                    {{ Str::substr($offer->description, 0, 50) }}
                                                    ...


                                                </div>
                                                <div class="liks_shows">
                                                    <ul class="d-grid w-100 gap-1 pe-0">
                                                        <div
                                                            class='d-flex w-100 justify-content-between align-items-center'>




                                                        </div>
                                                        {{-- {{ $item->sal_skill}}
                                <div class='skills ' style=''>
                                    @foreach ($item->sal_skills_by as $skill)
                                    {{ $skill->sal_skill->title }}<br>
                                    @endforeach
                                </div> --}}
                                                        <li class='d-flex gap-2'>
                                                            <a href="" class="status">

                                                                @if ($offer->sal_project_id->status == 1 && $offer->status == 0)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                                                    background: #fce4ec;
                                                                                                                                                                                                                    padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status">ملغي</a>
                                                                @elseif($offer->sal_project_id->status == 1 && $offer->status == 1)
                                                                    <a style=" background:#a5d6a7; color: white;
                                                                                                                                                                                                             
                                                                                                                                                                                                                    padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status">بانتظار
                                                                        الموافقة
                                                                    </a>
                                                                @elseif($offer->sal_project_id->status == 4 && $offer->status == 1)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                                                    background: #a5d6a7;
                                                                                                                                                                                                                    padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status">
                                                                        مقبول</a>
                                                                    <a
                                                                        href="{{ route('chats_with', [$offer->sal_project_id->user_id, $offer->project_id]) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" class="bi bi-chat"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                                        </svg></a>
                                                                @elseif($offer->sal_project_id->status == 4 && $offer->status == 2)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                                                    background: #a5d6a7 ;padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status">تمت موافقتك </a>
                                                                    <a
                                                                        href="{{ route('chats_with', [$offer->sal_project_id->user_id, $offer->project_id]) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" class="bi bi-chat"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                                        </svg></a>
                                                                @elseif($offer->sal_project_id->status == 2 && $offer->status == 3)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                                                    background: #4fc3f796;
                                                                                                                                                                                                                    padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status">قيد
                                                                        التنفيذ
                                                                    </a>
                                                                    <a
                                                                        href="{{ route('chats_with', [$offer->sal_project_id->user_id, $offer->project_id]) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" class="bi bi-chat"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                                        </svg></a>
                                                                @elseif($offer->sal_project_id->status == 3 && $offer->status == 3)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                                                    background: #4fc3f796;
                                                                                                                                                                                                                    padding: 1px 12px;padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status">
                                                                        قيد
                                                                        التسليم
                                                                    </a>
                                                                    <a
                                                                        href="{{ route('chats_with', [$offer->sal_project_id->user_id, $offer->project_id]) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" class="bi bi-chat"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                                        </svg></a>
                                                                @elseif($offer->sal_project_id->status == 5 && $offer->status == 3)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                                                    background: #a5d6a7;
                                                                                                                                                                                                                    padding: 1px 12px;padding: 1px 12px;border-radius:3px;color:white""
                                                                        class="
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                              status">
                                                                        تم
                                                                        الاستلام
                                                                    </a>
                                                                @elseif($offer->sal_project_id->status == 1 && $offer->status == 4)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                                                    background: #f6bed1;
                                                                                                                                                                                                                    padding: 1px 12px;;border-radius:3px;color:white"
                                                                        class="status">مرفوض</a>
                                                                @elseif($offer->sal_project_id->status == 6 && $offer->status == 3)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                                background: #f6bed1;
                                                                                                                                                                                padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status"> رفض الاستلام
                                                                    </a>
                                                                    <a
                                                                        href="{{ route('chats_with', [$offer->sal_project_id->user_id, $offer->project_id]) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" class="bi bi-chat"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                                        </svg></a>
                                                                @elseif($offer->sal_project_id->status == 7 && $offer->status == 3)
                                                                    <a style="    color: #3a416f;
                                                                                                                                                                            background: #f6bed1;
                                                                                                                                                                            padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status"> رفُعت
                                                                        شكوى</a>
                                                                    <a
                                                                        href="{{ route('chats_with', [$offer->sal_project_id->user_id, $offer->project_id]) }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" class="bi bi-chat"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                                        </svg></a>
                                                                @elseif($offer->sal_project_id->status == 8 && $offer->status == 3)
                                                                    <a style="color:white;background-color: #ff9b20b0;;padding: 1px 12px;border-radius:3px;"
                                                                        class="status"> حُل
                                                                        النزاع</a>
                                                                @elseif($offer->sal_project_id->status == 1 && $offer->status == 4)
                                                                    <a style=" background: #f6bed1;
                                                                                                                                                                        padding: 1px 12px;border-radius:3px;color:white"
                                                                        class="status">ملغي</a>
                                                                @endif


                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>

                                            </div>

                                            <div class="hr">
                                            </div>
                                            <div class="liks_shows d-flex gap-3">
                                                <a href="projects/{{ $offer->sal_project_id->id }}#offer{{ $offer->id }}"type="button"
                                                    class="btn btn-primary flex1">

                                                    تفاصيل
                                                </a>

                                                @if ($offer->sal_project_id->status == 1 && $offer->status == 0)
                                                @elseif($offer->sal_project_id->status == 1 && $offer->status == 1)
                                                    {{-- <form action="{{ route('cancelOffer', $offer->id) }}" method="post">
                                    @csrf
                                    <input style="display:none" type="text" name="offer_id" value='{{ $offer->id }}'>
                                    <button style="color:black ;border:none;background:transparent" type='submit '> إلغاء
                                        العرض </button>
                                </form> --}}
                                                    <button type="button" class="btn btn-primary flex1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#cancel{{ $offer->id }}">
                                                        الغاء العرض
                                                    </button>

                                                    <div class="modal fade" id="cancel{{ $offer->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">الغاء
                                                                        عرض</h5>
                                                                    <button type="button" class="btn-close "
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    هل أنت متأكد من الغاء العرض ؟
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success"
                                                                        data-bs-dismiss="modal">إلغاء</button>

                                                                    <a href="{{ route('cancelOffer', $offer->id) }}">
                                                                        <button type="button" class="btn btn-danger">
                                                                            تأكيد</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- @elseif($offer->sal_project_id->status==1 && $offer->status==1) --}}
                                                @elseif($offer->sal_project_id->status == 4 && $offer->status == 2)
                                                    {{-- <form action="{{ route('confirmOffer') }}" method="post">
                                    @csrf
                                    <input style="display:none" type="text" name="project_id"
                                        value='{{ $offer->sal_project_id->id }}'>
                                    <input style="display:none" type="text" name="offer_id" value='{{ $offer->id }}'>

                                    <button style="color:black ;border:none;background:transparent" type='submit '> قبول
                                        المشروع </button>
                                </form> --}}
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#accept{{ $offer->id }}">
                                                        قبول
                                                    </button>

                                                    <!-- Modal -->

                                                    <div class="modal fade" id="accept{{ $offer->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">قبول
                                                                        مشروع</h5>
                                                                    <button type="button" class="btn-close "
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    هل أنت متأكد من قبول المشروع ؟
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success"
                                                                        data-bs-dismiss="modal">إلغاء</button>

                                                                    <a
                                                                        href="/offer/confirm/{{ $offer->id }}/{{ $offer->sal_project_id->id }}">
                                                                        <button type="button" class="btn btn-danger">
                                                                            تأكيد</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#reject{{ $offer->id }}">
                                                        رفض
                                                    </button>

                                                    <!-- Modal -->

                                                    <div class="modal fade" id="reject{{ $offer->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">رفض
                                                                        المشروع </h5>
                                                                    <button type="button" class="btn-close "
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    هل أنت متأكد من رفض المشروع ؟
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success"
                                                                        data-bs-dismiss="modal">إلغاء</button>

                                                                    <a href="{{ route('cancelOffer', $offer->id) }}">
                                                                        <button type="button" class="btn btn-danger">
                                                                            تأكيد</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('cancelOffer', $offer->id) }}"><button type="button"
                                                        class="btn btn-primary">تأكيد</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                                @elseif($offer->sal_project_id->status == 4 && $offer->status == 2)
                                                    {{-- <form action="{{ route('confirmOffer') }}" method="post">
                                    @csrf
                                    <input style="display:none" type="text" name="project_id"
                                        value='{{ $offer->sal_project_id->id }}'>
                                    <input style="display:none" type="text" name="offer_id" value='{{ $offer->id }}'>

                                    <button style="color:black ;border:none;background:transparent" type='submit '> قبول
                                        المشروع </button>
                                </form> --}}
                                                    {{-- <form action="{{ route('cancelOffer') }}" method="post">
                                    @csrf
                                    <input style="display:none" type="text" name="offer_id" value='{{ $offer->id }}'>
                                    <button style="color:black ;border:none;background:transparent" type='submit '> رفض
                                        المشروع </button>
                                </form> --}}
                                                @elseif($offer->sal_project_id->status == 2 && $offer->status == 3)
                                                    {{-- <form action="{{ route('finishWork') }}" method="post">

                                    @csrf
                                    <input style="display:none" type="text" name="project_id"
                                        value='{{ $offer->sal_project_id->id }}'>
                                    <input style="display:none" type="text" name="offer_id" value='{{ $offer->id }}'>

                                    <button style="color:black ;border:none;background:transparent" type='submit '> تسليم
                                        المشروع </button>
                                </form> --}}
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#deliver{{ $offer->id }}">
                                                        تسليم
                                                    </button>

                                                    <!-- Modal -->

                                                    <div class="modal fade" id="deliver{{ $offer->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">تسليم
                                                                        المشروع </h5>
                                                                    <button type="button" class="btn-close "
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    هل أنت متأكد من تسليم المشروع ؟

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success"
                                                                        data-bs-dismiss="modal">إلغاء</button>
                                                                    <form action="{{ route('finishWork') }}"
                                                                        method="post">

                                                                        @csrf
                                                                        <input style="display:none" type="text"
                                                                            name="project_id"
                                                                            value='{{ $offer->sal_project_id->id }}'>
                                                                        <input style="display:none" type="text"
                                                                            name="offer_id" value='{{ $offer->id }}'>

                                                                        <button
                                                                            style="color:black ;border:none;background:transparent"
                                                                            type='button ' class="btn btn-danger"> تسليم
                                                                            المشروع </button>
                                                                        {{-- <a href="{{ route('cancelOffer', $offer->id) }}"> <button
                                                            type="button" class="btn btn-danger"> تأكيد</button></a> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($offer->sal_project_id->status == 6 && $offer->status == 3)
                                                    <a href="{{ route('ComplainForm', $offer->id) }}">
                                                        <button style="color:white ;border:none" class="btn btn-primary"
                                                            type='submit ' class="note"> شكوى </button>
                                                    </a>
                                                @endif





                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>



    </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endsection
