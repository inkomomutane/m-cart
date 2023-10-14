<script setup lang="ts">
import Modal from "@/Components/Modal.vue";
import { ref, PropType, watch } from "vue";
import UploadImage from "@/Components/UploadImage.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    user : {
        type: Object as PropType<App.Data.UserData>,
        required : true
    }
})

const uploadLogos = ref(false);
const uploadLogosProgress = ref(false);
const form = useForm({ logo: [] });

const uploadLogosTrigger = () => {
    uploadLogos.value = true;
};

const closeUloadLogosModal = () => {
    uploadLogos.value = false;
    uploadLogosProgress.value = false;
    form.reset();
};

const uploadImges = () => {
    if(props.user.id){
        form.post(route("profile.logo.update",{
        user : props.user.id
    }), {
        forceFormData: true,
        onProgress: () => (uploadLogosProgress.value = true),
        onSuccess: () => {
            closeUloadLogosModal();
            form.reset();
        },
    })
    }
};
</script>
<template>
    <button
        type="button"
        @click="uploadLogosTrigger"
        class="flex items-center justify-center text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded text-sm px-4 py-2 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800"
    >
    <svg class="w-[20px] h-[20px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M224,56V178.06l-39.72-39.72a8,8,0,0,0-11.31,0L147.31,164,97.66,114.34a8,8,0,0,0-11.32,0L32,168.69V56a8,8,0,0,1,8-8H216A8,8,0,0,1,224,56Z" opacity="0.2"></path><path d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,16V158.75l-26.07-26.06a16,16,0,0,0-22.63,0l-20,20-44-44a16,16,0,0,0-22.62,0L40,149.37V56ZM40,172l52-52,80,80H40Zm176,28H194.63l-36-36,20-20L216,181.38V200ZM144,100a12,12,0,1,1,12,12A12,12,0,0,1,144,100Z"></path></svg>

        <span class="mx-4">Profile picture upload</span>
    </button>

    <Modal :show="uploadLogos" @close="closeUloadLogosModal">
        <div class="relative bg-white rounded shadow dark:bg-gray-700">
            <button
                type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                @click="closeUloadLogosModal"
            >
                <svg
                    aria-hidden="true"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8 h-full">
                <UploadImage
                    @update:images="(files : any) => form.logo = files"
                    :uploader="uploadImges"
                    :multiple="false"
                    :disabledUpload="false"
                    :disabledCancel="false"
                    mediaType="image/*"
                    :progressUploadImage="uploadLogosProgress"
                />
            </div>
        </div>
    </Modal>
</template>
