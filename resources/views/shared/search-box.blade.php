<div x-data="{
    query: '{{ request('search','') }}'
}" class="block-filters__search-input">
    <input type="text" class="block-filters__input" placeholder="Поиск" name="search"
        x-model="query"
        onkeydown="if(event.key == 'Enter'){document.querySelector('.block-filters__input-search').click()}">
    <button aria-label="Поиск" class="block-filters__input-search"
        x-on:click="$dispatch('search',{
            search : query
        })">
        <svg class="search"><use xlink:href="#search"></use></svg>
    </button>
</div>
