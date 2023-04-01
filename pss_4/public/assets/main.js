document.getElementById("search-button").addEventListener("click", function() {
    fetch("/ajax/search", {
        method: "POST",
        body: JSON.stringify({
            search: document.getElementById("search-input").value
        }, {
            headers: {
                "Content-Type": "application/json"
            }
        })
    }).then(function(response) {
        response.text().then(function(text) {
            document.getElementById("productsResult").innerHTML = text;
        });
    })
    .then(function(data) {
    });
});

