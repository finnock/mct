import Vue from 'vue'
import Vuex from 'vuex'
import firstBy from 'thenby'
import parser from '../mtgParser.js'
import { sortingHelper, displayOptionHelper } from '../helperFunctions'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        loading: false,
        cards: [],
        filter: '',
        sortingFunction: 'number',
        direction: 0,
        tieBreaker: 'color',
        displayOptions: {
            hideUnowned: false,
            dimUnowned: true,
            showAmounts: true,
            groupByName: false,
        },
        card: '',
    },
    mutations: {
        initialize (state, payLoad) {
            state.cards = payLoad.cards
        },
        setFilter (state, payLoad) {
            state.filter = payLoad.filter
        },
        setSortingFunction (state, payLoad) {
            state.sortingFunction = payLoad.sortingFunction
        },
        inverseDirection (state) {
            state.direction = ( state.direction == -1 ) ? 0 : -1
        },
        flipDisplayOption (state, { displayOption } ) {
            state.displayOptions[displayOption] = !state.displayOptions[displayOption]
        },
        setCard (state, payLoad) {
            state.card = payLoad.card
        }
    },
    getters: {
        filteredCards: state => {
            try{
                return state.cards
                    .filter(card => parser.parse(state.filter, card))
                    .filter(card => {
                            return displayOptionHelper.hideUnowned(card, state.displayOptions['hideUnowned'])
                    })
                    .sort(
                        firstBy(sortingHelper[state.sortingFunction], state.direction)
                            .thenBy(sortingHelper['color'])
                            .thenBy(sortingHelper['name'])
                    )
            }catch (error){
                console.log(error)
            }
        }
    }
})