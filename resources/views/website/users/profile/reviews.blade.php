@extends('website.layouts.master_dash')

@section('content')
    <div class=" container-fluid pb-5 mt-1">
        <div class="col-12 mb-4">
            <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl"
                    style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 ">
                        <h3 class="text-white mt-4 mb-1 pb-2 text-center">الرصيد</h3>
                        <h5 class="text-white  text-center">

                            {{ $balance }} $
                        </h5>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-3  ">
            <div class="card h-100 ">
                <div class="card-header pb-0 p-3 d-flex align-items-center justify-content-between ">
                    <h6 class="mb-0 ">المراجعات {{ $data->sal_review_to->count() }} </h6>
                </div>
                <div class="card-body p-3 p card_custom">
                    <ul class="list-group ">

                        @forelse($data->sal_review_to as $review)
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 ">
                                <div class="d-flex align-items-start flex-column justify-content-center ">
                                    <div class="avatar mr-1 mb-1 ">
                                        <img src={{ asset('images/' . $review->sal_project->sal_created_by->image) }}
                                            alt="kal " class="border-radius-lg shadow ">
                                    </div>
                                    <div class="ratings col d-flex">
                                        @for ($i = 0; $i <= $review->rate; $i++)
                                            <i class="fa fa-star rating-color text-primary"></i>
                                        @endfor

                                    </div>
                                    <h6 class="mb-0 text-sm ">{{ $review->sal_project->sal_created_by->name }}
                                    </h6>
                                    <p class="mb-0 text-xs ">{{ $review->created_at }}</p>
                                    <p class="mb-0 text-xs " style="    word-wrap: break-word;">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 ">
                                <h6 class="mb-0 text-sm ">لا يوجد</h6>

                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
