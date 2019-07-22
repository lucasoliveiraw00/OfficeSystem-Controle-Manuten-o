
// INICIO MASK IPUNT VERIFICAÇÃO DE HORA
var mask = function (val) {
    val = val.split(":");
    return (parseInt(val[0]) > 19)? "HZ:M0:S0" : "H0:M0:S0";
}

pattern = {
    onKeyPress: function(val, e, field, options) {
        field.mask(mask.apply({}, arguments), options);
    },
    translation: {
        'H': { pattern: /[0-2]/, optional: false },
        'Z': { pattern: /[0-3]/, optional: false },
        'M': { pattern: /[0-5]/, optional: false},
        'S': { pattern: /[0-5]/, optional: false}
    },
    placeholder: "00:00:00"
};

// FIM MASK IPUNT VERIFICAÇÃO DE HORA

