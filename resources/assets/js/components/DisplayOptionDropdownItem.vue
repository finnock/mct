<template>
    <a class="dropdown-item" v-bind:class="mctClass" href="#" v-on:click="mutateDisplayOption">
        <i class="fa mr-2" :class="displayClass"></i>
        <slot>{{ displayOption }}</slot>
    </a>
</template>

<script>
    import {mapState, mapMutations} from 'vuex'

    export default {
        data: function () {
            return {}
        },
        props: [
            'displayOption',
            'mctClass',
        ],
        computed: {
            ... mapState(['displayOptions']),
            displayClass: function () {
                return (this.displayOptions[this.displayOption]) ? 'fa-check-square-o' : 'fa-square-o'
            }
        },
        methods: {
            ... mapMutations(['flipDisplayOption']),
            ... {
                mutateDisplayOption: function (event) {
                    event.preventDefault()
                    this.flipDisplayOption({
                        displayOption: this.displayOption
                    })
                }
            }
        }
    }
</script>