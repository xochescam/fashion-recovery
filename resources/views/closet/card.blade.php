<a href="{{ isset($items[$closet->ClosetID]) &&  count($items[$closet->ClosetID]) > 0 ? route('closet.show',$closet->ClosetID) : '#' }}">
    <div class="card card--public card--public card--item">

    @if(count($items[$closet->ClosetID]) > 1)
        <div id="carousel_{{ $closet->ClosetID }}" class="carousel mb-3">
            <div class="carousel-inner">
                        
                @foreach($items[$closet->ClosetID] as $item)
                    <div class="carousel-item {{ $item->ThumbPath == $items[$closet->ClosetID][0]->ThumbPath ? 'active' : ''  }}">
                        <img src="{{ url('storage/'.$item->ThumbPath) }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#carousel_{{ $closet->ClosetID }}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel_{{ $closet->ClosetID }}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        @else

            <div id="carousel_{{ $closet->ClosetID }}" class="mb-3">
                <div>
                    <img src="{{ url('/storage/'.$items[$closet->ClosetID][0]->ThumbPath) }}" class="d-block w-100" alt="...">

                </div>
            </div>
        @endif

        <div class="card-body">
            <h5 class="card-title mb-0"> {{ $closet->ClosetName }} </h5>
                
            <div class="edit-closet text-left ">
                <small class="text-left align-middle"> {{ isset($items[$closet->ClosetID]) ? count($items[$closet->ClosetID]) : '0' }} prenda{{ isset($items[$closet->ClosetID]) && count($items[$closet->ClosetID]) === 1  ? '': 's' }}</small>
                
                @if($closet->ClosetName !== 'Mi primer Clóset')
                    <a class="card-link float-right" href="#" data-toggle="modal" data-target="#updateCollection-{{ $closet->ClosetID }}"><i class="fas fa-pencil-alt"></i></a>
                @endif
            </div>
        </div>
    </div>
</a>