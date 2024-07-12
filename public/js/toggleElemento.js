function confirmChange(elemento, id, toDelete) {
    let str = toDelete == 1 ? "borrar" : "restaurar";
    let finUrl = toDelete == 1 ? "delete" : "restore";
    if (confirm('¿Estás seguro de que deseas ' + str +' este elemento?')) {
        window.location.href = `/gestion/${elemento}/${id}/${finUrl}`;
    }
}