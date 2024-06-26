document.addEventListener("DOMContentLoaded", function() {
    // For category
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

    // For tenant
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

    // === Open & Close Filter Tab ===
    const filterGroup = document.querySelector('.filterGroup');
    const iconFilter = document.querySelector('.icon-filter');
    const contentTab = document.querySelector('.contentTab');
    const filterIconPath = document.querySelector('.filterIcon path');

    iconFilter.addEventListener('click', function () {
        toggleFilter ();
    });

    const toggleFilter = () => {
        filterGroup.classList.toggle('activeFilter');
        contentTab.classList.toggle('activeFilter');
        iconFilter.classList.toggle('activeFilter');
        filterIconPath.classList.toggle('activeFilter');
    }

    // Fitur dynamic search
    const searchInput = document.getElementById('search-input');
    const productContainer = document.getElementById('product-list');

    searchInput.addEventListener('input', function() {
        const searchQuery = this.value;
        const categoryId = new URLSearchParams(window.location.search).get('category_id') || '';
        const tenantId = new URLSearchParams(window.location.search).get('tenant_id') || '';

        fetch(`/menu?category_id=${categoryId}&tenant_id=${tenantId}&search=${searchQuery}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            productContainer.innerHTML = data;
            initializeAddToCartButtons();
            initializeProductModals();
        })
        .catch(error => console.error('Error:', error));
    });

    const initializeAddToCartButtons = () => {
        const addCartButtons = document.querySelectorAll('.addCart');
        addCartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                let productClassSelector = this.closest('.item') || this.closest('.modal-right');
                const productName = productClassSelector.querySelector('#product-name').innerText;
                const productPrice = parseInt(productClassSelector.querySelector('#product-price').innerText.replace('Rp', '').replace('.', ''));
                const productTenant = productClassSelector.querySelector('#product-tenant').innerText;
                const product = {
                    id: productId,
                    name: productName,
                    price: productPrice,
                    tenant: productTenant
                };
                addProductToCart(product);
            });
        });
    };

    const initializeProductModals = () => {
        document.querySelectorAll('.imagesProduct').forEach(item => {
            item.addEventListener('click', function() {
                var modalId = this.getAttribute('data-target');
                var modal = document.getElementById(modalId);
                modal.style.display = "block";

                var modalContent = modal.querySelector('.modal-content');
                modalContent.querySelectorAll('.modal-body').forEach(view => {
                    view.style.display = 'none';
                });
                modalContent.querySelector('.view-1').style.display = 'flex';
            });
        });

        document.querySelectorAll('.close').forEach(closeBtn => {
            closeBtn.onclick = function() {
                var modal = this.closest('.modal');
                modal.style.display = "none";
            };
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        };

        document.querySelectorAll('.switchView').forEach(button => {
            button.addEventListener('click', function() {
                var targetView = this.getAttribute('data-target');
                var currentModal = this.closest('.modal-content');
                currentModal.querySelectorAll('.modal-body').forEach(view => {
                    view.style.display = 'none';
                });
                currentModal.querySelector('.' + targetView).style.display = 'flex';
            });
        });
    };

    // Load cart from local storage on page load
    loadCartFromLocalStorage();
});
