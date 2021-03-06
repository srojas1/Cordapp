<div id="delete_cupon" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Estas seguro?</h4>
            </div>
            <div class="modal-body">
                <p>Estás a punto de eliminar un cupon. Este cupon no puede ser desecho</p>
                <p>Estás seguro de continuar?</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="{!! URL::route('cupon.destroy', array('cupon' =>$cupon->id)) !!}" data-token="{!! Session::getToken() !!}" data-method="DELETE">Si</a>
                <button class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>