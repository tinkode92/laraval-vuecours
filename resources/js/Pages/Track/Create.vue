<template>
    <MusicLayout>
        <template #title> Musiques </template>

        <template #action>
            <Link :href="route('tracks.index')"> Retour </Link>
        </template>
        <template #content>
            <form @submit="submit">
                <div class="mb-3">
                    <label
                        class="mt-6 block text-gray-700 text-sm font-bold mb-2"
                        for="title"
                    >
                        Titre
                    </label>
                    <input
                        id="title"
                        v-model="form.title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': form.errors.title }"
                        type="text"
                        placeholder="Title"
                    />
                    <p class="text-red-500 text-xs italic">
                        {{ form.errors.title }}
                    </p>

                    <label
                        class="mt-6 block text-gray-700 text-sm font-bold mb-2"
                        for="artist"
                    >
                        Artist
                    </label>
                    <input
                        id="artist"
                        v-model="form.artist"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': form.errors.artist }"
                        type="text"
                        placeholder="Artist"
                    />
                    <p class="text-red-500 text-xs italic">
                        {{ form.errors.artist }}
                    </p>

                    <label
                        class="mt-6 block text-gray-700 text-sm font-bold mb-2"
                        for="image"
                    >
                        Image
                    </label>
                    <input
                        id="image"
                        name="image"
                        @input="form.image = $event.target.files[0]"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': form.errors.image }"
                        type="file"
                        placeholder="Image"
                    />
                    <p class="text-red-500 text-xs italic">
                        {{ form.errors.image }}
                    </p>

                    <label
                        class="mt-6 block text-gray-700 text-sm font-bold mb-2"
                        for="music"
                    >
                        Music
                    </label>
                    <input
                        id="music"
                        @input="form.music = $event.target.files[0]"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        :class="{ 'border-red-500': form.errors.music }"
                        type="file"
                        placeholder="music"
                    />
                    <p class="text-red-500 text-xs italic">
                        {{ form.errors.music }}
                    </p>

                    <label
                        class="mt-6 block text-gray-700 text-sm font-bold mb-2"
                        for="display"
                    >
                        Display
                    </label>

                    <select v-model="form.display" name="display" id="display">
                        <option disabled value="">Choisissez</option>
                        <option :value="true">On</option>
                        <option :value="false">Off</option>
                    </select>

                    <p class="text-red-500 text-xs italic">
                        {{ form.errors.display }}
                    </p>

                    <button
                        @click.prevent="submit"
                        class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Submit
                    </button>
                </div>

                {{ form.errors }}
            </form>
        </template>
    </MusicLayout>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import MusicLayout from "@/Layouts/MusicLayout.vue";

export default {
    components: {
        MusicLayout,
        Link,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: "",
                artist: "",
                image: null,
                music: null,
                display: true,
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route("tracks.store"));
        },
    },
};
</script>

<style></style>
