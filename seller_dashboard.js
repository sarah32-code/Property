// seller_dashboard.js

// Fetch properties from the server and generate property cards
function fetchProperties() {
    // Make an AJAX request to fetch properties from the server
    // Example: fetch('/api/properties', { method: 'GET' })
    // Handle the response and generate property cards
    // Insert the property cards into the propertyList div
}

// Handle the click event for the "Add New Property" button
document.getElementById('addPropertyButton').addEventListener('click', () => {
    // Redirect to the property creation page (seller_add_property.php)
    // Example: window.location.href = 'seller_add_property.php';
});

// Handle the click event for property cards
document.getElementById('propertyList').addEventListener('click', (e) => {
    const target = e.target;
    if (target.classList.contains('view-details-button')) {
        // Redirect to the property details page with property ID
        const propertyId = target.getAttribute('data-property-id');
        // Example: window.location.href = `property_details.php?id=${propertyId}`;
    }
});

// Fetch properties when the page loads
window.addEventListener('load', () => {
    fetchProperties();
});
