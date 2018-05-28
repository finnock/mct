export default {
    color(colorChar) {
        if (colorChar === 'w')
            return 'White';
        if (colorChar === 'u')
            return 'Blue';
        if (colorChar === 'r')
            return 'Red';
        if (colorChar === 'b')
            return 'Black';
        if (colorChar === 'g')
            return 'Green';
    },

    canPay(manaCost, ressource) {
        var reg = /{([0-9WUBRG/]*[WUBRG])}/g;
        var subCost = '';
        while (subCost = reg.exec(manaCost)) {
            var payable = false;
            subCost = subCost[1].split('/');
            for (var i = 0; i < subCost.length; i++) {
                if (_.includes(ressource, subCost[i]))
                    payable = true;
            }
            if (!payable)
                return false;
        }
        return true;
    },
}