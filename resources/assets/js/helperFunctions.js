
import firstBy from 'thenby'

export const sortingHelper = {
    number (cardA, cardB) {
        return (parseInt(cardA.number) - parseInt(cardB.number));
    },

    cmc (cardA, cardB) {
        return (parseInt(cardA.cmcSort) - parseInt(cardB.cmcSort));
    },

    none (cardA, cardB) {
        return 0;
    },

    color (cardA, cardB) {
        return (sf_sortColor_colorValueAssign(cardA) - sf_sortColor_colorValueAssign(cardB));
    },

    name: 'name',
}

export const displayOptionHelper = {
    hideUnowned (card, hide) {
        return  card.count || !hide
    }
}

function sf_sortColor_colorValueAssign(card) {
    if ('colors' in card.meta) {
        if (card.meta.colors.length == 1) {
            if (_.includes(card.meta.colors, 'White')) {
                return 0;
            }
            if (_.includes(card.meta.colors, 'Blue')) {
                return 1;
            }
            if (_.includes(card.meta.colors, 'Black')) {
                return 2;
            }
            if (_.includes(card.meta.colors, 'Red')) {
                return 3;
            }
            if (_.includes(card.meta.colors, 'Green')) {
                return 4;
            }
        }
        if (card.meta.colors.length == 2) {
            if (_.includes(card.meta.colors, 'White') && _.includes(card.meta.colors, 'Blue')) {
                return 5;
            }
            if (_.includes(card.meta.colors, 'Blue') && _.includes(card.meta.colors, 'Black')) {
                return 6;
            }
            if (_.includes(card.meta.colors, 'Black') && _.includes(card.meta.colors, 'Red')) {
                return 7;
            }
            if (_.includes(card.meta.colors, 'Red') && _.includes(card.meta.colors, 'Green')) {
                return 8;
            }
            if (_.includes(card.meta.colors, 'Green') && _.includes(card.meta.colors, 'White')) {
                return 9;
            }

            if (_.includes(card.meta.colors, 'White') && _.includes(card.meta.colors, 'Black')) {
                return 10;
            }
            if (_.includes(card.meta.colors, 'Blue') && _.includes(card.meta.colors, 'Red')) {
                return 11;
            }
            if (_.includes(card.meta.colors, 'Black') && _.includes(card.meta.colors, 'Green')) {
                return 12;
            }
            if (_.includes(card.meta.colors, 'Red') && _.includes(card.meta.colors, 'White')) {
                return 13;
            }
            if (_.includes(card.meta.colors, 'Green') && _.includes(card.meta.colors, 'Blue')) {
                return 14;
            }
        }
        if (card.meta.colors.length >= 3) {
            return 15;
        }
    } else {
        if (_.includes(card.meta.types, 'Land')) {
            return 17;
        } else {
            return 16;
        }
    }
}