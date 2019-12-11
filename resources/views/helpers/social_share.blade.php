<div class="share-icons">
    <a class="social-media-link"
       href="http://vk.com/share.php?url={{ asset($list->domain) }}&title={{ $list->title }}"
       target="_blank">
        <img src="https://vk.com/images/share_32.png" title="Вконтакте">
    </a>
    <a class="social-media-link"
       href="https://connect.ok.ru/offer?url={{ asset($list->domain) }}&title={{ $list->title }}"
       target="_blank">
        <img src="{{ asset('/images/social-media/ok.png') }}">
    </a>
    <input class="close material-icons" type="button" value="close"
           title="Закрыть">
</div>
