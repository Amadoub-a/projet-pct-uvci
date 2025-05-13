@extends(
'layouts.app',
[
'title' => 'Smart Parc Auto | Notification',
]
)
@section('content')
    @foreach ($notifications as $notification)
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex flex-wrap w-100 align-items-center">
                    <div class="flex-grow-1">
                        <span>{!!$notification->data['titre']!!}</span>
                    </div>
                    <div class="text-muted small ms-3">
                        <div>
                            <strong>{{$notification->created_at->format('d-m-Y à H:i')}}</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>
                    {!!$notification->data['message']!!}
                </p>
            </div>
        </div>
    @endforeach
@endsection