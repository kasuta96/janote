@if ($Note->image)
<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#imageModal{{ $Note->id }}" title="{{ __('Photo') }}"><i data-feather="image"></i></button>
<!-- Modal -->
<div class="modal fade" id="imageModal{{ $Note->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $Note->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ $Note->image }}" class="rounded img-fluid" alt="" loading="lazy">
            </div>
        </div>
    </div>
</div>
@endif
@if ($Note->audio)
<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#audioModal{{ $Note->id }}" title="{{ __('Audio') }}"><i data-feather="volume-2"></i></button>
<!-- Modal -->
<div class="modal fade" id="audioModal{{ $Note->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $Note->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <figure>
                    <audio controls src="{{ $Note->audio }}" loading="lazy">
                        Your browser does not support the <code>audio</code> element.
                    </audio>
                </figure>
            </div>
        </div>
    </div>
</div>
@endif
