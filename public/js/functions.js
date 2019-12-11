let add_gift_button = document.getElementById('add_gift');
let copiers = document.querySelectorAll('.copy-icon');
let giftRemovers = document.querySelectorAll('.gifts_edit input.delete');
let giftEditors = document.querySelectorAll('.gifts_edit input.edit');
let csrf = document.querySelector('[name="csrf-token"]').getAttribute('content');
let share_icon = document.querySelectorAll('.share-icon');
let close_share = document.querySelectorAll('.share-icons .close');
let suggest = document.querySelector('#suggest');
let popup_suggestion = document.querySelector('.suggestion');
let add_suggestion = document.querySelector('.button.add');
let close_suggestion = document.querySelector('#close_suggestion');
let update_suggestion = document.querySelector('.button.another');
let instruction = document.querySelector('#instruction');

//Suggest a gift
if (suggest !== null) {
    suggest.addEventListener('click', function () {

        let action = function () {
            popup_suggestion.style.display = 'block';
            setTimeout(function () {
                popup_suggestion.style.opacity = '1';
            }, 100);
        }

        updateSuggestion(action);

    });
}

if (add_suggestion !== null) {
    add_suggestion.addEventListener('click', function () {
        let gift_name = popup_suggestion.querySelector('h2').innerHTML;
        addGift(gift_name);
    });
}


if (close_suggestion !== null) {
    close_suggestion.addEventListener('click', function () {
        popup_suggestion.style.opacity = '0';
        setTimeout(function () {
            popup_suggestion.style.display = 'none';
        }, 1000);
    });
}

if (update_suggestion !== null) {
    update_suggestion.addEventListener('click', function () {
        updateSuggestion();
    });
}

//Add gift button
if (add_gift_button !== null) {
    add_gift_button.addEventListener('click', function () {
        let gift_name = this.parentNode.querySelector('.gift_name').value;
        addGift(gift_name);
    });
}

//Share social media popup window
let current_social_popup;

share_icon.forEach(function (elem) {
    elem.addEventListener('click', function () {

        if (current_social_popup !== undefined) {
            current_social_popup.style.opacity = '0';
            current_social_popup.style.display = 'none';
        }

        let share_icons = this.parentNode.querySelector('.share-icons');
        current_social_popup = share_icons;
        share_icons.style.display = 'block';
        setTimeout(function () {
            share_icons.style.opacity = '1';
        }, 100);
    });
});

//Close social media popup window
close_share.forEach(function (elem) {
    elem.addEventListener('click', function() {
        let popup = this.parentNode;
        popup.style.opacity = '0';
        setTimeout(function () {
            popup.style.display = 'none';
        }, 1000);
    });
});

// Copy link to clipboard
copiers.forEach(function (elem) {
    elem.addEventListener('click', function() {
        let section = this.parentNode;
        let text = section.querySelector('input[type="text"]');
        text.select();
        text.setSelectionRange(0, 99999);

        document.execCommand("copy");

        this.style.color = 'yellowgreen';
    });
});

//Delete gift
giftRemovers.forEach(function(elem) {
    elem.addEventListener('click', function() {
        let gift = this.parentNode.parentNode;
        let id = gift.querySelector('input[name="id"]').value;

        let ajax = new XMLHttpRequest();
        ajax.open('DELETE', '/gift/' + id, true);
        ajax.setRequestHeader('X-CSRF-TOKEN', csrf);
        ajax.send();

        ajax.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200 && this.responseText === 'OK') {
                gift.remove();
            }
        };
    });
});

//Modify a gift name
giftEditors.forEach(function(elem) {
    elem.addEventListener('click', function() {
        let gift = this.parentNode.parentNode;
        let id = gift.querySelector('input[name="id"]').value;
        let name = gift.querySelector('input[name="name"]').value;
        let formData = new FormData;

        formData.append('name', name);
        formData.append('_method', 'PATCH');

        let ajax = new XMLHttpRequest();
        ajax.open('POST', '/gift/' + id, true);
        ajax.setRequestHeader('X-CSRF-TOKEN', csrf);
        ajax.send(formData);
    });
});

//Show/hide Instruction
if (instruction !== null) {
    instruction.addEventListener('click', function () {
        let block = document.querySelector('.description');
        let height = block.style.height;
        if (height === 'auto') {
            block.style.height = '0';
        } else {
            block.style.height = 'auto';
        }
    });
}

function addGift(gift_name) {
    let list_id = document.querySelector('input[name="list_id"]').value;

    let formData = new FormData;
    formData.append('name', gift_name);

    let ajax = new XMLHttpRequest();
    ajax.open('POST', '/' + list_id + '/gift', true);
    ajax.setRequestHeader('X-CSRF-TOKEN', csrf);
    ajax.send(formData);

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200 && this.responseText === 'OK') {
            let ajax = new XMLHttpRequest();
            ajax.open('GET', '/lists/' + list_id, true);
            ajax.send();
            ajax.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    let table = document.getElementById('gifts_edit');
                    table.innerHTML = this.responseText;
                }
            }
        }
    };
}

function updateSuggestion(callback = function () {}) {
    let ajax = new XMLHttpRequest();
    ajax.open('GET', '/suggestion', true);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let suggestion = this.responseText;

            let suggested_gift = popup_suggestion.querySelector('h2');
            suggested_gift.innerHTML = suggestion;

            callback();
        }
    };
}
