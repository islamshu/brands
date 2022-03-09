function store(url, data) {

    axios.post(url, data)
        .then(function(response) {
            showMessage(response.data);
            // clearForm();
            // clearAndHideErrors();

        })
        .catch(function(error) {

            if (error.response.data.errors !== undefined) {
                showErrorMessages(error.response.data.errors);
            } else {

                showMessage(error.response.data);
            }
        });

}


function storepart(url, data) {

    axios.post(url, data)

    .then(function(response) {
        showMessage(response.data);
        clearForm();
        clearAndHideErrors();

    })

    .catch(function(error) {

        if (error.response.data.errors !== undefined) {
            showErrorMessages(error.response.data.errors);
        } else {

            showMessage(error.response.data);
        }
    });

}

function storeRoute(url, data) {
    axios.post(url, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(function(response) {
            window.location = response.data.redirect;
            // showMessage(response.data);
            // clearForm();
            // clearAndHideErrors();

        })
        .catch(function(error) {

            if (error.response.data.errors !== undefined) {
                showErrorMessages(error.response.data.errors);
            } else {

                showMessage(error.response.data);
            }
        });
}

function storeRedirect(url, data, redirectUrl) {
    axios.post(url, data)
        .then(function(response) {
            console.log(response);
            if (redirectUrl != null)
                window.location.href = redirectUrl;
        })
        .catch(function(error) {
            console.log(error.response);
        });
}

function update(url, data, redirectUrl) {

    axios.post(url, data)
        .then(function(response) {
            showMessage(response.data);
            axios.post(url, data)
                .then(function(response) {




                    console.log(response);

                    if (redirectUrl != null)
                        window.location.href = redirectUrl;
                })
                .catch(function(error) {

                    if (error.response.data.errors !== undefined) {
                        showErrorMessages(error.response.data.errors);
                    } else {

                        showMessage(error.response.data);
                    }
                });
        });
}

function updateRoute(url, data) {
    axios.put(url, data)

    .then(function(response) {
            console.log(response);

            window.location = response.data.redirect;

        })
        .catch(function(error) {
            console.log(error.response);
        });
}

function updateReload(url, data, redirectUrl) {
    axios.put(url, data)
        .then(function(response) {
            console.log(response);
            location.reload()
        })
        .catch(function(error) {
            console.log(error.response);
        });
}

function updatePage(url, data) {
    axios.post(url, data)
        .then(function(response) {
            console.log(response);
            // showMessage(response.data);
        })
        .catch(function(error) {
            console.log(error.response);
        });
}

function confirmDestroy(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "The deletion cannot be undone",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'yes',
        cancelButtonText: 'cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            destroy(url);
        }
    });
}


function destroy(url) {

    axios.delete(url)
        .then(function(response) {
            // handle success
            console.log(response.data);

            showMessage(response.data);
            location.reload(true);

        })
        .catch(function(error) {
            // handle error
            console.log(error.response);
            showErrorMessages(error.response.data.errors);

            // showToaster(error.response.data.message, false);
        })
        .then(function() {
            // always executed
        });
}




function showErrorMessages(errors) {

    document.getElementById('error_alert').hidden = false
    var errorMessagesUl = document.getElementById("error_messages_ul");
    errorMessagesUl.innerHTML = '';

    for (var key of Object.keys(errors)) {
        var newLI = document.createElement('li');
        newLI.appendChild(document.createTextNode(errors[key]));
        errorMessagesUl.appendChild(newLI);
    }
}

function clearAndHideErrors() {
    document.getElementById('error_alert').hidden = true
    var errorMessagesUl = document.getElementById("error_messages_ul");
    errorMessagesUl.innerHTML = '';
}

function clearForm() {
    document.getElementById("create_form").reset();
}

function showMessage(data) {
    console.log(data);
    Swal.fire({
        position: 'center',
        icon: data.icon,
        title: data.title,
        showConfirmButton: false,
        timer: 1500
    })
}