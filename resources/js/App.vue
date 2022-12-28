<template>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0"
    >
        <div class="max-w-6xl w-full mx-auto sm:px-6 lg:px-8 space-y-4 py-4">
            <div class="text-center text-gray-800 dark:text-gray-300 py-4">
                <h1 class="text-7xl font-bold">ChatBot</h1>
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
                        <svg
                            v-else
                            class="-ml-1 mr-3 h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            stroke="currentColor"
                        >
                            <path
                                fill="currentColor"
                                d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"
                            />
                        </svg>

                        {{ loading ? "Asking" : "Ask" }}
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
            content.value = response.data.content;
        })
        .catch(function (error) {
            loading.value = false;
            alert(error.message);
        });
};
</script>
