@extends('layouts.admin.master')

@section('title', 'Liên hệ')

@section('title-heading', 'Liên hệ')

@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Liên hệ
                </h3></div>
            </div>
            <div class="card-body">
                @if (count($contacts) > 0)
                @foreach ($contacts as $contact)
                <div class="timeline timeline-3 mb-4">
                    <div class="timeline-items">
                        <div class="timeline-item">
                            <div class="timeline-media">
                                <img alt="Avatar" src="http://cdn.onlinewebfonts.com/svg/img_258083.png">
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="mr-2">
                                        <span class="text-dark-75 text-hover-primary font-weight-bold">{{ $contact->name }}</span>
                                        {{-- <span class="font-weight-bold ml-2">{{ roundNumber($review->rating) }}<i class="fas fa-star" style="color:#fad102"></i></span> --}}
                                        <span class="text-muted ml-2">{{ $contact->created_at->format("d-m-Y \l\ú\c H:i") }}</span>
                                        <span class="label label-primary font-weight-bolder label-inline ml-2">{{ $contact->email }}</span>
                                    </div>
                                    {{-- <form action="{{ route('admin.review.delete', $review->id) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-hover-light-primary btn-sm btn-icon delete-item">
                                                <i class="flaticon2-trash"></i>
                                        </button>
                                    </form> --}}
                                </div>
                                <p class="p-0 font-weight-bold font-size-h6">
                                    <p>Tiêu đề: {{ $contact->subject }}</p>
                                    <p>Nội dung: {{ $contact->message }}</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else 
                <div class="alert alert-warning text-center font-weight-bold">Chưa có liên hệ nào !</div>
                @endif
            </div>
        </div>
        <!--end::table-->
    </div>
</div>
@endsection
