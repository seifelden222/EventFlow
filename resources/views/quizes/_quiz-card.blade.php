
<div class="card card-dark shadow rounded-4 h-100 d-flex flex-column">
    @if($quiz->img)
    <div class="p-3">
        <div class="img-wrap border border-2 border-info">
            @php
            $qimg = $quiz->img;
            if (Str::startsWith($qimg, ['http://','https://'])) {
                $qsrc = $qimg;
            } elseif (Str::startsWith($qimg, ['storage/'])) {
                $qsrc = asset($qimg);
            } else {
                $qsrc = asset('storage/' . ltrim($qimg, '/'));
            }
            @endphp
            <img src="{{ $qsrc }}" alt="{{ $quiz->title }}" style="height:140px; width:100%; object-fit:cover; border-radius:6px;" />
        </div>
    </div>
    @endif
    <div class="card-body pt-3 flex-grow-1">
        <p class="fw-bold text-white mb-1">{{ $quiz->title }}</p>
        <p class="muted small mb-2">{{ $quiz->date ? \Carbon\Carbon::parse($quiz->date)->format('M d, Y') : $quiz->created_at->format('M d, Y') }}</p>
        <p class="muted" style="letter-spacing:.4px;line-height:20px">{{ \Illuminate\Support\Str::limit($quiz->description ?? '', 120) }}</p>
    </div>
    <div class="card-footer bg-transparent border-0 pb-3 px-3 mt-auto">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <a href="{{ route('quizes.show', $quiz->id) }}" class="btn btn-sm btn-outline-info">Show</a>
                <a href="{{ route('quizes.edit', $quiz->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                <a href="{{ route('quizes.take', $quiz) }}" class="btn btn-sm btn-primary">Take</a>
                
            </div>
            <div>
                @if(isset($quiz->event))
                <a href="{{ route('events.show', $quiz->event) }}" class="btn btn-sm btn-outline-secondary rounded-3">View Event</a>
                @endif
            </div>
        </div>
    </div>
</div>
