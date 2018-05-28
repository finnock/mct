<template>
    <a class="dropdown-item" href="#" v-bind:class="{ active: isActive }" v-on:click="mutateSortingFunction">
        <i class="fa mr-2" :class="searchClass"></i>
        <slot>{{ search }}</slot>
    </a>
</template>

<script>
    import {mapState, mapMutations} from 'vuex'

    export default {
        data: function () {
            return {}
        },
        props: [
            'search'
        ],
        computed: {
            searchClass: function () {
                if (this.isActive) {
                    if (store.state.direction == '-1') {
                        return 'fa-arrow-circle-up'
                    } else {
                        return 'fa-arrow-circle-down'
                    }
                } else {
                    return 'fa-circle-o'
                }
            },
            isActive: function () {
                return (store.state.sortingFunction == this.search)
            }
        },
        methods: {
            ... mapMutations(['setSortingFunction', 'inverseDirection']),
            ... {
                mutateSortingFunction: function (event) {
                    event.preventDefault()
                    if (this.isActive) {
                        this.inverseDirection()
                    } else {
                        this.setSortingFunction({
                            sortingFunction: this.search
                        })
                    }
                }
            }
        }
    }
</script>