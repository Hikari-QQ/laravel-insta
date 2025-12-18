<div class="modal fade" id="delete-story-{{ $story->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete Story
                </h3>
            </div>

            <div class="modal-body">
                <p>Are you sure want to delete this Story?</p>
                <div class="mt-3">
                    <img src="{{ $story->story_image }}" alt="story id {{ $story->id }}" class="image-lg">
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('stories.destroy', $story->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>