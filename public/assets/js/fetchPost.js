document.querySelectorAll('form').forEach(function(form) {

    form.addEventListener('submit', function(e) {
        e.preventDefault(); 

        let data = new FormData(this); 
        let action = this.action; 

        fetch(action, {
            method: 'POST',
            body: data,
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Probléme dans la requête');
            }
        })
        .then(function(jsonResponse) {

            form.reset();

        })
        
    });
});
