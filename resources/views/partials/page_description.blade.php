@if(!empty($page_description))
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{!! $page_description->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endif