function updateBook(bookName, authorName, publish_year, category, pages, description, path){
    var book_name =  document.getElementById("book_name").value = bookName;
    var book_name =  document.getElementById("authro").value = authorName;
    var book_name =  document.getElementById("date").value = publish_year;
    var book_name =  document.getElementById("category").value = category;
    var book_name =  document.getElementById("pages").value = pages;
    var book_name =  document.getElementById("book_name").value = description;
    var book_name =  document.getElementById("book_name").value = path;
    var btnAddNewBook = document.getElementById("btnAddNewBook").value = "تعديل";
}
let now = new Date(Date.now());
let yyyy = now.getFullYear();
let mm = String(now.getMonth() + 1).padStart(2, '0'); // الأشهر من 0-11
let dd = String(now.getDate()).padStart(2, '0');

let today = `${yyyy}-${mm}-${dd}`; // "2025-12-05"
document.getElementById("date").value = today;

updateBook( "ابابيل","حسين",today,"خيال",10,"لا يوجد وصف","لا" );