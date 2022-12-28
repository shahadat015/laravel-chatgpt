<template>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0"
    >
        <div class="max-w-6xl w-full mx-auto sm:px-6 lg:px-8 space-y-4 py-4">
            <div class="text-center text-gray-800 dark:text-gray-300 py-4">
                <h1 class="text-7xl font-bold">Writebot</h1>
            </div>

            <div
                class="w-full rounded-md bg-white border-2 border-gray-600 p-4 min-h-[60px] h-full text-gray-600"
            >
                <form
                    class="inline-flex gap-2 w-full"
                    @submit.prevent="handleSubmit"
                >
                    <input
                        class="w-full outline-none text-2xl font-bold"
                        placeholder="Type your article title..."
                        v-model="title"
                        required
                    />
                    <button
                        class="flex items-center rounded-md bg-emerald-500 px-4 py-2 text-white font-semibold disabled:opacity-60"
                        :disabled="loading"
                    >
                        <svg
                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            v-if="loading"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                        {{ loading ? "Generating" : "Generate" }}
                    </button>
                </form>
            </div>
            <div
                class="w-full rounded-md bg-white border-2 border-gray-600 p-4 min-h-[720px] h-full text-gray-600"
            >
                <textarea
                    class="min-h-[720px] h-full w-full outline-none"
                    spellcheck="false"
                    v-model="content"
                    readonly
                ></textarea>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";

let title = ref("");
let content = ref("");
let loading = ref(false);

let handleSubmit = () => {
    loading.value = true;
    axios
        .post("/api/chatgpt", {
            title: title.value,
        })
        .then(function (response) {
            loading.value = false;
            title.value = response.data.title;
            content.value = response.data.content;
        })
        .catch(function (error) {
            loading.value = false;
            alert(error.message);
        });
};
</script>
