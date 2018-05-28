<template>
    <div class="form-inline">
        <div class="input-group">
            <input class="form-control" placeholder="Filter" v-model="filterString" v-on:keyup.enter="mutateFilter">
            <div class="input-group-append">
                <button type="button" class="btn btn-dark dropdown-toggle no-carret" data-toggle="dropdown">
                    <i class="fa fa-sort-amount-desc"></i>
                </button>
                <div class="dropdown-menu">
                    <h6 class="dropdown-header">Sorting Options</h6>
                    <sorting-dropdown-item search="number">Number</sorting-dropdown-item>
                    <sorting-dropdown-item search="color">Color</sorting-dropdown-item>
                    <sorting-dropdown-item search="name">Name</sorting-dropdown-item>
                    <sorting-dropdown-item search="cmc">Converted Mana Cost</sorting-dropdown-item>

                    <h6 class="dropdown-header">Tie Breaker</h6>
                    <a class="dropdown-item disabled" href="#">Color, Name</a>
                </div>
            </div>
            <div class="input-group-append">
                <button type="button" class="btn btn-dark dropdown-toggle no-carret" data-toggle="dropdown">
                    <i class="fa fa-gear"></i>
                </button>
                <div class="dropdown-menu">
                    <h6 class="dropdown-header">Display Options</h6>
                    <display-option-dropdown-item display-option="hideUnowned">Hide Unowned Cards</display-option-dropdown-item>
                    <display-option-dropdown-item display-option="dimUnowned">Dim Unowned Cards</display-option-dropdown-item>
                    <display-option-dropdown-item display-option="showAmounts">Show Amounts</display-option-dropdown-item>
                    <display-option-dropdown-item display-option="groupByName" mct-class="disabled">Group Cards by Name</display-option-dropdown-item>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapMutations} from 'vuex'
    import SortingDropdownItem from './SortingDropdownItem.vue'
    import DisplayOptionDropdownItem from './DisplayOptionDropdownItem.vue'

    export default {
        data: function () {
            return {
                filterString: '',
            }
        },
        computed: {
            ... mapState (['filter']),
        },
        methods: {
            ... mapMutations (['setFilter']),
            ... {
                mutateFilter: function () {
                    this.setFilter({
                        filter: this.filterString
                    })
                }
            }
        },
        components: {
            SortingDropdownItem,
            DisplayOptionDropdownItem
        }
    }
</script>

<style>

    .dropdown-menu {
        left: initial;
        right: 0; /* add right with 0 or a low pixel value */
    }

    .no-carret::after {
        display: none;
    }
</style>