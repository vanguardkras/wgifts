<div class="share-icons">
    <div>

        {{-- Only for russian Social media --}}
        @if(app()->getLocale() === 'ru')
            <a class="social-media-link"
               href="http://vk.com/share.php?url={{ asset($list->domain) }}&title={{ $list->title }}"
               target="_blank">
                <img src="https://vk.com/images/share_32.png" title="VK">
            </a>
            <a class="social-media-link"
               href="https://connect.ok.ru/offer?url={{ asset($list->domain) }}&title={{ $list->title }}"
               target="_blank">
                <img src="{{ asset('/images/social-media/ok.png') }}">
            </a>
        @endif

        <a class="social-media-link"
           href="https://www.facebook.com/sharer/sharer.php?u={{ asset($list->domain) }}&t={{ $list->title }}"
           target="_blank">
            <img src="{{ asset('/images/social-media/facebook.png') }}" title="facebook">
        </a>
        <a class="social-media-link"
           href="https://twitter.com/share?url={{ asset($list->domain) }}&text={{ $list->title }}"
           target="_blank">
            <img src="{{ asset('/images/social-media/twitter.png') }}" title="twitter">
        </a>

        <input class="close material-icons" type="button" value="close"
               title="@lang('buttons.close')">
    </div>
</div>
