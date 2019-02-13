
@if(true)
<div class="panel-footer">
    <a><span class="fa fa-caret-down"></span>&nbsp; Expand Comments</a>

    <div class="row">
    	<div class="col-md-12">
    		<img src="{{ Auth::user()->img_url }}">
    	</div>
	    <div class="col-md-12">
	    	<form>
	    		<div class="form-group">
		    		<textarea rows="2" class="form-control"></textarea>
	    		</div>
		    	<button class="btn btn-primary pull-right">Comment</button>
	    	</form>
	    </div>
    </div>
</div>
@endif