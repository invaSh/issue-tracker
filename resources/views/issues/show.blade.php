@extends('layout.layout')

@section('title', 'Issue Detail')

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-800 text-gray-100 rounded-xl shadow-lg p-6">
        <div class="flex justify-between mb-3 border-b border-gray-600 pb-3">
            <h1 class="text-2xl font-bold">{{ $issue->title }}</h1>
            <div class="flex items-center justify-center gap-2">
                <a href="{{ route('issues.edit', $issue->id) }}"
                    class="flex items-center rounded text-gray-200 hover:text-gray-400 transition-all ease-in duration-100 text-sm cursor-pointer ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-notebook-pen-icon lucide-notebook-pen">
                        <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
                        <path d="M2 6h4" />
                        <path d="M2 10h4" />
                        <path d="M2 14h4" />
                        <path d="M2 18h4" />
                        <path
                            d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                    </svg>
                    <span class="pl-1">Edit</span>
                </a>

                <form action="{{ route('issues.destroy', $issue->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center cursor-pointer text-red-600 hover:text-red-300 transition-all ease-in duration-100 rounded text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <p class="mb-2"><strong>Project:</strong> {{ $issue->project->name ?? '-' }}</p>
        <p class="mb-2"><strong>Status:</strong> {{ ucfirst($issue->status) }}</p>
        <p class="mb-2"><strong>Priority:</strong> {{ ucfirst($issue->priority) }}</p>
        <p class="mb-2"><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($issue->due_date)->format('M d, Y') }}</p>
        <p class="mb-4"><strong>Description:</strong> {{ $issue->description ?? '-' }}</p>

        <div class="mb-4">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-lg mb-2">Tags</h2>
                <h3 id="toggleTags"
                    class="text-xs border px-2 py-0.5 rounded-full hover:bg-gray-100 hover:text-gray-700 cursor-pointer transition-all ease-in duration-150">
                    + Add tag
                </h3>
            </div>

            <div id="staticTags" class="flex flex-wrap gap-2 p-2 rounded min-h-[40px]">
                @if (!$issue->tags->isEmpty())
                    @foreach ($issue->tags as $tag)
                        <div id="tag"
                            class="flex items-center space-x-2 px-3 py-1 rounded-full detach-tag text-xs font-medium cursor-pointer group
            transition-transform duration-200 ease-in-out transform hover:scale-105"
                            style="background-color: {{ $tag->color ?? '#374151' }}" data-id="{{ $tag->id }}">
                            <span>{{ $tag->name }}</span>
                            <button
                                class="ml-1 text-gray-100 group-hover:text-red-600 font-bold transition-colors duration-200">&times;</button>
                        </div>
                    @endforeach
                @else
                    <span class="instruction text-gray-400 text-xs italic">
                        No tags assigned. Click "Add tag" to add.
                    </span>
                @endif
            </div>
        </div>



        <div class="mt-6">
            <h2 class="font-bold text-lg mb-4">Comments ({{ $issue->comments->count() }})</h2>

            <div class="bg-gray-750 rounded-lg p-4 mb-4 border border-gray-600">
                <div class="flex space-x-3">
                    <div
                        class="w-8 h-8 bg-gray-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div id="authorError" class="text-red-400 text-xs mb-1 hidden"></div>
                        <input type="text" id="authorName" placeholder="Your name"
                            class="w-full px-3 py-2 mb-2 bg-gray-700 text-gray-100 rounded-lg border border-gray-600 focus:border-blue-500 outline-none">

                        <div id="commentError" class="text-red-400 text-xs mb-1 hidden"></div>
                        <textarea id="newComment" placeholder="Write a comment..." rows="2"
                            class="w-full px-3 py-2 bg-gray-700 text-gray-100 rounded-lg border border-gray-600 focus:border-blue-500 outline-none resize-none"></textarea>

                        <div class="flex justify-end mt-2 space-x-2">
                            <button id="addComment"
                                class="px-4 py-1.5 bg-gray-600 hover:bg-gray-500 text-white text-sm rounded-lg">Comment</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-3" id="commentsList">
                @if ($issue->comments->isEmpty())
                    <div class="text-center py-6 text-gray-400">
                        <p class="text-sm">No comments yet. Be the first to comment!</p>
                    </div>
                @else
                    @foreach ($issue->comments as $comment)
                        <div class="bg-gray-750 rounded-lg p-4 border border-gray-600">
                            <div class="flex space-x-3">
                                <div
                                    class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                    {{ substr($comment->author_name ?? 'U', 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span
                                            class="font-medium text-gray-200">{{ $comment->author_name ?? 'Anonymous' }}</span>
                                        <span
                                            class="text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-gray-100 text-sm">{{ $comment->body }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    <div id="tagModal" class="fixed inset-0 backdrop-blur-xs flex items-center justify-center hidden">
        <div class="bg-gray-600 text-gray-100 rounded-xl w-96 p-6 relative text-center">
            <h2 class="text-lg font-bold mb-4">Add Tag</h2>
            <button id="closeTagModal"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-200 cursor-pointer">&times;</button>

            <div id="existingTagForm">
                <select id="existingTags"
                    class="w-full h-8 rounded bg-gray-500/20 px-2 text-sm outline-none border-none focus:outline-none focus:ring-0 focus:border-none">
                    <option value="" disabled selected>Select a tag</option>
                    @foreach (\App\Models\Tag::all() as $tag)
                        <option value="{{ $tag->id }}" class="text-gray-800">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <span id="existingTagError" class="text-red-400 text-xs hidden mt-1"></span>
                <button id="attachTag"
                    class="w-full h-8 text-sm font-medium rounded bg-gray-800/30 hover:shadow transition mt-3">
                    Attach
                </button>
            </div>
        </div>
    </div>
    <script>
        const tagModal = document.getElementById('tagModal');
        const toggleTags = document.getElementById('toggleTags');
        const closeTagModal = document.getElementById('closeTagModal');

        toggleTags.addEventListener('click', () => tagModal.classList.remove('hidden'));
        closeTagModal.addEventListener('click', () => tagModal.classList.add('hidden'));

        document.getElementById('attachTag').addEventListener('click', async () => {
            const select = document.getElementById('existingTags');
            const errorSpan = document.getElementById('existingTagError');

            errorSpan.textContent = '';
            errorSpan.classList.add('hidden');

            const tagId = select.value;
            if (!tagId) {
                errorSpan.textContent = 'Select a tag';
                errorSpan.classList.remove('hidden');
                return;
            }

            try {
                const res = await fetch(`{{ url('/tags/' . $issue->id . '/attach-tag') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        tag_id: tagId
                    })
                });

                const data = await res.json();

                if (res.ok && data.success) {
                    const tagContainer = document.getElementById('staticTags');
                    const instruction = tagContainer.querySelector('.instruction');
                    if (instruction) instruction.remove();

                    const div = document.createElement('div');
                    div.className = "flex items-center space-x-2 px-3 py-1 rounded-full text-xs font-medium";
                    div.style.backgroundColor = data.color || '#374151';
                    div.dataset.id = data.id || tagId;
                    div.innerHTML = `
                <span>${data.name}</span>
                <button class="ml-1 text-gray-100 hover:text-red-400 text-xs font-bold detach-tag">&times;</button>
            `;
                    tagContainer.appendChild(div);

                    select.value = '';
                    tagModal.classList.add('hidden');
                } else {
                    errorSpan.textContent = data.message || 'Error attaching tag';
                    errorSpan.classList.remove('hidden');
                }
            } catch (err) {
                console.error(err);
                errorSpan.textContent = 'Network error or server issue';
                errorSpan.classList.remove('hidden');
            }
        });

        document.getElementById('staticTags').addEventListener('click', async (e) => {
            const tagDiv = e.target.closest('div[data-id]');
            if (!tagDiv) return;

            const tagId = tagDiv.dataset.id;
            const button = tagDiv.querySelector('button');

            const originalHtml = button.innerHTML;

            button.innerHTML = `
                <svg class="animate-spin h-4 w-4 text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v2a6 6 0 00-6 6H4z"></path>
                </svg>
            `;

            try {
                const res = await fetch(`{{ url('/tags/' . $issue->id . '/detach-tag') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        tag_id: tagId
                    })
                });

                const data = await res.json();

                if (res.ok && data.success) {
                    tagDiv.remove();
                } else {
                    button.innerHTML = originalHtml;
                    alert(data.message || 'Error detaching tag');
                }
            } catch (err) {
                console.error(err);
                button.innerHTML = originalHtml;
                alert('Error detaching tag');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addCommentBtn = document.getElementById('addComment');
            const newCommentInput = document.getElementById('newComment');
            const authorInput = document.getElementById('authorName');
            const commentsList = document.getElementById('commentsList');
            const commentErrorDiv = document.getElementById('commentError');
            const authorErrorDiv = document.getElementById('authorError');

            newCommentInput.addEventListener('input', () => {
                commentErrorDiv.textContent = '';
                commentErrorDiv.classList.add('hidden');
            });

            authorInput.addEventListener('input', () => {
                authorErrorDiv.textContent = '';
                authorErrorDiv.classList.add('hidden');
            });

            addCommentBtn.addEventListener('click', async () => {
                const content = newCommentInput.value.trim();
                const author = authorInput.value.trim();

                addCommentBtn.disabled = true;
                addCommentBtn.textContent = 'Posting...';

                try {
                    const res = await fetch(`{{ route('comments.comment', $issue->id) }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            body: content,
                            author_name: author
                        })
                    });

                    const data = await res.json();

                    if (res.ok && data.success) {
                        newCommentInput.value = '';
                        authorInput.value = '';
                        addCommentBtn.disabled = false;
                        addCommentBtn.textContent = 'Comment';

                        const div = document.createElement('div');
                        div.className = 'bg-gray-750 rounded-lg p-4 border border-gray-600';
                        div.innerHTML = `
                    <div class="flex space-x-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                            ${(data.comment.author_name || 'U').charAt(0).toUpperCase()}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="font-medium text-gray-200">${data.comment.author_name}</span>
                                <span class="text-gray-400 text-xs">Just now</span>
                            </div>
                            <div class="text-gray-100 text-sm">${data.comment.body}</div>
                        </div>
                    </div>
                `;
                        commentsList.prepend(div);

                    } else if (data.errors) {
                        if (data.errors.body) {
                            commentErrorDiv.textContent = data.errors.body.join(' ');
                            commentErrorDiv.classList.remove('hidden');
                        }
                        if (data.errors.author_name) {
                            authorErrorDiv.textContent = data.errors.author_name.join(' ');
                            authorErrorDiv.classList.remove('hidden');
                        }
                        addCommentBtn.disabled = false;
                        addCommentBtn.textContent = 'Comment';
                    } else {
                        commentErrorDiv.textContent = data.message || 'Error posting comment.';
                        commentErrorDiv.classList.remove('hidden');
                        addCommentBtn.disabled = false;
                        addCommentBtn.textContent = 'Comment';
                    }

                } catch (err) {
                    console.error(err);
                    commentErrorDiv.textContent = 'Network or server error.';
                    commentErrorDiv.classList.remove('hidden');
                    addCommentBtn.disabled = false;
                    addCommentBtn.textContent = 'Comment';
                }
            });
        });
    </script>


@endsection
