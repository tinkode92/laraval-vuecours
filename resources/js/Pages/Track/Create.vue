<template>

    <!--        {{tracks}}-->
    <MusicLayout>

        <template #title>
            Las musicas
        </template>
        <template #action>
            <Link :href="route('tracks.index')">Mon dashboard</Link>
        </template>

        <template #content>

        </template>
    </MusicLayout>


</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import {Link} from "@inertiajs/vue3";
export default {

    name: "Index",
    components:{MusicLayout,Link},
    props: {
        tracks: {
            type:Array,
        },
    },
}
</script>

<style scoped>

</style>
