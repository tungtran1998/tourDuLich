<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{trans('admin.delete')}}</h5> 
			</div> 
			<div class="modal-footer">
				<input type="hidden" id="id" name="id">
				<input type="submit" class="btn btn-danger" value="{{trans('admin.erase')}}">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.cancel')}}</button>
			</div>
		</div>
	</div>
</div>