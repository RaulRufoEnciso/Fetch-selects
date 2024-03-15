document.getElementById('categories').addEventListener('change', function() {
    let catId = this.value;
    console.log(catId); // Per a comprovar que es recull correctament l'ID

    // Prepara les dades per enviar
    let formData = new FormData();
    formData.append("cat1", catId);

    // Opcions per a fetch
    let options = {
        method: 'POST',
        body: formData
    };

    // Fer la crida fetch
    fetch("getSubCats.php", options)
        .then(response => response.json())
        .then(data => {
            let subcategoriesSelect = document.getElementById("subcategories");
            subcategoriesSelect.innerHTML = '<option value="">Selecciona una subcategoria</option>'; // Neteja el selector

            // Afegeix les noves opcions
            data.forEach(el => {
                let opt = document.createElement('option');
                opt.value = el.id;
                opt.text = el.nom;
                subcategoriesSelect.appendChild(opt);
            });
        })
        .catch(error => console.error('Error:', error));
});
