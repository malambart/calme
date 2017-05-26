<!-- Modal -->
<div class="modal fade" id="ecoleForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ajouter une école</h4>
			</div>
			<div class="modal-body">
				<form class="bootstrap-modal-form clearfix" role="form" method="POST"
					  action="{{ url('ecoles/create') }}">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
						<label for="nom" class="control-label">Nom de l'école</label>
						<input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}"
							   autofocus>
						@if ($errors->has('nom'))
							<p class="help-block">
								<strong>{{ $errors->first('nom') }}</strong>
							</p>
						@endif
					</div>
					<div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">
						<label for="ville" class="control-label">Ville</label>
						<input id="ville" type="text" class="form-control" name="ville" value="{{ old('ville') }}"
							   autofocus>
						@if ($errors->has('ville'))
							<span class="help-block">
							<strong>{{ $errors->first('ville') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
						<label for="telephone" class=" control-label">Téléphone</label>
						<input id="telephone" type="text" class="form-control tel-mask" name="telephone"
							   value="{{ old('telephone') }}">
						@if ($errors->has('telephone'))
							<span class="help-block">
                        		    <strong>{{ $errors->first('telephone') }}</strong>
                        		</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
						<label for="fax" class=" control-label">Fax</label>
						<input id="fax" type="text" class="form-control tel-mask" name="fax" value="{{ old('fax') }}">
						@if ($errors->has('fax'))
							<span class="help-block">
                        		    <strong>{{ $errors->first('fax') }}</strong>
                        		</span>
						@endif
					</div>
					<button type="submit" class="btn btn-primary pull-right">
						Ajouter
					</button>
				</form>
			</div>

		</div>
	</div>
</div>