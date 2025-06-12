
document.addEventListener('DOMContentLoaded', () => {
    console.log("DOM fully loaded and parsed. Initializing scripts for permanent dark mode.");

    window.addEventListener('click', function (event) {
        // If the click is not part of any dropdown's trigger or content
        // (No need to check for theme toggle button anymore)
        if (!event.target.closest('.dropdown') && !event.target.matches('.filter-btn, .filter-btn *')) {
            console.log("Clicked outside dropdown area. Closing all dropdowns.");
            closeAllDropdowns();
        } else {
            // console.log("Clicked inside a dropdown area or on a filter button.");
        }
    });

}); 
function closeAllDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    let anyDropdownClosed = false;
    dropdowns.forEach(dropdown => {
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
            const button = document.querySelector(`button.filter-btn[onclick*="${dropdown.id}"]`);
            if (button) {
                button.classList.remove('open');
            }
            anyDropdownClosed = true;
        }
    });
}

function toggleDropdown(id) {
    const dropdownToToggle = document.getElementById(id);
    if (!dropdownToToggle) {
        console.error(`Dropdown content with id '${id}' not found.`);
        return;
    }
    const targetButton = document.querySelector(`button.filter-btn[onclick*="${id}"]`);
    

    const isCurrentlyOpen = dropdownToToggle.style.display === "block";

    const allDropdowns = document.querySelectorAll('.dropdown-content');
    allDropdowns.forEach(otherDropdown => {
        if (otherDropdown.id !== id && otherDropdown.style.display === 'block') {
            otherDropdown.style.display = 'none';
            const otherButton = document.querySelector(`button.filter-btn[onclick*="${otherDropdown.id}"]`);
            if (otherButton) {
                otherButton.classList.remove('open');
            }
        }
    });

    if (isCurrentlyOpen) {
        dropdownToToggle.style.display = "none";
        if (targetButton) targetButton.classList.remove('open');
    } else {
        dropdownToToggle.style.display = "block";
        if (targetButton) targetButton.classList.add('open');
    }
}

function selectDropdownItem(itemElement, categoryName) {
    const selectedValue = itemElement.textContent.trim();

    const dropdownContainer = itemElement.closest('.dropdown');
    if (!dropdownContainer) {
        console.error("Could not find parent .dropdown container for the selected item.");
        return;
    }

    const mainFilterButton = dropdownContainer.querySelector('.filter-btn');
    if (mainFilterButton) {
        const iconElement = mainFilterButton.querySelector('i.fas.fa-chevron-down');
        mainFilterButton.textContent = selectedValue + " ";
        if (iconElement) {
            mainFilterButton.appendChild(iconElement);
        }
    } else {
    }

    const dropdownContent = itemElement.closest('.dropdown-content');
    if (dropdownContent) {
        dropdownContent.style.display = "none";
        if (mainFilterButton) mainFilterButton.classList.remove('open');
    }
    function toggleProfileMenu() {
        var menu = document.getElementById('profileMenu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
    });

    function toggleProfileMenu() {
        var menu = document.getElementById('profileMenu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    }

    document.addEventListener('click', function (event) {
        var profileBtn = document.querySelector('.profile-btn');
        var profileMenu = document.getElementById('profileMenu');
        if (!profileBtn.contains(event.target) && !profileMenu.contains(event.target)) {
            profileMenu.style.display = 'none';
        }
    });



}