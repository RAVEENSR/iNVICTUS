function setUpdateAction() {
document.productForm.action = "../editProduct.php";
document.productForm.submit();
}
function setDeleteAction() {
if(confirm("Are you sure want to delete these rows?")) {
document.productForm.action = "../deleteProduct.php";
document.productForm.submit();
}
}