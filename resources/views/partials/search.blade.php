<div class="searchContainer">

    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <form method="post" class="example searchForm" action="{{ route('search.catalogs') }}" style="margin:auto">
                    @csrf
                    <input type="text" placeholder="{{ trans('index.find_your_catalog') }}"  name="search">
                    <button type="submit">{{ trans('index.search') }}</button>
                </form>
            </div>
        </div>
    </div>

</div>
