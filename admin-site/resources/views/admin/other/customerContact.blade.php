@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">

        <h3 class="my-3 text-muted" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">Customer Message</h3>

        @if (session('deleted'))
            <div class="row">
                <div class="col-md-5 offset-md-7">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('deleted')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
            </div>
        @endif

        <span class="py-2 px-3 rounded">
            <img src="{{asset('assets/images/TypcnMessages.svg')}}" width="25">
        </span>
        <span class="py-2 px-3 rounded">
            {{count($messages)}}
        </span>

        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                @if (count($messages))
                <div class="accordion" id="accordionExample">
                    @foreach ($messages as $message)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="lead text-muted">Customer Message {{$message->id}}</h5>
                          </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="card p-3 mt-2 rounded shadow" style="background: linear-gradient(rgba(0,0,0,0.08),rgba(0,0,0,0.08));">
                                <div class="card-titel">
                                    <div class="row mb-2">
                                        <div class="col-1">
                                            <i class="fa-solid fa-id-badge"></i>
                                        </div>
                                        <div class="col">
                                            {{$message->user_name}}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-1">
                                            <i class="fa-solid fa-at"></i>
                                        </div>
                                        <div class="col">
                                            {{$message->user_email}}
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <h6 class="card-subtitle mb-2 text-body-secondary">What Customer Say ?</h6>
                                    <p class="card-text">
                                        {{$message->contact_message}}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end me-5">
                                        <a onclick="history.back()" class="card-link bg-info rounded p-2 cursor-pointer" title="go back">
                                            <img src="{{asset('assets/images/TdesignRollback.svg')}}" width="20">
                                        </a>
                                        <a href="{{route('admin#deleteMessage',$message->id)}}" class="card-link bg-danger p-2 rounded" title="delete">
                                            <img src="{{asset('assets/images/MdiCommentRemoveOutline.svg')}}" width="20">
                                        </a>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <h4 class="text-center text-danger mt-5">There is no message !</h4>
                @endif
                <div class="mt-3">{{$messages->links()}}</div>
            </div>
        </div>

    </div>
@endsection
