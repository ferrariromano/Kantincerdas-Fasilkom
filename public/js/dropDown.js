document.addEventListener("DOMContentLoaded", function() {
    // Untuk kategori
    const categoryLinks = document.querySelectorAll('#dropdown-category-menu .dropDownLink');
    const categoryLabel = document.getElementById('label-category');

    // Load saved category from localStorage
    const savedCategory = localStorage.getItem('selectedCategory');
    if (savedCategory) {
        categoryLabel.textContent = savedCategory;
    }

    categoryLinks.forEach(link => {
        link.addEventListener('click', function() {
            const selectedCategory = this.getAttribute('data-category');
            categoryLabel.textContent = selectedCategory;
            localStorage.setItem('selectedCategory', selectedCategory);
        });
    });

    // Untuk tenant
    const tenantLinks = document.querySelectorAll('#dropdown-tenant-menu .dropDownLink');
    const tenantLabel = document.getElementById('label-tenant');

    // Load saved tenant from localStorage
    const savedTenant = localStorage.getItem('selectedTenant');
    if (savedTenant) {
        tenantLabel.textContent = savedTenant;
    }

    tenantLinks.forEach(link => {
        link.addEventListener('click', function() {
            const selectedTenant = this.getAttribute('data-tenant');
            tenantLabel.textContent = selectedTenant;
            localStorage.setItem('selectedTenant', selectedTenant);
        });
    });

});


