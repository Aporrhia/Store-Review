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
            <div class="custom-scrollbar">
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

                            <!-- Replies Section (recursive, up to 5 levels) -->
                            <div class="ml-8 mt-2">
                                @php
                                    $renderReplies = function($replies, $parentId, $level = 1) use (&$renderReplies) {
                                        if ($level > 5) return;
                                        echo '<ul class="space-y-2">';
                                        foreach ($replies as $reply) {
                                            $repliesSectionId = 'replies-section-'.$reply->id;
                                            echo '<li class="bg-gray-100 rounded p-2">';
                                            echo '<div class="flex items-center gap-2 mb-1">';
                                            echo '<span class="flex items-center justify-center aspect-square rounded-full size-7 bg-[#84cc16] text-white text-base font-bold" aria-label="Profile">'.strtoupper(substr($reply->user->name ?? $reply->user->email ?? 'U', 0, 1)).'</span>';
                                            echo '<span class="font-semibold text-gray-700">'.strtoupper(substr($reply->user->name ?? $reply->user->email ?? 'U', 0, 1)).'***</span>';
                                            echo '<span class="text-xs text-gray-500">'.$reply->created_at->format('M d, Y H:i').'</span>';
                                            echo '</div>';
                                            echo '<div class="text-gray-800">'.e($reply->body).'</div>';
                                            // Reply button and form for this reply
                                            if(auth()->check() && $level < 5) {
                                                echo '<button type="button" class="text-xs text-[#84cc16] font-bold hover:underline mt-2 mb-1" data-reply-toggle="reply-form-reply-'.$reply->id.'">Reply</button>';
                                                echo '<form id="reply-form-reply-'.$reply->id.'" class="hidden mt-2" method="POST" action="'.route('comment.reply', $reply->comment_id).'">';
                                                echo csrf_field();
                                                echo '<input type="hidden" name="parent_id" value="'.$reply->id.'">';
                                                echo '<textarea name="body" rows="2" maxlength="200" class="w-full rounded border-gray-300 px-3 py-1 focus:ring-[#84cc16] focus:border-[#84cc16] text-sm" placeholder="Write a reply..." required></textarea>';
                                                echo '<button type="submit" class="mt-1 px-3 py-1 rounded bg-[#84cc16] text-white text-xs font-bold hover:bg-[#6ca10e]">Send</button>';
                                                echo '</form>';
                                            }
                                            // Render children recursively, always visible for replies
                                            if ($reply->children && $reply->children->count()) {
                                                echo '<div class="ml-8 mt-2">';
                                                $renderReplies($reply->children, $reply->id, $level + 1);
                                                echo '</div>';
                                            }
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                    };
                                @endphp
                                @if($comment->replies && $comment->replies->count())
                                    <button type="button" class="text-xs text-gray-500 font-bold hover:underline mb-2" data-toggle-replies="replies-section-{{ $comment->id }}">
                                        <span class="material-symbols-outlined align-middle">forum</span>
                                        Show/Hide Replies ({{ $comment->replies->where('parent_id', null)->count() }})
                                    </button>
                                    <div id="replies-section-{{ $comment->id }}" style="display:none;">
                                        {!! $renderReplies($comment->replies->where('parent_id', null), null, 1) !!}
                                    </div>
                                @endif

                                <!-- Reply Form for top-level comment -->
                                @if(auth()->check())
                                    <button type="button" class="text-xs text-[#84cc16] font-bold hover:underline mt-2 mb-1" data-reply-toggle="reply-form-{{ $comment->id }}">Reply</button>
                                    <form id="reply-form-{{ $comment->id }}" class="hidden mt-2" method="POST" action="{{ route('comment.reply', $comment->id) }}">
                                        @csrf
                                        <textarea name="body" rows="2" maxlength="200" class="w-full rounded border-gray-300 px-3 py-1 focus:ring-[#84cc16] focus:border-[#84cc16] text-sm" placeholder="Write a reply..." required></textarea>
                                        <button type="submit" class="mt-1 px-3 py-1 rounded bg-[#84cc16] text-white text-xs font-bold hover:bg-[#6ca10e]">Send</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-500">No comments yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Toggle comments section (existing)
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

                // Toggle reply forms
                document.querySelectorAll('button[data-reply-toggle]').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var targetId = btn.getAttribute('data-reply-toggle');
                        var form = document.getElementById(targetId);
                        if (form) {
                            form.classList.toggle('hidden');
                            if (!form.classList.contains('hidden')) {
                                form.querySelector('textarea').focus();
                            }
                            // Force parent #comments-section to recalculate height if open
                            var commentsSection = document.getElementById('comments-section');
                            if (commentsSection && commentsSection.style.maxHeight && commentsSection.style.maxHeight !== '0px') {
                                commentsSection.style.maxHeight = '';
                                setTimeout(function() {
                                    commentsSection.style.maxHeight = commentsSection.scrollHeight + 'px';
                                }, 10);
                            }
                        }
                    });
                });
                // Toggle replies sections
                document.querySelectorAll('button[data-toggle-replies]').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var targetId = btn.getAttribute('data-toggle-replies');
                        var section = document.getElementById(targetId);
                        if (section) {
                            if (section.style.display === 'none' || section.style.display === '') {
                                section.style.display = 'block';
                            } else {
                                section.style.display = 'none';
                            }
                            // Force parent #comments-section to recalculate height if open
                            var commentsSection = document.getElementById('comments-section');
                            if (commentsSection && commentsSection.style.maxHeight && commentsSection.style.maxHeight !== '0px') {
                                // Remove maxHeight to allow natural growth, then restore
                                commentsSection.style.maxHeight = '';
                                // Next frame, set to scrollHeight
                                setTimeout(function() {
                                    commentsSection.style.maxHeight = commentsSection.scrollHeight + 'px';
                                }, 10);
                            }
                        }
                    });
                });
            });
        </script>
    </div>