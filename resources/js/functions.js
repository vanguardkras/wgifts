let add_gift_button = document.getElementById('add_gift');
let csrf = document.querySelector('[name="csrf-token"]').getAttribute('content');
let share_icon = document.querySelectorAll('.share-icon');
let close_share = document.querySelectorAll('.share-icons .close');
let suggest = document.querySelector('#suggest');
let popup_suggestion = document.querySelector('.suggestion_box');
let add_suggestion = document.querySelector('.button.add');
let close_suggestion = document.querySelector('#close_suggestion');
let update_suggestion = document.querySelector('.button.another');
let preview = document.querySelectorAll('input.eye');
let close_preview = document.querySelector('.close_preview');

reloadGiftList();

let reload = false;

//Check if you need to show preview right away
let urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('reload') === '1') {
    loadPreview();
}

//Preview
preview.forEach(function (elem) {
    elem.addEventListener('click', function () {
        if (reload) {
            document.location.href = '?reload=1';
            return;
        }

        loadPreview(elem);
    });
});


function loadPreview(elem = false) {
    let block = elem ? elem.parentNode : document;
    let preview_block = block.querySelector('.preview');

    preview_block.style.display = 'block';
    close_preview.style.display = 'block';
    setTimeout(function () {
        preview_block.style.opacity = '1';
    }, 200);
    setTimeout(function () {
        close_preview.style.opacity = '1';
    }, 200);
}

//Close preview
if (close_preview !== null) {
    close_preview.addEventListener('click', function () {
        close_preview.style.opacity = '0';
        setTimeout(function () {
            close_preview.style.display = 'none';
        }, 700);

        let preview_windows = document.querySelectorAll('.preview');
        preview_windows.forEach(function (elem) {
            elem.style.opacity = '0';
            setTimeout(function () {
                elem.style.display = 'none';
            }, 700);
        });
    });
}

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
        let gift_input = this.parentNode.querySelector('.gift_name');
        let gift_name = gift_input.value;
        addGift(gift_name);
        gift_input.value = '';
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
    elem.addEventListener('click', function () {
        let popup = this.parentNode.parentNode;
        popup.style.opacity = '0';
        setTimeout(function () {
            popup.style.display = 'none';
        }, 1000);
    });
});

function addGift(gift_name) {

    let list_id = isAuth ? document.querySelector('input[name="list_id"]').value : '';

    let formData = new FormData;
    formData.append('name', gift_name);

    let ajax = new XMLHttpRequest();
    let address = isAuth ? '/' + list_id + '/gift' : '/create_gift';

    ajax.open('POST', address, true);
    ajax.setRequestHeader('X-CSRF-TOKEN', csrf);
    ajax.send(formData);

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200 && this.responseText === 'OK') {
                let ajax = new XMLHttpRequest();
                let table = document.getElementById('gifts_edit');
                let address = isAuth ? '/lists/' + list_id : '/get_gifts';

                ajax.open('GET', address, true);
                ajax.send();
                ajax.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        table.innerHTML = this.responseText;
                        reloadGiftList();
                        reload = true;
                    }
                }
        }
    };
}

function updateSuggestion(callback = function () {
}) {
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

function reloadGiftList() {
    let copiers = document.querySelectorAll('.copy-icon');
    let giftRemovers = document.querySelectorAll('.gifts_edit input.delete');
    let giftEditors = document.querySelectorAll('.gifts_edit input.edit');

    // Copy link to clipboard
    copiers.forEach(function (elem) {
        elem.addEventListener('click', function () {
            let section = this.parentNode;
            let text = section.querySelector('input[type="text"]');
            text.select();
            text.setSelectionRange(0, 99999);

            document.execCommand("copy");

            this.style.color = 'yellowgreen';
        });
    });

    //Delete gift
    giftRemovers.forEach(function (elem) {
        elem.addEventListener('click', function () {
            let gift = this.parentNode.parentNode;
            let id = gift.querySelector('input[name="id"]').value;
            let address = isAuth ? '/gift/' + id : '/delete_gift/' + id;

            let ajax = new XMLHttpRequest();
            ajax.open('DELETE', address, true);
            ajax.setRequestHeader('X-CSRF-TOKEN', csrf);
            ajax.send();

            ajax.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200 && this.responseText === 'OK') {
                    gift.remove();
                    reload = true;
                }
            };
        });
    });

    //Modify a gift name
    giftEditors.forEach(function (elem) {
        elem.addEventListener('click', function () {
            let gift = this.parentNode.parentNode;
            let id = gift.querySelector('input[name="id"]').value;
            let name = gift.querySelector('input[name="name"]').value;
            let address = isAuth ? '/gift/' + id : 'update_gift';
            let formData = new FormData;

            formData.append('name', name);
            if (!isAuth) {
                formData.append('id', id);
            }
            formData.append('_method', 'PATCH');

            let ajax = new XMLHttpRequest();
            ajax.open('POST', address, true);
            ajax.setRequestHeader('X-CSRF-TOKEN', csrf);
            ajax.send(formData);
            reload = true;
        });
    });
}
