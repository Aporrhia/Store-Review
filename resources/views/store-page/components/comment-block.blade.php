<!-- Comments Block -->
<style>
    /* Custom scrollbar for modern browsers */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        background: #f3f4f6;
        border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #84cc16;
        border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6ca10e;
    }
</style>
    <div>
        <div class="flex items-center mb-4 cursor-pointer select-none" id="comments-toggle-row">
            <h3 class="text-2xl font-bold text-[#141414] mr-2">Comments</h3>
            <span id="comments-arrow" class="material-symbols-outlined text-[#84cc16] transition-transform duration-300" style="font-size: 2rem;">expand_more</span>
        </div>
        <div id="comments-section" class="transition-all duration-300 overflow-hidden">
            @if(($showForm ?? true) && auth()->check() && auth()->id() !== $profileUser->id)
                <form method="POST" action="{{ route('profile.comment', $profileUser->id) }}" class="mb-6">
                    @csrf
                    <input type="hidden" name="recipient_id" value="{{ $profileUser->id }}">
                    <input type="text" name="title" maxlength="100" class="w-full rounded border-gray-300 px-3 py-2 mb-2 focus:ring-[#84cc16] focus:border-[#84cc16]" placeholder="Title" require>
                    <textarea name="comment" rows="3" maxlength="200" class="w-full rounded border-gray-300 px-3 py-2 focus:ring-[#84cc16] focus:border-[#84cc16]" placeholder="Add your comment..." require></textarea>
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" class="mt-2 px-4 py-2 rounded bg-[#84cc16] text-white font-bold hover:bg-[#6ca10e]">Submit</button>
                </form>
            @elseif(($showForm ?? true) && !auth()->check())
                <div class="mb-6 text-gray-500">To comment, please <a href="{{ route('login') }}" class="text-[#84cc16] font-bold hover:underline">sign in</a>.</div>
            @endif
            <div style="max-height: 400px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #84cc16 #f3f4f6;" class="custom-scrollbar">
                <ul class="space-y-4">
                    @forelse($comments as $comment)
                        <li class="border-b pb-2">
                            <div class="flex mb-2 justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <span class="flex items-center justify-center aspect-square rounded-full size-10 bg-[#84cc16] text-white text-xl font-bold focus:outline-none" aria-label="Profile">
                                        {{ strtoupper(substr($comment->commentWriter->name ?? $comment->commentWriter->email ?? 'U', 0, 1)) }}
                                    </span>
                                    <span class="font-bold text-gray-800">{{ strtoupper(substr($comment->commentWriter->name ?? $comment->commentWriter->email ?? 'U', 0, 1)) }}***</span>
                                </div>
                                <span class="text-xs text-gray-500 me-4">{{ $comment->created_at->format('M d, Y H:i') }}</span>
                            </div>
                            @if($comment->title)
                                <div class="text-lg mt-1 font-semibold">{{ $comment->title }}</div>
                            @endif
                            <div class="mt-1 text-gray-700 break-words whitespace-pre-line me-4">{{ $comment->comment }}</div>
                        </li>
                    @empty
                        <li class="text-gray-500">No comments yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var toggleRow = document.getElementById('comments-toggle-row');
                var section = document.getElementById('comments-section');
                var arrow = document.getElementById('comments-arrow');
                var open = true;
                function setState(isOpen) {
                    if (isOpen) {
                        section.style.maxHeight = section.scrollHeight + 'px';
                        arrow.style.transform = 'rotate(0deg)';
                    } else {
                        section.style.maxHeight = '0';
                        arrow.style.transform = 'rotate(-90deg)';
                    }
                }
                setState(open);
                toggleRow.addEventListener('click', function () {
                    open = !open;
                    setState(open);
                });
            });
        </script>
    </div>