function datatableReload() {
    var table = $('.datatable').DataTable();
    table.ajax.reload();
}

function scrollFunction() {
    const element = document.getElementById("addDetails");
    element.scrollIntoView({
        behavior: "smooth"
    });
}