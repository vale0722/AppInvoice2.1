if (document.getElementById('divErrors')) {
    swal({
        title: 'ERROR!',
        text: 'Algo ha fallado!',
        icon: 'error',
    });
};
if (document.getElementById('success')) {
    swal({
        title: 'Importación exitosa',
        icon: 'success',
    });
};
if (document.getElementById('errorEdit')) {
    swal({
        title: 'La factura no se puede editar',
        icon: 'error',
    });
};
