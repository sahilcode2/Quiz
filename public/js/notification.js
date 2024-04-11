function showPopup(id, title, description) {
    var popup = document.getElementById("popup");
    var popupTitle = document.getElementById("popup-title");
    var popupDescription = document.getElementById("popup-description");

    popup.style.display = "block";
    popupTitle.textContent = title;
    popupDescription.textContent = description;


    // markNotificationAsRead(id)
    const authToken = getApiToken();

    // Call the API to mark the notification as read
    $.ajax({
        url: '/notifications/' + id + '/read',
        type: 'PUT',
        // headers: {
        //     'Authorization': 'Bearer ' + authToken
        // },
        success: function(response) {
            console.log('Notification marked as read successfully');
        },
        error: function(xhr, status, error) {
            console.error('Error marking notification as read:', error);
        }
    });
}

function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
    location.reload();
}


// Function to retrieve the API token from local storage
function getApiToken() {
    return localStorage.getItem('api_token'); // Assuming the token is stored in local storage
}

// Function to mark notification as read
function markNotificationAsRead(id) {
    // Fetch API endpoint URL
    const url = '/api/notifications/' + id + '/read';

    // Retrieve API token
    const token = getApiToken();
    
    // Check if token exists
    if (!token) {
        console.error('API token not found');
        return;
    }

    // Fetch options with authorization header
    const options = {
        method: 'PUT',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json'
        }
    };

    // Make the fetch request
    fetch(url, options)
        .then(response => {
            // Check if response is OK
            if (response.ok) {
                console.log('Notification marked as read successfully');
            } else {
                console.error('Error marking notification as read:', response.statusText);
            }
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
        });
}