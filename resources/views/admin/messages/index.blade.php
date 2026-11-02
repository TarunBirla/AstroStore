@extends('layouts.admin')

@section('title', 'Devotee Contact Queries')
@section('page_title', 'Contact Queries & Birth Inquiries')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-chat-left-dots-fill me-2"></i>Devotee Inquiries</h4>

        <!-- Status Filter -->
        <div class="d-flex gap-2">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">All Messages</a>
            <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="btn btn-sm {{ request('status') == 'unread' ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">Unread</a>
            <a href="{{ route('admin.messages.index', ['status' => 'read']) }}" class="btn btn-sm {{ request('status') == 'read' ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">Read</a>
        </div>
    </div>

    @if($messages->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Sender Name</th>
                        <th>Email & Phone</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                        <tr style="{{ $msg->status === 'unread' ? 'background: rgba(61,29,107,0.3); font-weight: 500;' : '' }}">
                            <td>
                                <strong class="text-light">{{ $msg->name }}</strong>
                            </td>
                            <td>
                                <span class="text-gold small d-block">{{ $msg->email }}</span>
                                <small class="text-muted-cosmic">{{ $msg->phone ?: 'No Phone' }}</small>
                            </td>
                            <td>
                                <span class="text-light small">{{ Str::limit($msg->subject ?: $msg->message, 45) }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $msg->status === 'unread' ? 'badge-saffron' : 'bg-secondary' }}">
                                    {{ ucfirst($msg->status) }}
                                </span>
                            </td>
                            <td class="small text-muted-cosmic">{{ $msg->created_at->diffForHumans() }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="Read Full Inquiry">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" id="delMsg{{ $msg->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delMsg{{ $msg->id }}', 'Delete this message?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center pagination-cosmic">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-chat-heart fs-1 d-block mb-2 text-gold"></i>
            <h5>No customer inquiries received yet.</h5>
        </div>
    @endif
</div>
@endsection
