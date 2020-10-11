$('#mesasModal').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var numMesa = button.data('num')
    var numSillas = button.data('sillas')
    var estatus = button.data('estatus')
    
    var  modal = $(this)
    modal.find('.modal-body #idMesa').val(id)
    modal.find('.modal-body #numMesa').val(numMesa)
    modal.find('.modal-body #numPersonas').val(numSillas)
    modal.find('.modal-body #estatusMesa').val(estatus)    
})