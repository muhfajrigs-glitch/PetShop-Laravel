<div
    x-data="{
        open: false,
        actionUrl: '',
        message: ''
    }"
    x-on:open-delete-modal.window="
        open = true;
        actionUrl = $event.detail.action;
        message = $event.detail.message;
    "
    x-show="open"
    x-cloak
    class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
>
    <div @click.away="open = false"
         class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Confirm Delete</h3>
        <p class="text-gray-600 mb-6" x-text="message"></p>
        <div class="flex justify-end gap-3">
            <button type="button" @click="open = false"
                    class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">
                Cancel
            </button>
            <form :action="actionUrl" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-medium">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>