    function checkSession() {
        Swal.fire({
            icon: 'warning',
            title: 'Iniciar Sesión Requerido',
            text: 'Debes iniciar sesión o crear una cuenta para realizar una reservación.',
            confirmButtonText: 'Ir a Login',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            }
        });
    }


    function searchInns() {
        const searchValue = document.getElementById('searchInput').value;
        fetch(`?search=${encodeURIComponent(searchValue)}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('cGrid').innerHTML = new DOMParser().parseFromString(html, "text/html")
                    .getElementById('cGrid').innerHTML;
            })
            .catch(error => console.error("Error en la búsqueda:", error));
    }

    function filterItems(filterSelector) {
        const items = document.querySelectorAll('.grid-item');
        let visibleCount = 0; 
        items.forEach(item => {
            if (filterSelector === '*' || item.classList.contains(filterSelector.replace('.', ''))) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        adjustGridContainer(visibleCount); 
    }


    function adjustGridContainer(visibleCount = null) {
        const cGrid = document.getElementById('cGrid');
        const items = document.querySelectorAll('.grid-item');
        if (visibleCount === null) {
            visibleCount = Array.from(items).filter(item => item.style.display !== 'none').length;
        }
        if (visibleCount === 0) {
            cGrid.innerHTML = "<p>No se encontraron resultados.</p>";
        } else {
            cGrid.style.height = 'auto';
        }
    }

    function reconnectFilters() {
        const buttons = document.querySelectorAll('.btn[data-filter]');
        buttons.forEach(button => {
            button.removeEventListener('click', handleFilterClick);
            button.addEventListener('click', handleFilterClick);
        });
    }

    function handleFilterClick() {
        const filterValue = this.getAttribute('data-filter');
        filterItems(filterValue);
    }

    document.getElementById('searchButton').addEventListener('click', searchInns);
    document.querySelectorAll('.btn[data-filter]').forEach(button => {
        button.addEventListener('click', handleFilterClick);
    });