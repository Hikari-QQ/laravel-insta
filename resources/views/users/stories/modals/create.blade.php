<!-- Modal -->
<div class="modal fade" id="create-story-{{ Auth::user()->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('stories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createStoryModalLabel">Create Story</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="story_image" class="form-label">Select Image</label>
            <input class="form-control" type="file" id="story_image" name="story_image" required>
          </div>
          <input type="hidden" name="expires_at" value="{{ now()->addMinutes(5)->format('Y-m-d H:i:s') }}">
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Post Story</button>
        </div>
      </form>
    </div>
  </div>
</div>






