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
if (document.getElementById('exportInProccess')) {
    swal({
        title: 'El reporte se está generando',
        text: 'Cuando haya finalizado el proceso podrás descargarlo en REPORTES GENERADOS'
    });
};
