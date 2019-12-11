let gifts = document.querySelectorAll('input[type="button"]');

//Gift list add event listener
gifts.forEach(function (gift) {
    gift.addEventListener('click', function () {

        let id = this.parentNode.querySelector('input[name="id"]').value;
        let gift = this.parentNode.parentNode;
        let comment = gift.querySelector('input[name="comment"]');

        let formData = new FormData;
        if (comment) {
            comment = comment.value;
            formData.append('comment', comment);
        }
        formData.append('id', id);

        let ajax = new XMLHttpRequest();
        ajax.open('POST', '/gift_choose', true);
        ajax.send(formData);

        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
                if (this.responseText === 'chosen') {
                    let error = document.createElement('div');
                    error.className = 'error';
                    error.innerHTML = '<div>Вы уже выбрали подарок!</div>';
                    document.body.appendChild(error);
                    error.addEventListener('click', function () {
                        this.remove();
                    });
                } else {
                    gift.innerHTML = this.responseText;
                }
            }
        };

    });
});
