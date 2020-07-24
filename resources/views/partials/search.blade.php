<div class="searchContainer">

    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <form method="post" class="example searchForm" action="{{ route('search.catalogs') }}" style="margin:auto">
                    @csrf
                    <input type="text" placeholder="Find your catalog"  name="search">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

</div>
