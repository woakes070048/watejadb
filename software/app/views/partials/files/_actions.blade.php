
<span style="cursor: pointer"  class="label label-primary" onclick="tryToEdit(this)" url="{{$url1}}" title="Edit This Record" rowid="{{$rId}}">
	<i class="fa fa-edit"></i>
</span>
&nbsp;
<span style="cursor: pointer" class="label label-danger" onclick="tryToDelete(this)" url="{{$url}}" title="Delete This Record" rowid="{{$rId}}">
	<i class="fa fa-trash"></i>
</span>

@include('partials.scripts._dependencies')

@if($config == "business")
<script type="text/javascript">

function tryToDelete(el){

	

		if(Wateja.confirmDialog('Are you sure')){
			var id = (Wateja.getProp(el, 'rowid'));
			var url = $(el).attr('url');
			
			Wateja.getParent(el,2).css('opacity', 0.2);
			Wateja.talkToServer(url, {id:id}).then(function(res){
				Wateja.showFeedBack(regionFBk, res.msg, false);
				Wateja.refreshViewFromServer('regionsArea', '{{route("business.refresh")}}');
			});
		}
	

	
}

function tryToEdit(el){

	var id = (Wateja.getProp(el, 'rowid'));
	var url = $(el).attr('url');
			
	Wateja.getParent(el,2).css('opacity', 0.2);
	Wateja.talkToServer(url, {id:id}).then(function(res){
		$('#manage-area').html(res).hide().fadeIn(); 
	});


}

</script>
@endif

@if($config == 'districts')


@elseif($config == "regions")

<script type="text/javascript">

var editMode = Wateja.edit;

function tryToDelete(el){

	
	if(!editMode){
		if(Wateja.confirmDialog('Are you sure')){
			var id = (Wateja.getProp(el, 'rowid'));
			var url = $(el).attr('url');
			
			Wateja.getParent(el,2).css('opacity', 0.2);
			Wateja.talkToServer(url, {id:id}).then(function(res){
				Wateja.showFeedBack(regionFBk, res.msg, false);
				Wateja.refreshViewFromServer('regionsArea', '{{route("app.configuration.refreshRegions")}}');
			});
		}
	}else{
		if(Wateja.confirmDialog('Are you sure')){
			var id = (Wateja.getProp(el, 'rowid'));
			var url = $(el).attr('url');
			
			Wateja.getParent(el,2).css('opacity', 0.2);
			Wateja.talkToServer(url, {id:id}).then(function(res){
				Wateja.showFeedBack(regionFBk, res.msg, false);
				Wateja.refreshViewFromServer('regionsArea', '{{route("app.configuration.refreshRegions")}}');
				Wateja.refreshViewFromServer('regionFormArea', '{{route("app.configuration.refreshAddRegion")}}');
			});
		}
		
	}

	
}

function tryToEdit(el){

	var id = (Wateja.getProp(el, 'rowid'));
	editMode = true;
	var url = $(el).attr('url');
	Wateja.applyOpacity(regionFormArea);
	Wateja.talkToServer(url, {id:id}, false, 'get').then(function(res){
		Wateja.removeOpacity(regionFormArea);
		$(regionFormArea).html(res).hide().fadeIn();
	});


}

$(function(){

});
</script>

@endif