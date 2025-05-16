@include('includes.members.header')

<!-- Begin Page Content -->
<div class="container-fluid pb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 admindash-headings">Support Chat</h1>

    </div>

    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Ticket #{{ $supportTicket->id }} 
                    <span class="badge badge-{{ $supportTicket->support_status == 'pending' ? 'warning' : 'success' }}">
                        {{ ucfirst($supportTicket->support_status) }}
                    </span>
                </h6>
                <small>Created: {{ $supportTicket->created_at->format('d M, Y h:i A') }}</small>
            </div>
        </div>

        <div class="card-body">
            <!-- Subject -->
            <div class="mb-3">
                <strong>Subject:</strong> 
                <span class="">
                    {{ $supportTicket->support_subject }}
                </span>
            </div>

            <!-- first Message -->
            <div class="mb-3">
                <strong>Message:</strong> 
                <p class="">
                    {{ $supportTicket->support_message }}
                </p>
            </div>

            <!-- Message Thread -->
            <div class="border p-3 rounded mb-4" style="max-height: 400px; overflow-y: auto;">
                @if($chats && $chats->count())
                    @foreach ($chats as $chat)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    {{-- Check if message is from admin --}}
                                    @if ($chat->chat_from_admin)
                                        <strong>Admin</strong>
                                        <p class="mb-1">{{ $chat->chat_from_admin }}</p>

                                        @if ($chat->files_urls_admin)
                                            <a href="{{ asset('storage/' . $chat->files_urls_admin) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                View Attachment
                                            </a>
                                        @endif
                                    @endif

                                    {{-- Check if message is from member --}}
                                    @if ($chat->chat_from_member)
                                        <strong>Member</strong>
                                        <p class="mb-1">{{ $chat->chat_from_member }}</p>

                                        @if ($chat->files_urls_member)
                                            <a href="{{ asset('storage/' . $chat->files_urls_member) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                View Attachment
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <small class="text-muted">{{ $chat->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                    <p>No messages yet.</p>
                @endif
            </div>


            <!-- Reply Form -->
            <form action="{{ route('supportChatMemberSubmit', $supportTicket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="message">Your Reply</label>
                    <textarea name="message" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="attachment">Attach File (optional)</label>
                    <input type="file" name="attachment" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-primary">Send Reply</button>
            </form>
        </div>
    </div>





</div>
<!-- /.container-fluid -->



@include('includes.members.footer')