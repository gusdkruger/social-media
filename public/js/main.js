function loadPage(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../app/views/ajax/' + page + '.html', true);
    xhr.onload = function() {
        if(this.status === 200) {
            document.getElementById('ajaxContainer').innerHTML = this.responseText;
            attachEventListeners();
        }
        else {
            document.getElementById('ajaxContainer').innerHTML = 'Error loading page.';
        }
    };
    xhr.send();
}

function attachEventListeners() {
    const recoverPasswordBtn = document.getElementById('nav-recover-password');
    const signUpBtn = document.getElementById('nav-sign-up');
    const loginBtn = document.getElementById('nav-login');
    if(recoverPasswordBtn) {
        recoverPasswordBtn.onclick = function() {
            loadPage('recover');
        };
    }
    if(signUpBtn) {
        signUpBtn.onclick = function() {
            loadPage('register');
        };
    }
    if(loginBtn) {
        loginBtn.onclick = function() {
            loadPage('login');
        };
    }
}

document.addEventListener('DOMContentLoaded', function() {
    loadPage('login');
});
