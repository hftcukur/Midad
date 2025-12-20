function deleteBook(id) {
    if (confirm('هل تريد حذف هذا الكتاب؟')) {
        window.location = 'admin/home.php?=' + id;
    }
}
