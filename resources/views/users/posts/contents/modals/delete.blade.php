<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content cute-modal">
            {{-- モーダル内専用スタイル --}}
            <style>
                .cute-modal {
                    background-color: rgba(255, 255, 255, 0.9) !important;
                    backdrop-filter: blur(10px);
                    border-radius: 25px !important;
                    border: none !important;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
                }
                .text-pink-title {
                    color: #ff85a2;
                    font-weight: bold;
                }
                .heart-blue {
                    color: #BFEAF2;
                }
                /* 画像全体が入るように調整 */
                .post-preview-container {
                    background-color: #f8f9fa; /* 画像の隙間を埋める背景色 */
                    border-radius: 15px;
                    overflow: hidden;
                    border: 2px solid #fff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 250px; /* プレビューの高さ固定 */
                }
                .post-preview-img {
                    max-width: 100%;
                    max-height: 100%;
                    object-fit: contain; /* 写真全体を表示 */
                }
                /* ボタンデザイン（Registerと統一） */
                .btn-cancel-cute {
                    background-color: #DFF4F8 !important;
                    color: #37353E !important;
                    border: none !important;
                    border-radius: 4px !important;
                    padding: 8px 25px;
                    font-weight: bold;
                    transition: 0.3s;
                }
                .btn-delete-cute {
                    background-color: #ff85a2 !important;
                    color: #fff !important;
                    border: none !important;
                    border-radius: 4px !important;
                    padding: 8px 25px;
                    font-weight: bold;
                    transition: 0.3s;
                }
            </style>

            <div class="modal-header border-0 justify-content-center pt-4">
                <h3 class="h5 modal-title text-pink-title">
                    <i class="fa-solid fa-heart heart-blue me-2"></i>
                    Delete Post
                    <i class="fa-solid fa-heart heart-blue ms-2"></i>
                </h3>
            </div>

            <div class="modal-body text-center px-4">
                <p class="text-secondary mb-3">Are you sure you want to delete this post?</p>
                
                {{-- 写真全体が見えるコンテナ --}}
                <div class="post-preview-container shadow-sm mb-3">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="post-preview-img">
                </div>
                
                <p class="small text-muted mb-0 px-2" style="word-break: break-all;">
                    {{ $post->description }}
                </p>
            </div>

            <div class="modal-footer border-0 justify-content-center pb-4">
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-cancel-cute me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-delete-cute">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>