@extends('layouts.main.master')
@section('content')
  {{-- RIGHT CONTENT --}}
 
      <div style="margin-top:20px"></div>
      <div class="content">
       <div class="row">
                {{-- Left: conversation list --}}
                <div class="col-md-4">
                    <div class="card">
                     
                        <div class="card-body p-4">
                             <strong class="mb-4">Conversations</strong>
                            <div class="list-group chat-list p-4" id="userList" style="background-color:white">
                                @foreach($users as $u)
                                    <a href="#" class="list-group-item list-group-item-action user-item" data-user-id="{{ $u->id }}" style="background-color:#00cc99">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/img/' .$u->image) }}" class="user-avatar me-2" alt="">
                                            <div class="flex-fill">
                                                <div class="d-flex justify-content-between">
                                                    <strong >{{ $u->name }}</strong>
                                                    <small class="text-muted">{{ $u->last_time ? $u->last_time->diffForHumans() : '' }}</small>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="text-truncate" style="max-width:180px;">
                                                        {{ Str::limit($u->last_message, 40) }}
                                                    </div>
                                                    @if($u->unseen_count)
                                                        <span class="badge bg-danger ms-2">{{ $u->unseen_count }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: chat pane --}}
                <div class="col-md-8">
                    <div class="card" stylee="background:#f1f5f9;">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div id="chatWith">
                                <strong>Select a user to chat</strong>
                            </div>
                            <div>
                                <button id="refreshBtn" class="btn btn-sm btn-outline-secondary">Refresh</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chatWindow" class="chat-window"></div>

                            <form id="messageForm" class="mt-3" enctype="multipart/form-data" style="display:none;">
                                @csrf
                                <div class="row g-2 align-items-center">
                                    <div class="col">
                                        <input type="text" name="body" id="body" class="form-control" placeholder="Type a message">
                                    </div>
                                    <div class="col-auto">
                                        <input type="file" name="image" id="image" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary btn-sm" style="background-color:#00cc99; color:white; font-weight:bold">Send</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
       </div>
      </div>
@endsection








