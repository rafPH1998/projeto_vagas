let B7Validator = {
    handleSubmit:(event) => {
        event.preventDefault();
        let send = true;

        let inputs = document.querySelectorAll('input');
        B7Validator.clearError();

        for(let i=0;i<inputs.length;i++) {
            let input = inputs[i];
            let check = B7Validator.checkInput(input);
            if(check !== true) {
                send = false;
                B7Validator.showError(input, check);
            }
        }

        if(send) {
            form.submit();
        }
    },
    checkInput:(input) => {
        let rules = input.getAttribute('data-rules');

        if(rules !== null) {
            rules = rules.split('|')
            for(let i in rules) {
                rDetails = rules[i].split('=');
                switch(rDetails[0]) {
                    case 'required':
                        if(input.value == '') {
                            return 'Campo vazio, por favor preencha esse campo.';
                        }
                    break;
                }

            }
        }

        return true;
        
    },
    showError:(input, error) => {
        input.style.borderColor = 'red';
        let elementError = document.createElement('div');
        elementError.classList.add('error');

        elementError.innerHTML = error;
        input.parentElement.insertBefore(elementError, input.ElementSibling);
    },
    clearError:() => {
        let inputs = form.querySelectorAll('input');
        for(let q in inputs) {
            inputs[q].style = '';
        }

        let errorElements = document.querySelectorAll('.error');
        for(let i=0;i<errorElements.length;i++) {
            errorElements[i].remove();
        }
    }
}

let form = document.querySelector('#b7validator');
form.addEventListener('submit', B7Validator.handleSubmit);
