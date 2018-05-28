<template>
    <div>
        <img style="width: 100%" src="{{ $card->imagePath() }}">
    </div>
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
            ... mapState(['card']),
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