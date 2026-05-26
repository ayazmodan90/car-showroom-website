// Responsive Navbar Toggle

let menuBtn = document.querySelector('#menu-btn');
let navbar = document.querySelector('#navbar');

if (menuBtn && navbar) {
    menuBtn.onclick = () => {
        navbar.classList.toggle('active');
    };

    window.onscroll = () => {
        navbar.classList.remove('active');
    };
}

// Active menu close after click

let navLinks = document.querySelectorAll('.navbar a');

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (navbar) {
            navbar.classList.remove('active');
        }
    });
});

// Confirm delete buttons

let deleteButtons = document.querySelectorAll('.delete-btn');

deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        let confirmDelete = confirm("Are you sure you want to delete this record?");

        if (!confirmDelete) {
            event.preventDefault();
        }
    });
});

// Form submit loading text
// NOTE: Button ko disabled nahi karna, warna PHP me submit button ka name send nahi hota.

let forms = document.querySelectorAll('form');

forms.forEach(form => {
    form.addEventListener('submit', function() {
        let submitBtn = form.querySelector('button[type="submit"]');

        if (submitBtn) {
            submitBtn.innerText = "Please Wait...";
            // submitBtn.disabled = true;  // is line ko remove/comment rakho
        }
    });
});