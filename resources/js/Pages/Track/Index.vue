<template>

<!--        {{tracks}}-->
    <MusicLayout>

        <template #title>Musiques</template>
        <template #action>
        <Link :href="route('tracks.create')">Ma musique</Link>
        </template>
        <template #content>
            <div>
                <ul>
                    <li v-for="track in tracks" :key="track.uuid" :class="[track.id % 2 ? 'text-red-500' : 'text-green-500']">{{track.title}}</li>
                </ul>
            </div>
        </template>
    </MusicLayout>


</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import {Link} from '@inertiajs/vue3'

export default {

    name: "Index",
    components:{MusicLayout, Link},
    props: {
        tracks: {
            type:Array,
        },
    },
}
</script>

<style scoped>

</style>
