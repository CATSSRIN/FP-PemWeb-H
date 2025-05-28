// script.js
document.addEventListener('DOMContentLoaded', () => {
    console.log("DOM fully loaded and parsed. Initializing scripts for permanent dark mode.");

    // --- Bookmark icon functionality ---
    const bookmarkIcons = document.querySelectorAll('.bookmark-icon');
    bookmarkIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const bookmark = icon.querySelector('i');
            if (!bookmark) {
                console.error("Bookmark icon (<i> tag) not found within .bookmark-icon element");
                return;
            }
            const isActive = bookmark.classList.contains('fas'); // 'fas' usually means solid/active

            if (isActive) {
                bookmark.classList.remove('fas');
                bookmark.classList.add('far'); // 'far' usually means regular/outline
                icon.classList.remove('active-bookmark');
                console.log("Bookmark deactivated");
            } else {
                bookmark.classList.remove('far');
                bookmark.classList.add('fas');
                icon.classList.add('active-bookmark');
                console.log("Bookmark activated");
            }
        });
    });

    // --- Dropdown functionality ---
    // Close dropdown if clicked outside any dropdown area or filter button
    window.addEventListener('click', function(event) {
        // If the click is not part of any dropdown's trigger or content
        // (No need to check for theme toggle button anymore)
        if (!event.target.closest('.dropdown') && !event.target.matches('.filter-btn, .filter-btn *')) {
            console.log("Clicked outside dropdown area. Closing all dropdowns.");
            closeAllDropdowns();
        } else {
            // console.log("Clicked inside a dropdown area or on a filter button.");
        }
    });

}); // --- END OF DOMContentLoaded ---

// Helper function to close all dropdowns
function closeAllDropdowns() {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    let anyDropdownClosed = false;
    dropdowns.forEach(dropdown => {
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
            const button = document.querySelector(`button.filter-btn[onclick*="${dropdown.id}"]`);
            if (button) {
                button.classList.remove('open');
                // console.log(`Closed dropdown ${dropdown.id} and removed 'open' from its button.`);
            }
            anyDropdownClosed = true;
        }
    });
    // if (anyDropdownClosed) {
    //     console.log("Finished closing dropdowns.");
    // }
}

// Function to toggle a specific dropdown (called from HTML onclick)
function toggleDropdown(id) {
    // console.log(`Toggling dropdown with id: ${id}`);
    const dropdownToToggle = document.getElementById(id);
    if (!dropdownToToggle) {
        console.error(`Dropdown content with id '${id}' not found.`);
        return;
    }
    const targetButton = document.querySelector(`button.filter-btn[onclick*="${id}"]`);
    // if (!targetButton) {
    //     console.warn(`Button for dropdown '${id}' not found. Icon may not rotate.`);
    // }

    const isCurrentlyOpen = dropdownToToggle.style.display === "block";

    // First, close all other currently open dropdowns
    const allDropdowns = document.querySelectorAll('.dropdown-content');
    allDropdowns.forEach(otherDropdown => {
        if (otherDropdown.id !== id && otherDropdown.style.display === 'block') {
            otherDropdown.style.display = 'none';
            const otherButton = document.querySelector(`button.filter-btn[onclick*="${otherDropdown.id}"]`);
            if (otherButton) {
                otherButton.classList.remove('open');
                // console.log(`Closed other dropdown ${otherDropdown.id}.`);
            }
        }
    });

    // Now, toggle the target dropdown
    if (isCurrentlyOpen) {
        dropdownToToggle.style.display = "none";
        if (targetButton) targetButton.classList.remove('open');
        // console.log(`Closed target dropdown ${id}.`);
    } else {
        dropdownToToggle.style.display = "block";
        if (targetButton) targetButton.classList.add('open');
        // console.log(`Opened target dropdown ${id}.`);
    }
}

// Function to handle selection of a dropdown item (called from HTML onclick)
function selectDropdownItem(itemElement, categoryName) {
    const selectedValue = itemElement.textContent.trim();
    // console.log(`Selected item: '${selectedValue}' from category: '${categoryName}'`);

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
        // console.log(`Updated main button text to: ${selectedValue}`);
    } else {
        // console.warn("Could not find the main filter button to update its text.");
    }

    const dropdownContent = itemElement.closest('.dropdown-content');
    if (dropdownContent) {
        dropdownContent.style.display = "none";
        if (mainFilterButton) mainFilterButton.classList.remove('open');
        // console.log(`Closed dropdown content for ${categoryName} after selection.`);
    }
}