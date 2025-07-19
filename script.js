document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('search');
    const bookList = document.getElementById('book-list');

    searchInput.addEventListener('input', function() {
        let query = searchInput.value.toLowerCase();
        filterBooks(query);
    });

    function filterBooks(query) {
        const rows = bookList.getElementsByTagName('tr');
        Array.from(rows).forEach(function(row) {
            let title = row.cells[0].textContent.toLowerCase();
            if (title.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Fetch books from the server when the page loads
    fetchBooks();

    function fetchBooks() {
        fetch('get_books.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(book => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.price}€</td>
                        <td>${book.genre}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editBook(${book.id})">Modifier</button>
                            <button class="btn btn-danger" onclick="deleteBook(${book.id})">Supprimer</button>
                        </td>
                    `;
                    bookList.appendChild(tr);
                });
            });
    }

    // Placeholder functions for edit and delete
    function editBook(id) {
        console.log('Edit Book with ID: ' + id);
        // Lancer le formulaire de modification
    }

    function deleteBook(id) {
        console.log('Delete Book with ID: ' + id);
        // Envoyer une requête PHP pour supprimer le livre
    }
});
