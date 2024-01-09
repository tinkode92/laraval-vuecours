<template>
    <MusicLayout>
        <template #title> Musiques </template>

        <template #action>
            <div>
                <input
                    v-model="search"
                    type="text"
                    name="search"
                    placeholder="search"
                />
            </div>
            <Link :href="route('tracks.create')"> Créer une musique </Link>
        </template>

        <template #content>
            <div class="card__section">
                <div class="card__container">
                    <div
                        v-for="track in filteredTracks"
                        :key="track.uuid"
                        class="card"
                        @click="play(track)"
                    >
                        <div class="image__container">
                            <img :src="'/storage/' + track.image" alt="test" />
                        </div>
                        <div class="card__description">
                            <div class="flex_illustration">
                                <div class="svg__illustration"></div>
                                <h3>{{ track.title }}</h3>
                            </div>
                            <p>{{ track.artist }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        MusicLayout,
        Link,
    },
    props: {
        tracks: {
            type: Array,
        },
    },
    data() {
        return {
            search: "",
            audio: null,
            currentTrack: null,
        };
    },
    computed: {
        filteredTracks() {
            return this.tracks.filter(
                (track) =>
                    track.title
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    track.artist
                        .toLowerCase()
                        .includes(this.search.toLowerCase())
            );
        },
    },
    methods: {
        play(track) {
            const url = "/storage/" + track.music;

            if (!this.currentTrack) {
                this.audio = new Audio(url);
                this.audio.play();
            } else if (this.currentTrack !== track.uuid) {
                this.audio.pause();
                this.audio.src = url;
                this.audio.play();
            } else if (!this.audio.paused) {
                this.audio.pause();
            } else {
                this.audio.play();
            }

            this.currentTrack = track.uuid;
        },
    },
};
</script>
<style>
.card__section {
    margin-top: 100px;
}

.card__container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
}

.card {
    padding: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    justify-content: left;

    width: 250px;
    height: 250px;
    border-radius: 15px;
    border: solid 1px rgb(47, 62, 84);
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 15px 0px;

    transition: ease-in-out 0.2s;

    &:hover {
        box-shadow: rgba(54, 54, 60, 0.337) 0px 7px 20px 0px;
        transition: ease-in-out 0.2s;
    }
}

.image__container {
    position: relative;
    width: 100px;
    height: 100px;
}

.image__container img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.flex_illustration {
    display: flex;
    justify-content: center;
    align-items: first baseline;
    gap: 10px;
}

.svg__illustration {
    width: 5px;
    height: 5px;
    border-radius: 10px;
    background-color: rgb(47, 62, 84);
}

.card__description {
    margin-top: 20px;
}

.flex_illustration h3 {
    font-size: 18px;
    font-weight: 600;
}

.card__description p {
    font-size: 14px;
    font-weight: 400;
}
</style>
