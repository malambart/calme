
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="Confirmation de supression" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Veuillez confirmer la supression.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <a href="" class="btn btn-danger btn-ok" id="confirmButton">Supprimer</a>
                </div>
        </div>
    </div>
</div>
<script>
$( document ).ready(function() {
	let url=$('#deleteButton').data("href");
	console.log(url);
	$('#confirmButton').attr('href',url);
});
</script>