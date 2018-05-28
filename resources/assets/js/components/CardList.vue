<template>
    <div class="row">
        <div class="col-lg-12 text-center">

            <i v-if="loading" class="ss ss-zen ss-5x fa-spin"></i>
            <div v-if="!loading" class="d-flex flex-wrap justify-content-between">
                <div class="mct-card" v-for="card in cards">
                    <a target="_blank" :href="card.directLink">
                        <div v-if="((card.count > 1) && displayOptions.showAmounts)">
                            <img v-for="n in (card.count - 1)" class="mct-image" :src="card.imagePathBar" style="display: block;">
                        </div>
                        <div style="position: relative;">
                            <img class="mct-image" :src="card.imagePath" v-bind:class="{'fade-out': (!card.count && displayOptions.dimUnowned)}">
                        </div>
                    </a>
                </div>
                <div style="width: 220px; height: 0; margin: 5px 3px;" v-for="n in 10"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex'

    export default {
        computed: {
            ... mapGetters({
               cards: 'filteredCards'
            }),
            ... mapState([
                'displayOptions',
                'loading'
            ])
        }
    }
</script>