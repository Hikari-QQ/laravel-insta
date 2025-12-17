@foreach($home_stories as $story)
<div class="modal fade" id="showStoryModal-{{ $story->id }}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-white">
      <div class="modal-body text-center">
        <img src="{{ $story->story_image }}" alt="{{ $story->user->name }}" class="img-fluid rounded">
        <p class="mt-2">{{ $story->user->name }}</p>
      </div>
    </div>
  </div>
</div>
@endforeach
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
let stories = @json($stories); // BladeからJSに渡す
let currentIndex = 0;
let intervalId;
const displayTime = 3000; // 3秒ごとに切替

function showStory(index) {
    const story = stories[index];
    document.getElementById('story-image').src = story.story_image;
    document.getElementById('story-user').textContent = story.user.name;
}

// モーダルが開いたらスタート
document.querySelectorAll('.story-item img').forEach((el, idx) => {
    el.addEventListener('click', () => {
        currentIndex = idx;
        showStory(currentIndex);
        $('#storyModal').modal('show');

        // 自動切替
        intervalId = setInterval(() => {
            currentIndex++;
            if(currentIndex >= stories.length) currentIndex = 0;
            showStory(currentIndex);
        }, displayTime);
    });
});

// モーダルが閉じられたら停止
$('#storyModal').on('hidden.bs.modal', () => {
    clearInterval(intervalId);
});
</script>
