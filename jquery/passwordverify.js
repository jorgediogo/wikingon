window.passwordverify = window.passwordverify || {};
passwordverify.password = {
    'defaults' : {
        'displayMinChar': true,
        'minChar': 6,
        'minCharText': 'Deve introduzir pelo menos %d caracteres',
        'colors': ["#f00", "#c06", "#f60", "#3c0", "#3f0"],
        'scores': [20, 30, 43, 50],
        'verdicts': ['Fraca', 'Normal', 'Media', 'Forte', 'Muito Forte'],
        'raisePower': 1.4,
        'debug': false
    },
    'ruleScores' : {
        'length': 0,
        'lowercase': 1,
        'uppercase': 3,
        'one_number': 3,
        'three_numbers': 5,
        'one_special_char': 3,
        'two_special_char': 5,
        'upper_lower_combo': 2,
        'letter_number_combo': 2,
        'letter_number_char_combo': 2
    },
    'rules' : {
        'length': true,
        'lowercase': true,
        'uppercase': true,
        'one_number': true,
        'three_numbers': true,
        'one_special_char': true,
        'two_special_char': true,
        'upper_lower_combo': true,
        'letter_number_combo': true,
        'letter_number_char_combo': true
    },
    'validationRules': {
        'length': function (word, score) {
            passwordverify.password.tooShort = false;
            var wordlen = word.length;
            var lenScore = Math.pow(wordlen, passwordverify.password.options.raisePower);
            if (wordlen < passwordverify.password.options.minChar) {
                lenScore = (lenScore - 100);
                passwordverify.password.tooShort = true;
            }
            return lenScore;
        },
        'lowercase': function (word, score) {
            return word.match(/[a-z]/) && score;
        },
        'uppercase': function (word, score) {
            return word.match(/[A-Z]/) && score;
        },
        'one_number': function (word, score) {
            return word.match(/\d+/) && score;
        },
        'three_numbers': function (word, score) {
            return word.match(/(.*[0-9].*[0-9].*[0-9])/) && score;
        },
        'one_special_char': function (word, score) {
            return word.match(/.[!,@,#,$,%,\^,&,*,?,_,~]/) && score;
        },
        'two_special_char': function (word, score) {
            return word.match(/(.*[!,@,#,$,%,\^,&,*,?,_,~].*[!,@,#,$,%,\^,&,*,?,_,~])/) && score;
        },
        'upper_lower_combo': function (word, score) {
            return word.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/) && score;
        },
        'letter_number_combo': function (word, score) {
            return word.match(/([a-zA-Z])/) && word.match(/([0-9])/) && score;
        },
        'letter_number_char_combo' : function (word, score) {
            return word.match(/([a-zA-Z0-9].*[!,@,#,$,%,\^,&,*,?,_,~])|([!,@,#,$,%,\^,&,*,?,_,~].*[a-zA-Z0-9])/) && score;
        }
    },
    'attachWidget': function (element) {
        var output = ['<div id="password-strength">'];
        if (passwordverify.password.options.displayMinChar && !passwordverify.password.tooShort) {
            output.push('<span class="password-min-char">' + passwordverify.password.options.minCharText.replace('%d', passwordverify.password.options.minChar) + '</span>');
        }
        output.push('<span class="password-strength-bar"></span>');
        output.push('</div>');
        output = output.join('');
        jQuery(element).after(output);
    },
    'debugOutput': function (element) {
        if (typeof console.log === 'function') {
            console.log(passwordverify.password);
        }
        else {
            alert(passwordverify.password);
        }
    },
    'addRule': function (name, method, score, active) {
        passwordverify.password.rules[name] = active;
        passwordverify.password.ruleScores[name] = score;
        passwordverify.password.validationRules[name] = method;
        return true;
    },
    'init': function (element, options) {
        passwordverify.password.options = jQuery.extend({}, passwordverify.password.defaults, options);
        passwordverify.password.attachWidget(element);
        jQuery(element).keyup(function () {
            passwordverify.password.calculateScore(jQuery(this).val());
        });
        if (passwordverify.password.options.debug) {
            passwordverify.password.debugOutput();
        }
    },
    'calculateScore': function (word) {
        passwordverify.password.totalscore = 0;
        passwordverify.password.width = 0;
        for (var key in passwordverify.password.rules)
            if (passwordverify.password.rules.hasOwnProperty(key)) {
            if (passwordverify.password.rules[key] === true) {
                var score = passwordverify.password.ruleScores[key];
                var result = passwordverify.password.validationRules[key](word, score);
                if (result) {
                    passwordverify.password.totalscore += result;
                }
            }
            if (passwordverify.password.totalscore <= passwordverify.password.options.scores[0]) {
                passwordverify.password.strColor = passwordverify.password.options.colors[0];
                passwordverify.password.strText = passwordverify.password.options.verdicts[0];
                passwordverify.password.width =  "1";
            }
            else
                if (passwordverify.password.totalscore > passwordverify.password.options.scores[0] && passwordverify.password.totalscore <= passwordverify.password.options.scores[1]) {
                    passwordverify.password.strColor = passwordverify.password.options.colors[1];
                    passwordverify.password.strText = passwordverify.password.options.verdicts[1];
                    passwordverify.password.width =  "25";
                }
                else
                    if (passwordverify.password.totalscore > passwordverify.password.options.scores[1] && passwordverify.password.totalscore <= passwordverify.password.options.scores[2]) {
                        passwordverify.password.strColor = passwordverify.password.options.colors[2];
                        passwordverify.password.strText = passwordverify.password.options.verdicts[2];
                        passwordverify.password.width =  "50";
                    }
                    else
                        if (passwordverify.password.totalscore > passwordverify.password.options.scores[2] && passwordverify.password.totalscore <= passwordverify.password.options.scores[3]) {
                            passwordverify.password.strColor = passwordverify.password.options.colors[3];
                            passwordverify.password.strText = passwordverify.password.options.verdicts[3];
                            passwordverify.password.width =  "75";
                        }
                        else {
                            passwordverify.password.strColor = passwordverify.password.options.colors[4];
                            passwordverify.password.strText = passwordverify.password.options.verdicts[4];
                            passwordverify.password.width =  "99";
                        }
            jQuery('.password-strength-bar').stop();

            if (passwordverify.password.options.displayMinChar && !passwordverify.password.tooShort) {
                jQuery('.password-min-char').hide();
            }
            else {
                jQuery('.password-min-char').show();
            }

            jQuery('.password-strength-bar').animate({opacity: 0.5}, 'fast', 'linear', function () {
                jQuery(this).css({'display': 'block', 'background-color': passwordverify.password.strColor, 'width': passwordverify.password.width + "%"}).text(passwordverify.password.strText);
                jQuery(this).animate({opacity: 1}, 'fast', 'linear');
            });
        }
    }
};

jQuery.extend(jQuery.fn, {
    'pstrength': function (options) {
        return this.each(function () {
            passwordverify.password.init(this, options);
        });
    }
});
jQuery.extend(jQuery.fn.pstrength, {
    'addRule': function (name, method, score, active) {
        passwordverify.password.addRule(name, method, score, active);
        return true;
    },
    'changeScore': function (rule, score) {
        passwordverify.password.ruleScores[rule] = score;
        return true;
    },
    'ruleActive': function (rule, active) {
        passwordverify.password.rules[rule] = active;
        return true;
    }
});